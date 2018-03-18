<?php

namespace App\Console\Commands;

use App\Repositories\InstrumentRepository;
use App\Repositories\DataBankEodRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Market;

class MonthlyAdjDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filter:MonthlyAdjDataCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weekly adjusted EOD data writing to file';

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


    public function writeData($file, $csv)
    {
        $content = '<?php ';
        $content .= "return [";
        $content .= $csv;
        $content .= "];";
        Storage::disk('local')->put($file, $content);
    }

// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/stock/sbdev/artisan filter:MonthlyAdjData
//php 7 is returning 2 digit after decimal but php 71 returning 14 digit . see https://stackoverflow.com/questions/41824959/json-encode-adding-lots-of-decimal-digits
// we have set precision = 14  and serialize_precision = -1 for php 7.1 from whm

    public function handle()
    {


        $trade_date = date('Y-m-d');

        if ($activeTradeDates = Market::validateTradeDate($trade_date))
       // if (1)
        {

            $rustart = getrusage();

            $instrument_list=InstrumentRepository::getInstrumentsScripWithIndex();
            $from= strtotime('-10 years');
            $to= time();
            foreach($instrument_list as $instrument)
            {

                $instrument_id= $instrument->id;
                //$instrument_id= 13;
                $eodData = DataBankEodRepository::getEodDataAdjusted($instrument_id, $from, $to,0);

                if (count($eodData)) {

                    $monthly_grouped=array();
                    foreach($eodData as $data)
                    {
                        $key=date('m-y', $data['date_timestamp']);
                        $monthly_grouped[$key][]= $data;
                    }


                   // $monthly_grouped = array_reverse($monthly_grouped, true);


                    $d=array();
                    $o=array();
                    $h=array();
                    $l=array();
                    $c=array();
                    $v=array();
                    foreach($monthly_grouped as $month=>$data)
                    {
                        $first_day_of_month= $data[count($data) - 1];
                        $last_day_of_month= $data[0];


                        $date = date('Y-m-d', $first_day_of_month['date_timestamp']);
                        $open= $first_day_of_month['open'];
                        $close= $last_day_of_month['close'];
                        $high=collect($data)->max('high');
                        $low=collect($data)->min('low');
                        $volume = collect($data)->sum('volume');


                        $d[]= $date;
                        $o[]= $open;
                        $h[]= $high;
                        $l[]= $low;
                        $c[]= $close;
                        $v[]= $volume;

                    }




                    $d=collect($d);
                    $o=collect($o);
                    $h=collect($h);
                    $l=collect($l);
                    $c=collect($c);
                    $v=collect($v);

                    $file_path = "data/$instrument_id/monthly/adjusted";
                    $update_date=date('Y-m-d', $eodData[0]['date_timestamp']);

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
