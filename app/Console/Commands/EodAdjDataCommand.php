<?php

namespace App\Console\Commands;

use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBankEodRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Market;

class EodAdjDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filter:EodAdjDataCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unadjusted EOD data writing to file';

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

// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/stock/sbdev/artisan filter:EodAdjData
//php 7 is returning 2 digit after decimal but php 71 returning 14 digit . see https://stackoverflow.com/questions/41824959/json-encode-adding-lots-of-decimal-digits
// we have set precision = 14  and serialize_precision = -1 for php 7.1 from whm

    public function handle()
    {


        $trade_date = date('Y-m-d');

        if ($activeTradeDates = Market::validateTradeDate($trade_date))
        //if (1)
        {

            $rustart = getrusage();

            $latest_data=DataBanksIntradayRepository::getLatestTradeDataAll()->keyBy('instrument_id');

            $instrument_list=InstrumentRepository::getInstrumentsScripWithIndex();
            $from= strtotime('-1 year');
            $to= time();
            foreach($instrument_list as $instrument)
            {

                $instrument_id= $instrument->id;
                $eodData = DataBankEodRepository::getEodDataAdjusted($instrument_id, $from, $to,0);

                $d = array();
                $o = array();
                $h = array();
                $l = array();
                $c = array();
                $v = array();

                if (count($eodData)) {

                    //for($i=count($eodData)-1;$i>=0;$i--)
                    for($i=0;$i<count($eodData);$i++)
                    {
                        $data=$eodData[$i];
                        $d[]= date('Y-m-d',$data['date_timestamp']);
                        $o[]= $data['open'];
                        $h[]= $data['high'];
                        $l[]= $data['low'];
                        $c[]= $data['close'];
                        $v[]= $data['volume'];
                    }


                    $d=collect($d);
                    $o=collect($o);
                    $h=collect($h);
                    $l=collect($l);
                    $c=collect($c);
                    $v=collect($v);

                    $file_path = "data/$instrument_id/eod/adjusted";
/*
                    $file = "$file_path/d.php";
                    $array = $d->toArray();
                    $content = '<?php return  ' . var_export($array, true) . ';';
                    Storage::disk('local')->put($file, $content);


                    $file = "$file_path/o.php";
                    $csv = $o->implode(',');
                    self::writeData($file, $csv);

                    $file = "$file_path/h.php";
                    $csv = $h->implode(',');
                    self::writeData($file, $csv);


                    $file = "$file_path/l.php";
                    $csv = $l->implode(',');
                    self::writeData($file, $csv);


                    $file = "$file_path/c.php";
                    $csv = $c->implode(',');
                    self::writeData($file, $csv);

                    $file = "$file_path/v.php";
                    $csv = $v->implode(',');
                    self::writeData($file, $csv);*/

                    $update_date=$d[0];

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


                    /*$file = "$file_path/d.txt";
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
