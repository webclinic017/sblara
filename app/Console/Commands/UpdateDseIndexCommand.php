<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Market;
use App\DataBanksEod;
use App\Repositories\InstrumentRepository;
use App\Repositories\SectorListRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\DataBankEodRepository;
Use App\DataBanksIntraday;
use App\Repositories\CorporateActionRepository;
use App\Repositories\FundamentalRepository;
use App\Repositories\MarketStatRepository;
use App\Repositories\IndexRepository;



class UpdateDseIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dse:UpdateDseIndex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching dse index from DSE IDX tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan dse:UpdateDseIndex
    public function handle()
    {

        if(!Market::isMarketOpen())
        {
            $this->info('market is not open');

        }
        else
        {

            $querystr = "select * from IDX ORDER BY IDX_DATE_TIME ASC";
            $dataFromDseServer = DB::connection('dse')->select($querystr);

            $date_time = $dataFromDseServer[0]->IDX_DATE_TIME;
            $convertedTimestamp = strtotime($date_time);
            $trade_date = date('Y-m-d', $convertedTimestamp);


            // Market is open. Now we will check if dse server returning today's data. Sometimes dse return previous day data
            if($activeTradeDates=Market::validateTradeDate($trade_date))
            {
                // its returning today data. So we will proceed here
                $market_id=$activeTradeDates->id;

                foreach($dataFromDseServer as $data)
                {
                    $instrumentList = InstrumentRepository::getInstrumentsScripWithIndex();
                    $instrument_info = $instrumentList->where('instrument_code', trim($data->IDX_INDEX_ID))->first();

                    if (!is_null($instrument_info)) {
                        $instrument_id = $instrument_info->id;
                        $temp = array();
                        $temp['market_id'] = $market_id;
                        $temp['instrument_id'] = $instrument_id;
                        $temp['capital_value'] = $data->IDX_CAPITAL_VALUE;
                        $temp['deviation'] = $data->IDX_DEVIATION;
                        $temp['percentage_deviation'] = $data->lDX_PERCENTAGE_DEVIATION;
                        $temp['date_time'] = date('Y-m-d H:i:s', strtotime($data->IDX_DATE_TIME));
                        $temp['index_date'] = date('Y-m-d', strtotime($data->IDX_DATE_TIME));
                        $temp['index_time'] = date('H:i', strtotime($data->IDX_DATE_TIME));
                        $dataToSave[] = $temp;

                    }





                }


                if (!empty($dataToSave)) {

                    //first delete all index of trade_date
                    DB::table('index_values')->where('market_id', $market_id)->delete();

                    // re insert all index of trade date.
                    DB::table('index_values')->insert($dataToSave);

                    $this->info(count($dataToSave) . ' row inserted into index_values');

                }




                /* CALCULATING OHLC VALUES TO SAVE INTO DATA_BANK_INTRADAYS and DATA_BANK_EODS TABLE */


                $IntradayDataToSave = array();
                $dataToSave_collection=collect($dataToSave);
                $dataToSave_collection=$dataToSave_collection->groupBy('instrument_id');

                $index_ohlc=array();
                foreach($dataToSave_collection as $instrument_id=>$all_data_of_a_index)
                {
                    $collect= collect($all_data_of_a_index);

                    $first= $collect->first();
                    $index_ohlc[$instrument_id]['open']= $first['capital_value'];

                    $index_ohlc[$instrument_id]['high']= $collect->max('capital_value');
                    $index_ohlc[$instrument_id]['low']= $collect->min('capital_value');

                    $last = $collect->last();
                    $index_ohlc[$instrument_id]['close'] = $last['capital_value'];
                    $index_ohlc[$instrument_id]['date_time'] = $last['date_time'];

                }

                $today_eod_data=DB::table('data_banks_eods')->select('instrument_id','volume','trade','tradevalues')->where('market_id', $market_id)->get();


                // new index? add here
                $instrument_list_of_index = FundamentalRepository::getFundamentalDataAll(array('ds30_listed','dsex_listed'));



                // new index? add here
                $instrument_list_of_dsex = collect($instrument_list_of_index['dsex_listed'])->where('meta_value', '1');
                $instrument_list_of_ds30 = collect($instrument_list_of_index['ds30_listed'])->where('meta_value', '1');


                // new index? add here
                // extracting all instrument_id
                $instrument_id_of_all_dsex_listed_company = $instrument_list_of_dsex->pluck('instrument_id');
                $instrument_id_of_all_ds30_listed_company = $instrument_list_of_ds30->pluck('instrument_id');


                ////////////////////// EOD for DSEX \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

                $dsexVolume = 0;
                $dsexTrade = 0;
                $dsexTradeValues = 0;
                foreach ($instrument_id_of_all_dsex_listed_company as $ins_id) {


                    $trade_data= $today_eod_data->where('instrument_id', $ins_id)->first();
                    if(!is_null($trade_data))
                    {
                        $dsexVolume+= $trade_data->volume;
                        $dsexTrade+= $trade_data->trade;
                        $dsexTradeValues+= $trade_data->tradevalues;

                    }

                }

                $instrument_id = 10001;
                $eod = DataBanksEod::updateOrCreate(
                    ['market_id' => $market_id, 'instrument_id' => $instrument_id],
                    [
                        'open' => $index_ohlc[$instrument_id]['open'],
                        'high' => $index_ohlc[$instrument_id]['high'],
                        'low' => $index_ohlc[$instrument_id]['low'],
                        'close' => $index_ohlc[$instrument_id]['close'],
                        'volume' => $dsexVolume,
                        'trade' => $dsexTrade,
                        'tradevalues' => $dsexTradeValues,
                        'updated' => date('Y-m-d H:i:s'),
                        'date' => $trade_date
                    ]
                );

                /////////////////// Intraday Data DSEX \\\\\\\\\\\\\\\\\\\\
                $temp = array();
                $temp['market_id'] = $market_id;
                $temp['instrument_id'] = $instrument_id;
                $temp['open_price'] = $index_ohlc[$instrument_id]['open'];
                $temp['pub_last_traded_price'] = $index_ohlc[$instrument_id]['close'];
                $temp['high_price'] = $index_ohlc[$instrument_id]['high'];
                $temp['low_price'] = $index_ohlc[$instrument_id]['low'];
                $temp['close_price'] = $index_ohlc[$instrument_id]['close'];
                $temp['total_trades'] = $dsexTrade;
                $temp['total_volume'] = $dsexVolume;
                $temp['total_value'] = $dsexTradeValues;
                $temp['lm_date_time'] = date('Y-m-d H:i:s', strtotime($index_ohlc[$instrument_id]['date_time']));
                $temp['trade_time'] = date('H:i', strtotime($index_ohlc[$instrument_id]['date_time']));
                $temp['trade_date'] = date('Y-m-d', strtotime($index_ohlc[$instrument_id]['date_time']));
                $IntradayDataToSave[] = $temp;


                //////////////////////// EOD for DS30 \\\\\\\\\\\\\\\\\\\\\\\\\\\

                $ds30Volume = 0;
                $ds30Trade = 0;
                $ds30TradeValues = 0;
                foreach ($instrument_id_of_all_ds30_listed_company as $ins_id) {


                    $trade_data= $today_eod_data->where('instrument_id', $ins_id)->first();
                    if(!is_null($trade_data))
                    {
                        $ds30Volume+= $trade_data->volume;
                        $ds30Trade+= $trade_data->trade;
                        $ds30TradeValues+= $trade_data->tradevalues;

                    }

                }


                $instrument_id=10002;
                $eod = DataBanksEod::updateOrCreate(
                    ['market_id' => $market_id, 'instrument_id' => $instrument_id],
                    [
                        'open' => $index_ohlc[$instrument_id]['open'],
                        'high' => $index_ohlc[$instrument_id]['high'],
                        'low' => $index_ohlc[$instrument_id]['low'],
                        'close' => $index_ohlc[$instrument_id]['close'],
                        'volume' => $ds30Volume,
                        'trade' => $ds30Trade,
                        'tradevalues' => $ds30TradeValues,
                        'updated' => date('Y-m-d H:i:s'),
                        'date' => $trade_date
                    ]
                );


                ///////////////////////// Intraday Data DS30 \\\\\\\\\\\\\\\\\\\\\\\\\\


                $temp = array();
                $temp['market_id'] = $market_id;
                $temp['instrument_id'] = $instrument_id;
                $temp['open_price'] = $index_ohlc[$instrument_id]['open'];
                $temp['pub_last_traded_price'] = $index_ohlc[$instrument_id]['close'];
                $temp['high_price'] = $index_ohlc[$instrument_id]['high'];
                $temp['low_price'] = $index_ohlc[$instrument_id]['low'];
                $temp['close_price'] = $index_ohlc[$instrument_id]['close'];
                $temp['total_trades'] = $ds30Trade;
                $temp['total_volume'] = $ds30Volume;
                $temp['total_value'] = $ds30TradeValues;
                $temp['lm_date_time'] = date('Y-m-d H:i:s', strtotime($index_ohlc[$instrument_id]['date_time']));
                $temp['trade_time'] = date('H:i', strtotime($index_ohlc[$instrument_id]['date_time']));
                $temp['trade_date'] = date('Y-m-d', strtotime($index_ohlc[$instrument_id]['date_time']));
                $IntradayDataToSave[]= $temp;


                if (!empty($IntradayDataToSave)) {

                    DB::table('data_banks_intradays')->insert($IntradayDataToSave);
                    $this->info(count($IntradayDataToSave) . ' index data inserted into data_banks_intradays');
                }

            }
            else
            {
                // Its not returning today data. We will just send a message in console
                $this->info('Dse returning previous data');
            }


        }

    }
}
