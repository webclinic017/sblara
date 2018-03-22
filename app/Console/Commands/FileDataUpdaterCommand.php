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



class FileDataUpdaterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dse:FileDataUpdater';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating file data';

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



// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan dse:FileDataUpdater
// source update_eods_and_intraday_data cron of old site
    public function handle()
    {

        $querystr = "select * from MKISTAT ORDER BY MKISTAT_LM_DATE_TIME DESC LIMIT 0 , 600";
        $dataFromDseServer = DB::connection('dse')->select($querystr);

        $this->info(count($dataFromDseServer) . ' row fetched from DSE server');

        if(!Market::isMarketOpen())
        {
            $this->info('market is not open');

        }
        else
        {
            $date_time = $dataFromDseServer[0]->MKISTAT_LM_DATE_TIME;
            $convertedTimestamp = strtotime($date_time);
            $trade_date = date('Y-m-d', $convertedTimestamp);


            // Market is open. Now we will check if dse server returning today's data. Sometimes dse return previous day data
            if($activeTradeDates=Market::validateTradeDate($trade_date))
            {
                // its returning today data. So we will proceed here
                $market_id=$activeTradeDates->id;
                $instrumentList = InstrumentRepository::getInstrumentsScripOnly();
                $instrumentList=$instrumentList->keyBy('instrument_code');

                $count=0;
                foreach ($dataFromDseServer as $data) {

                    $instrument_info=array();
                    if(isset($instrumentList[trim($data->MKISTAT_INSTRUMENT_CODE)]))
                    {
                        $instrument_info = $instrumentList[trim($data->MKISTAT_INSTRUMENT_CODE)];
                    }

                    $array=array();
                    if (count($instrument_info)) {
                        $instrument_id = $instrument_info->id;
                        $ltp = $data->MKISTAT_CLOSE_PRICE != 0 ? $data->MKISTAT_CLOSE_PRICE : ($data->MKISTAT_PUB_LAST_TRADED_PRICE != 0 ? $data->MKISTAT_PUB_LAST_TRADED_PRICE : $data->MKISTAT_SPOT_LAST_TRADED_PRICE);


                        $o = $data->MKISTAT_OPEN_PRICE;
                        $h= $data->MKISTAT_HIGH_PRICE;
                        $l=$data->MKISTAT_LOW_PRICE;
                        $c=$ltp;
                        $v=$data->MKISTAT_TOTAL_VOLUME;
                        $t=$data->MKISTAT_TOTAL_TRADES;
                        $tv=$data->MKISTAT_TOTAL_VALUE;
                        $d=$trade_date;

                        $array = array();
                        if($v>0)
                        {
                            $array[] = $o;
                            $array[] = $h;
                            $array[] = $l;
                            $array[] = $c;
                            $array[] = $v;
                            $array[] = $d;


                            $count++;

                        }
                        $csv = collect($array)->implode(',');
                        Storage::disk('local')->put("data/$instrument_id/eod/latest.txt", $csv);

                        }
                    else
                    {
                        //empty array storing
                        $array=array();
                        $csv = collect($array)->implode(',');
                        Storage::disk('local')->put("data/$instrument_id/eod/latest.txt", $csv);

                    }

         }
                $this->info("Total $count valid data written in file");

            }
            else
            {
                // Its not returning today data. We will just send a message in console
                $this->info('Dse returning previous data');
            }


        }

    }
}
