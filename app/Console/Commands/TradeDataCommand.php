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



class TradeDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dse:TradeData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching Trade data data every minutes from DSE TRD tables';

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



// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan dse:TradeData
// source update_eods_and_intraday_data cron of old site
    public function handle()
    {

        if(!Market::isMarketOpen())
        {
            $this->info('market is not open');

        }
        else
        {


            $querystr = "select * from TRD";
            $dataFromDseServer = DB::connection('dse')->select($querystr);

            $date_time = $dataFromDseServer[0]->TRD_LM_DATE_TIME;
            $convertedTimestamp = strtotime($date_time);
            $trade_date = date('Y-m-d', $convertedTimestamp);


            // Market is open. Now we will check if dse server returning today's data. Sometimes dse return previous day data
            if($activeTradeDates=Market::validateTradeDate($trade_date))
            {
                // its returning today data. So we will proceed here
                $market_id=$activeTradeDates->market_id;

                foreach($dataFromDseServer as $data)
                {
                    $data->TRD_LM_DATE_TIME = str_replace('at', '', $data->TRD_LM_DATE_TIME);

                    $temp = array();
                    $temp['market_id'] = $market_id;
                    $temp['TRD_SNO'] = $data->TRD_SNO;
                    $temp['TRD_TOTAL_TRADES'] = $data->TRD_TOTAL_TRADES;
                    $temp['TRD_TOTAL_VOLUME'] = $data->TRD_TOTAL_VOLUME;
                    $temp['TRD_TOTAL_VALUE'] = $data->TRD_TOTAL_VALUE;
                    $temp['TRD_LM_DATE_TIME'] = date('Y-m-d H:i:s', strtotime($data->TRD_LM_DATE_TIME));
                    $temp['trade_time'] = date('H:i', strtotime($data->TRD_LM_DATE_TIME));
                    $temp['trade_date'] = date('Y-m-d', strtotime($data->TRD_LM_DATE_TIME));

                    $dataToSave[] = $temp;


                }

                if (!empty($dataToSave)) {

                    DB::table('trades')->insert($dataToSave);

                    $this->info(count($dataToSave) . ' row inserted into trades');

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
