<?php

namespace App\Console\Commands;

use App\Repositories\InstrumentRepository;
use App\Repositories\DataBankEodRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Market;

class FileDataUpdaterIntraday1Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dse:FileDataUpdaterIntraday1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '1 Minute adjusted data writing to file';

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



// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/stock/sbdev/artisan dse:FileDataUpdaterIntraday1

    public function handle()
    {


        $trade_date = date('Y-m-d');

        //if ($activeTradeDates = Market::validateTradeDate($trade_date))
        if (1)
        {

            $rustart = getrusage();

            $instrument_list=InstrumentRepository::getInstrumentsScripWithIndex();
            $market=Market::getActiveDates();
            $market_closed_time=date('H:i',strtotime($market[0]->market_closed));
            //$instrument_list2[13]=$instrument_list[13];
            $amibroker_data=array();
            foreach($instrument_list as $instrument)
            {

                $instrument_id= $instrument->id;



                $sql="select DISTINCT(total_volume),instrument_id,open_price,close_price,pub_last_traded_price,spot_last_traded_price,UNIX_TIMESTAMP(lm_date_time) as date_timestamp
from data_banks_intradays
where lm_date_time >= '2018-04-26' and instrument_id=$instrument_id
ORDER BY lm_date_time asc ,total_volume asc";

                $all_data = \DB::select($sql);
                $update_date='';
                if (count($all_data)) {

                    $grouped=array();
                    foreach($all_data as $data)
                    {

                        $ltp=$data->spot_last_traded_price?$data->spot_last_traded_price:$data->pub_last_traded_price;
                        $data->ltp=$ltp;
                        $day_key=date('Y-m-d', $data->date_timestamp);

                   //     dump($day_key);
                    //    dump($market);
                    //    dd($market[0]->market_closed);

                        // deducting 60 seconds so that 2.30 PM data includes in previous base_time_key (here 2.15 PM)
                        $data->date_timestamp_original = $data->date_timestamp;

                        $market_closed = strtotime("$day_key " . $market_closed_time);

                        if ($data->date_timestamp >= $market_closed)
                            $data->date_timestamp = $market_closed - 0;  // forcing to be included into last candle of the day

                        $q=$data->date_timestamp%60;

                        $base_time_key=date('Y-m-d H:i', $data->date_timestamp-$q);

                        $time=date('H:i:s', $data->date_timestamp);


                        $data->time=$time;
                        $grouped[$day_key][$base_time_key][]= $data;
                        $update_date = $base_time_key;
                    }




                    //$weekly_grouped = array_reverse($weekly_grouped, true);


                    $d=array();
                    $o=array();
                    $h=array();
                    $l=array();
                    $c=array();
                    $v=array();

                    foreach($grouped as $trade_date=>$all_day_data)
                    {
                        $last_total_volume=0;
                        $count=0;
                        foreach($all_day_data as $base_time=>$grouped_by_time_frame_data)
                        {
                            //if($count>5)  break;


                            $first_data= $grouped_by_time_frame_data[0];
                            $last_data= $grouped_by_time_frame_data[count($grouped_by_time_frame_data) - 1];


                            $date = $base_time;
                            if($count==0)
                            {
                                // its first data of the day. day open will be counted for very first data
                                $open= $first_data->open_price;

                            }else
                            {
                                $open= $first_data->ltp;
                            }

                            $close= $last_data->ltp;  // ltp will be used in intraday . close_price will be used in EOD
                            $high=collect($grouped_by_time_frame_data)->max('ltp');
                            $low=collect($grouped_by_time_frame_data)->min('ltp');
                           // $volume = collect($grouped_by_time_frame_data)->sum('total_volume');

                            $volume=$last_data->total_volume-$last_total_volume;

                            //dump($grouped_by_time_frame_data);
                           // dump("o=$open h=$high l= $low c=$close v=$volume d=$date");
                        //    dump($last_data->total_volume."-".$last_total_volume."= $volume");

                            $last_total_volume=$last_data->total_volume;
                            $d[]= $date;
                            $o[]= $open;
                            $h[]= $high;
                            $l[]= $low;
                            $c[]= $close;
                            $v[]= $volume;
                            $temp=array();
                            $temp[]=$instrument_id;
                            $temp[]=$close;
                            $temp[]=$volume;
                            $temp[]=$date;
                            $amibroker_data[]=$temp;

                            $count++;
                        }



                    }



                    $d=collect(array_reverse($d));
                    $o=collect(array_reverse($o));
                    $h=collect(array_reverse($h));
                    $l=collect(array_reverse($l));
                    $c=collect(array_reverse($c));
                    $v=collect(array_reverse($v));

                    $file_path = "data/$instrument_id/intraday/1_minutes/latest";


                    $file = "$file_path/d.txt";
                    $csv = $d->implode(',');
                    $csv="$update_date,$csv";
                    Storage::disk('local')->put($file, $csv);


                    $file = "$file_path/o.txt";
                    $csv = $o->implode(',');
                    $csv="$update_date,$csv";
                    Storage::disk('local')->put($file, $csv);

                    $file = "$file_path/h.txt";
                    $csv = $h->implode(',');
                    $csv="$update_date,$csv";
                    Storage::disk('local')->put($file, $csv);


                    $file = "$file_path/l.txt";
                    $csv = $l->implode(',');
                    $csv="$update_date,$csv";
                    Storage::disk('local')->put($file, $csv);


                    $file = "$file_path/c.txt";
                    $csv = $c->implode(',');
                    $csv="$update_date,$csv";
                    Storage::disk('local')->put($file, $csv);

                    $file = "$file_path/v.txt";
                    $csv = $v->implode(',');
                    $csv="$update_date,$csv";
                    Storage::disk('local')->put($file, $csv);

                }



            }


            $file = "data/amibroker/intraday_data.txt";
            $encodedString = json_encode($amibroker_data, JSON_NUMERIC_CHECK);
            Storage::disk('local')->put($file, $encodedString);

            $ru = getrusage();
            $this->info("This process used " . rutime($ru, $rustart, "utime") .
                " ms for its computations\n");
            $this->info("It spent " . rutime($ru, $rustart, "stime") .
                " ms in system calls\n");

        } else {
            // Its not returning today data. We will just send a message in console
            $this->info('Today is not Trading day. So no data updated');
        }

    }
}
