<?php

namespace App\Console\Commands;

use App\Repositories\InstrumentRepository;
use App\Repositories\DataBankEodRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Market;

class IntradayData60MinutesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filter:IntradayData60MinutesCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '60 Minute adjusted data writing to file';

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



// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/stock/sbdev/artisan filter:IntradayData60Minutes

    public function handle()
    {


        $trade_date = date('Y-m-d');

        //if ($activeTradeDates = Market::validateTradeDate($trade_date))
        if (1)
        {

            $rustart = getrusage();

            $instrument_list=InstrumentRepository::getInstrumentsScripWithIndex();
            $from= strtotime('-5 years');
            $to= time();
            foreach($instrument_list as $instrument)
            {

                $instrument_id= $instrument->id;

                $sql = "select DISTINCT(total_volume),instrument_id,close_price,UNIX_TIMESTAMP(lm_date_time) as date_timestamp
from data_banks_intradays
where lm_date_time >= DATE_SUB(NOW(),INTERVAL 60 DAY) and instrument_id=$instrument_id ORDER BY lm_date_time asc ,total_volume asc";

                $all_data = \DB::select($sql);


                if (count($all_data)) {

                    $grouped=array();
                    foreach($all_data as $data)
                    {
                        $day_key=date('Y-m-d', $data->date_timestamp);

                        $q=$data->date_timestamp%3600;
                        $base_time_key=date('Y-m-d H:i', $data->date_timestamp-$q);

                        $time=date('H:i:s', $data->date_timestamp);
                        $data->time=$time;
                        $grouped[$day_key][$base_time_key][]= $data;
                    }


                    //dd($grouped);

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


                            //$date = date('Y-m-d H:i', $first_data->date_timestamp);
                            //$date = date('Y-m-d', $first_data->date_timestamp)." $base_time";
                            $date = $base_time;
                            $open= $first_data->close_price;
                            $close= $last_data->close_price;
                            $high=collect($grouped_by_time_frame_data)->max('close_price');
                            $low=collect($grouped_by_time_frame_data)->min('close_price');
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

                            //$count++;
                        }



                    }


                    $d=collect(array_reverse($d));
                    $o=collect(array_reverse($o));
                    $h=collect(array_reverse($h));
                    $l=collect(array_reverse($l));
                    $c=collect(array_reverse($c));
                    $v=collect(array_reverse($v));

                    $file_path = "data/$instrument_id/intraday/60_minutes/unadjusted";


                    $update_date=date('Y-m-d H:i', $all_data[count($all_data)-1]->date_timestamp);
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


                    /* $file = "$file_path/d.txt";
                     $array = $d->toArray();
                     $encodedString = json_encode($array, JSON_NUMERIC_CHECK);
                     Storage::disk('local')->put($file, $encodedString);


                     $file = "$file_path/o.txt";
                     $array = $o->toArray();
                     $encodedString = json_encode($array, JSON_NUMERIC_CHECK);
                     Storage::disk('local')->put($file, $encodedString);


                     $file = "$file_path/h.txt";
                     $array = $h->toArray();
                     $encodedString = json_encode($array, JSON_NUMERIC_CHECK);
                     Storage::disk('local')->put($file, $encodedString);


                     $file = "$file_path/l.txt";
                     $array = $l->toArray();
                     $encodedString = json_encode($array, JSON_NUMERIC_CHECK);
                     Storage::disk('local')->put($file, $encodedString);


                     $file = "$file_path/c.txt";
                     $array = $c->toArray();
                     $encodedString = json_encode($array, JSON_NUMERIC_CHECK);
                     Storage::disk('local')->put($file, $encodedString);

                     $file = "$file_path/v.txt";
                     $array = $v->toArray();
                     $encodedString = json_encode($array, JSON_NUMERIC_CHECK);
                     Storage::disk('local')->put($file, $encodedString);*/


                }



            }

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
