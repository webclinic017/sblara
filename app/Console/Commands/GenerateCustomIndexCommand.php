<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Repositories\InstrumentRepository;
use App\Repositories\SectorListRepository;
use App\Repositories\DataBanksIntradayRepository;
Use App\DataBanksIntraday;
use App\Repositories\CorporateActionRepository;
use App\Repositories\FundamentalRepository;
use App\Repositories\MarketStatRepository;
use App\Repositories\IndexRepository;



class GenerateCustomIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:generateCustomIndex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculating SBDSEGEN & TRDGEN. It is used in Index mover and running corn every minutes';

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



// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan index:generateCustomIndex
    public function handle()
    {
        $cap_equity = MarketStatRepository::getMarketStatsData(array('cap_equity'), null);
        $ob_cap_equity_today = $cap_equity->first();
        $ob_cap_equity_yesterday = $cap_equity->last();
        $cap_equity_yesterday = $ob_cap_equity_yesterday['cap_equity']['meta_value'];

        // DSEX is using here. instrument_id of dsex=10001

        $index_data_yesterday = IndexRepository::getIndexDataYesterday(10, null, 0);
        $trade_date_yesterday = $index_data_yesterday['index']['10001']['data'][0]->index_date->format('Y-m-d');
        $dsex_yesterday = $index_data_yesterday['index']['10001']['data'][0]->capital_value;
        $market_id_yesterday = $index_data_yesterday['index']['10001']['data'][0]->market_id;


        $index_data_today = IndexRepository::getIndexData(10, null, 0);
        $trade_date_today = $index_data_today['index']['10001']['data'][0]->index_date->format('Y-m-d');
        $market_id_today = $index_data_today['index']['10001']['data'][0]->market_id;





        // Taking today data of TRDGEN(10004)
        $trdgen_today=\App\DataBanksIntraday::where('instrument_id', 10004)->where('market_id', $market_id_today)->orderBy('lm_date_time', 'desc')->first();
        $last_trade_price_of_trdgen_today=$trdgen_today->pub_last_traded_price;



        $all_corporate_action_of_yesterday=CorporateActionRepository::getCorporateActionAll($trade_date_yesterday,$trade_date_yesterday);
        $adjustmentFactor=array();
        foreach($all_corporate_action_of_yesterday as $row)
        {
            if($row->action =='stockdiv')
            {
                $adjustmentFactor[$row->instrument_id]=(100+$row->value)/100;
            }
        }



        $instrument_list_of_dsex=FundamentalRepository::getFundamentalDataAll(array('dsex_listed'));
        $instrument_list_of_dsex=$instrument_list_of_dsex['dsex_listed']->where('meta_value','1');
        // extracting all instrument_id
        $instrument_id_of_all_dsex_listed_company=$instrument_list_of_dsex->pluck('instrument_id');


        $needed_fundamentals_of_dsex_listed_company=FundamentalRepository::getFundamentalData(array('total_no_of_securities','share_percentage_public'),$instrument_id_of_all_dsex_listed_company);


        $latestTradeDataAll=DataBanksIntradayRepository::getLatestTradeDataAll()->keyBy('instrument_id');


        $market_capital_public_yesterday=0;
        $market_capital_public_today=0;

        $total_change=0;

        foreach($instrument_id_of_all_dsex_listed_company as $instrument_id)
        {
            //checking if this share has been traded. If traded taking the $total_volume. Other wise setting the $total_volume=0
            if(isset($latestTradeDataAll[$instrument_id]))
            {

                if(isset($needed_fundamentals_of_dsex_listed_company['total_no_of_securities'][$instrument_id])) {
                    $total_no_of_securities = $needed_fundamentals_of_dsex_listed_company['total_no_of_securities'][$instrument_id]->meta_value;
                    dump($total_no_of_securities);
                }else
                {
                    $total_no_of_securities=0;

                    //send an email to rnd manager informing  that  $total_no_of_securities is missing for this share

                }
                if(isset($needed_fundamentals_of_dsex_listed_company['share_percentage_public'][$instrument_id]))
                {
                    $share_percentage_public=$needed_fundamentals_of_dsex_listed_company['share_percentage_public'][$instrument_id]->meta_value;

                }else
                {
                    $share_percentage_public=0;
                    //send an email to rnd manager informing  that  $share_percentage_public is missing for this share

                }

                $total_no_of_securities_public=$total_no_of_securities*$share_percentage_public/100;


                if(isset($adjustmentFactor[$instrument_id]))
                {
                    $yday_close_price=$latestTradeDataAll[$instrument_id]->yday_close_price;
                    $yday_close_price=$yday_close_price/$adjustmentFactor[$instrument_id];

                    $pub_last_traded_price=$latestTradeDataAll[$instrument_id]->pub_last_traded_price;
                    $market_capital_public_yesterday+=$total_no_of_securities_public*$yday_close_price;
                    $market_capital_public_today+=$total_no_of_securities_public*$pub_last_traded_price;



                    $price_change=$latestTradeDataAll[$instrument_id]->price_change;
                    $total_impact_for_this_instrument=$price_change*$total_no_of_securities;
                    $market_capital_increased_for_this_instrument=$cap_equity_yesterday+$total_impact_for_this_instrument;

                    $final_index=($dsex_yesterday+$market_capital_increased_for_this_instrument)/$cap_equity_yesterday;
                    $final_index_change=$final_index-$dsex_yesterday;
                    $total_change +=$final_index_change;




                }

            }else
            {
                $total_volume=0;
            }

        }

        $traded_index = ($last_trade_price_of_trdgen_today*$market_capital_public_today)/ $market_capital_public_yesterday;

        $dataToSave=array();
        $sbdsegen_data=array();
        $sbdsegen_pub_last_traded_price = $total_change+$dsex_yesterday;
        $sbdsegen_data['market_id']=$market_id_today;
        $sbdsegen_data['instrument_id']=10005;   // instrument id of SBDSEGEN=10005;
        $sbdsegen_data['open_price']=$sbdsegen_pub_last_traded_price;
        $sbdsegen_data['pub_last_traded_price']=$sbdsegen_pub_last_traded_price;
        $sbdsegen_data['high_price']=$sbdsegen_pub_last_traded_price;
        $sbdsegen_data['low_price']=$sbdsegen_pub_last_traded_price;
        $sbdsegen_data['close_price']=$sbdsegen_pub_last_traded_price;
        $sbdsegen_data['total_volume']=0;
        $sbdsegen_data['lm_date_time']=date('Y-m-d h:i:s',time());
        $sbdsegen_data['trade_time']=date('h:i:s',time());
        $sbdsegen_data['trade_date']=date('Y-m-d',time());
        $dataToSave[]=$sbdsegen_data;

        $trdgen_data=array();
        $trdgen_data['market_id']=$market_id_today;
        $trdgen_data['instrument_id']=10004;   // instrument id of TRDGEN=10004;
        $trdgen_data['open_price']=$traded_index;
        $trdgen_data['pub_last_traded_price']=$traded_index;
        $trdgen_data['high_price']=$traded_index;
        $trdgen_data['low_price']=$traded_index;
        $trdgen_data['close_price']=$traded_index;
        $trdgen_data['total_volume']=$market_capital_public_today;
        $trdgen_data['lm_date_time']=date('Y-m-d h:i:s',time());
        $trdgen_data['trade_time']=date('h:i:s',time());
        $trdgen_data['trade_date']=date('Y-m-d',time());
        $dataToSave[]=$trdgen_data;


        //$result = DataBanksIntraday::insert($dataToSave);

        $this->info('ok');
    }
}
