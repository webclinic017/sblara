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



class FileDataUpdaterIntraday60Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dse:FileDataUpdaterIntraday60';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating intraday 60 minutes file data';

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



// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan dse:FileDataUpdaterIntraday60
// source update_eods_and_intraday_data cron of old site
    public function handle()
    {
        $rustart = getrusage();

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


                        $date_time = $data->MKISTAT_LM_DATE_TIME;
                        $convertedTimestamp = strtotime($date_time);
                        $trade_date = date('Y-m-d', $convertedTimestamp);

                      //  if($trade_date != $activeTradeDates->trade_date)
                       //     continue;

                        $instrument_id = $instrument_info->id;
                        $ltp = $data->MKISTAT_CLOSE_PRICE != 0 ? $data->MKISTAT_CLOSE_PRICE : ($data->MKISTAT_PUB_LAST_TRADED_PRICE != 0 ? $data->MKISTAT_PUB_LAST_TRADED_PRICE : $data->MKISTAT_SPOT_LAST_TRADED_PRICE);

                        $c=$ltp;
                        $v=$data->MKISTAT_TOTAL_VOLUME;
                        $d=$trade_date;



                        ////////////////    Intraday data 60 minutes   \\\\\\\\\\\\\\\\\\\

                        $q = $convertedTimestamp % 3600;
                        $base_time_key = date('Y-m-d H:i', $convertedTimestamp - $q);


                        // ****************** V ***************** \\\

                        $file_path = "data/$instrument_id/intraday/60_minutes/latest/v.txt";
                        if (Storage::disk('local')->exists($file_path)) {

                            $today_data = Storage::get($file_path);
                            $today_data = explode(',', $today_data);
                            $last_updated_time_frame = $today_data[0];
                            //dump("last_updated_time_frame=$last_updated_time_frame");

                            $volume_data_on_file = $today_data;
                            //dump($volume_data_on_file);

                            if (isset($volume_data_on_file[0])) {
                                unset($volume_data_on_file[0]); // removing last update note
                                $total_volume_recorded = array_sum($volume_data_on_file);
                                $new_volume = $v - $total_volume_recorded;

                            } else {
                                $total_volume_recorded = 0;
                                $new_volume = $v - $total_volume_recorded;
                            }


                            if ($today_data[0] == $base_time_key) {
                                // if it is same within time-frame, we will just update the last value
                                //dump("same timeframe");


                                // dump($volume_data_on_file);
                                // dd($total_volume_recorded);


                                if ($new_volume>0) {
                                    // if new volume found
                                    $this_frame_volume = $today_data[count($today_data) - 1];
                                    $today_data[count($today_data) - 1] = $this_frame_volume + $new_volume;
                                    $csv = collect($today_data)->implode(',');
                                    Storage::disk('local')->put($file_path, $csv);

                                }
                            } else {
                                // if it is not same time-frame, 2 things can happen: 1. new time frame of same day or 2. old time frame of previous day
                                //dump("not same day");

                                $last_updated_trade_date = date('Y-m-d', strtotime($last_updated_time_frame));

                                if ($trade_date == $last_updated_trade_date) {
                                    // if it is new time-frame of same day, we will add new close value and update the reported time frame at the top of array

                                    if($new_volume>0)
                                    {
                                        $today_data[0] = $base_time_key;
                                        $today_data[] = $new_volume;
                                        $csv = collect($today_data)->implode(',');
                                        Storage::disk('local')->put($file_path, $csv);

                                    }

                                } else {
                                    // normally a new trade date started. so we have to reset file for new day
                                    $new_volume=0;
                                        $csv = "$base_time_key,$new_volume";
                                        Storage::disk('local')->put($file_path, $csv);


                                }

                            }

                        } else {
                            $new_volume= $v;

                            if ($new_volume > 0)
                            {
                                $csv = "$base_time_key,$new_volume";
                                Storage::disk('local')->put($file_path, $csv);

                            }
                        }


                        ///// IF NEW VOLUME=0 IT MEANS DUPLICATE DATA FROM DSE. SO WE WILL SKIP FOLLOWING CODE FROM HERE
                        if($new_volume<=0)
                            continue;




                        // ****************** O *****************\\\

                        $file_path = "data/$instrument_id/intraday/60_minutes/latest/o.txt";
                        if (Storage::disk('local')->exists($file_path))
                        {

                            $today_data = Storage::get($file_path);
                            $today_data= explode(',',$today_data);
                            $last_updated_time_frame = $today_data[0];
                            //dump("last_updated_time_frame=$last_updated_time_frame");

                            if($today_data[0]== $base_time_key)
                            {
                                // if it is same within time-frame, we will do nothing for open
                                //dump("same timeframe");

                            }else
                            {
                                // if it is not same time-frame, 2 things can happen: 1. new time frame of same day or 2. old time frame of previous day
                                //dump("not same day");

                                $last_updated_trade_date=date('Y-m-d',strtotime($last_updated_time_frame));

                                if($trade_date== $last_updated_trade_date)
                                {
                                    // if it is new time-frame of same day, we will add new close value and update the reported time frame at the top of array
                                    $today_data[0] = $base_time_key;
                                    $today_data[] = $c;
                                    $csv = collect($today_data)->implode(',');
                                    Storage::disk('local')->put($file_path, $csv);

                                }else
                                {
                                    // normally a new trade date started. so we have to reset file for new day
                                    $csv = "$base_time_key,$c";
                                    Storage::disk('local')->put($file_path, $csv);
                                }

                            }

                        }else
                        {
                            $csv="$base_time_key,$c";
                            Storage::disk('local')->put($file_path,$csv);
                        }

                        // ****************** H *****************\\\

                        $file_path = "data/$instrument_id/intraday/60_minutes/latest/h.txt";
                        if (Storage::disk('local')->exists($file_path))
                        {

                            $today_data = Storage::get($file_path);
                            $today_data= explode(',',$today_data);
                            $last_updated_time_frame = $today_data[0];
                            //dump("last_updated_time_frame=$last_updated_time_frame");

                            if($today_data[0]== $base_time_key)
                            {
                                // if it is same within time-frame, we will just update the last value
                                //dump("same timeframe");

                                $existing_high = $today_data[count($today_data) - 1];

                                if($existing_high<$c)
                                {
                                    // if new high found- update previous one
                                    $today_data[count($today_data) - 1] = $c;
                                    $csv = collect($today_data)->implode(',');
                                    Storage::disk('local')->put($file_path, $csv);
                                }

                            }else
                            {
                                // if it is not same time-frame, 2 things can happen: 1. new time frame of same day or 2. old time frame of previous day
                                //dump("not same day");

                                $last_updated_trade_date=date('Y-m-d',strtotime($last_updated_time_frame));

                                if($trade_date== $last_updated_trade_date)
                                {
                                    // if it is new time-frame of same day, we will add new close value and update the reported time frame at the top of array
                                    $today_data[0] = $base_time_key;
                                    $today_data[] = $c;
                                    $csv = collect($today_data)->implode(',');
                                    Storage::disk('local')->put($file_path, $csv);

                                }else
                                {
                                    // normally a new trade date started. so we have to reset file for new day
                                    $csv = "$base_time_key,$c";
                                    Storage::disk('local')->put($file_path, $csv);
                                }

                            }

                        }else
                        {
                            $csv="$base_time_key,$c";
                            Storage::disk('local')->put($file_path,$csv);
                        }

                        // ****************** L *****************\\\

                        $file_path = "data/$instrument_id/intraday/60_minutes/latest/l.txt";
                        if (Storage::disk('local')->exists($file_path))
                        {

                            $today_data = Storage::get($file_path);
                            $today_data= explode(',',$today_data);
                            $last_updated_time_frame = $today_data[0];
                            //dump("last_updated_time_frame=$last_updated_time_frame");

                            if($today_data[0]== $base_time_key)
                            {
                                // if it is same within time-frame, we will just update the last value
                                //dump("same timeframe");
                                $existing_low = $today_data[count($today_data) - 1];

                                if ($existing_low > $c) {
                                    // if new low found- update previous one
                                    $today_data[count($today_data) - 1] = $c;
                                    $csv = collect($today_data)->implode(',');
                                    Storage::disk('local')->put($file_path, $csv);
                                }
                            }else
                            {
                                // if it is not same time-frame, 2 things can happen: 1. new time frame of same day or 2. old time frame of previous day
                                //dump("not same day");

                                $last_updated_trade_date=date('Y-m-d',strtotime($last_updated_time_frame));

                                if($trade_date== $last_updated_trade_date)
                                {
                                    // if it is new time-frame of same day, we will add new close value and update the reported time frame at the top of array
                                    $today_data[0] = $base_time_key;
                                    $today_data[] = $c;
                                    $csv = collect($today_data)->implode(',');
                                    Storage::disk('local')->put($file_path, $csv);

                                }else
                                {
                                    // normally a new trade date started. so we have to reset file for new day
                                    $csv = "$base_time_key,$c";
                                    Storage::disk('local')->put($file_path, $csv);
                                }

                            }

                        }else
                        {
                            $csv="$base_time_key,$c";
                            Storage::disk('local')->put($file_path,$csv);
                        }

                        // ****************** C *****************\\\

                        $file_path = "data/$instrument_id/intraday/60_minutes/latest/c.txt";
                        if (Storage::disk('local')->exists($file_path))
                        {

                            $today_data = Storage::get($file_path);
                            $today_data= explode(',',$today_data);
                            $last_updated_time_frame = $today_data[0];
                            //dump("last_updated_time_frame=$last_updated_time_frame");

                            if($today_data[0]== $base_time_key)
                            {
                                // if it is same within time-frame, we will just update the last value
                                //dump("same timeframe");

                                if($today_data[count($today_data) - 1]!=$c)
                                {
                                    // if same close price. no need to update
                                    $today_data[count($today_data) - 1] = $c;
                                    $csv = collect($today_data)->implode(',');
                                    Storage::disk('local')->put($file_path, $csv);

                                }
                            }else
                            {
                                // if it is not same time-frame, 2 things can happen: 1. new time frame of same day or 2. old time frame of previous day
                                //dump("not same day");

                                $last_updated_trade_date=date('Y-m-d',strtotime($last_updated_time_frame));

                                if($trade_date== $last_updated_trade_date)
                                {
                                    // if it is new time-frame of same day, we will add new close value and update the reported time frame at the top of array
                                    $today_data[0] = $base_time_key;
                                    $today_data[] = $c;
                                    $csv = collect($today_data)->implode(',');
                                    Storage::disk('local')->put($file_path, $csv);

                                }else
                                {
                                    // normally a new trade date started. so we have to reset file for new day
                                    $csv = "$base_time_key,$c";
                                    Storage::disk('local')->put($file_path, $csv);
                                }

                            }

                        }else
                        {
                            $csv="$base_time_key,$c";
                            Storage::disk('local')->put($file_path,$csv);
                        }


                        // ****************** C *****************\\\

                        $file_path = "data/$instrument_id/intraday/60_minutes/latest/c.txt";
                        if (Storage::disk('local')->exists($file_path)) {

                            $today_data = Storage::get($file_path);
                            $today_data = explode(',', $today_data);
                            $last_updated_time_frame = $today_data[0];
                            //dump("last_updated_time_frame=$last_updated_time_frame");

                            if ($today_data[0] == $base_time_key) {
                                // if it is same within time-frame, we will just update the last value
                                //dump("same timeframe");
                                $today_data[count($today_data) - 1] = $c;
                                $csv = collect($today_data)->implode(',');
                                Storage::disk('local')->put($file_path, $csv);
                            } else {
                                // if it is not same time-frame, 2 things can happen: 1. new time frame of same day or 2. old time frame of previous day
                                //dump("not same day");

                                $last_updated_trade_date = date('Y-m-d', strtotime($last_updated_time_frame));

                                if ($trade_date == $last_updated_trade_date) {
                                    // if it is new time-frame of same day, we will add new close value and update the reported time frame at the top of array
                                    $today_data[0] = $base_time_key;
                                    $today_data[] = $c;
                                    $csv = collect($today_data)->implode(',');
                                    Storage::disk('local')->put($file_path, $csv);

                                } else {
                                    // normally a new trade date started. so we have to reset file for new day
                                    $csv = "$base_time_key,$c";
                                    Storage::disk('local')->put($file_path, $csv);
                                }

                            }

                        } else {
                            $csv = "$base_time_key,$c";
                            Storage::disk('local')->put($file_path, $csv);
                        }




                        // ****************** D *****************\\\

                        $file_path = "data/$instrument_id/intraday/60_minutes/latest/d.txt";
                        if (Storage::disk('local')->exists($file_path))
                        {

                            $today_data = Storage::get($file_path);
                            $today_data= explode(',',$today_data);
                            $last_updated_time_frame = $today_data[0];
                            //dump("last_updated_time_frame=$last_updated_time_frame");

                            if($today_data[0]== $base_time_key)
                            {
                                // if it is same within time-frame, we will do nothing
                                //dump("same timeframe");

                            }else
                            {
                                // if it is not same time-frame, 2 things can happen: 1. new time frame of same day or 2. old time frame of previous day
                                //dump("not same day");

                                $last_updated_trade_date=date('Y-m-d',strtotime($last_updated_time_frame));

                                if($trade_date== $last_updated_trade_date)
                                {
                                    // if it is new time-frame of same day, we will add new close value and update the reported time frame at the top of array
                                    $today_data[0] = $base_time_key;
                                    $today_data[] = $base_time_key;
                                    $csv = collect($today_data)->implode(',');
                                    Storage::disk('local')->put($file_path, $csv);

                                }else
                                {
                                    // normally a new trade date started. so we have to reset file for new day
                                    $csv = "$base_time_key,$base_time_key";
                                    Storage::disk('local')->put($file_path, $csv);
                                }

                            }

                        }else
                        {
                            $csv="$base_time_key,$base_time_key";
                            Storage::disk('local')->put($file_path,$csv);
                        }




                        }
                    else
                    {


                    }

         }
                //$this->info("Total $count valid data written in file");

            }
            else
            {
                // Its not returning today data. We will just send a message in console
                $this->info('Dse returning previous data');
            }


        }


        $ru = getrusage();
        $this->info("This process used " . rutime($ru, $rustart, "utime") .
            " ms for its computations\n");
        $this->info("It spent " . rutime($ru, $rustart, "stime") .
            " ms in system calls\n");

    }
}
