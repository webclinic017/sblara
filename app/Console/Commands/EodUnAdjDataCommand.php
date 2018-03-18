<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Market;
use Illuminate\Support\Facades\Mail;
use App\Mail\PortfolioReportMarkdown;
use App\Jobs\SendPortfolioEmail;

class EodUnAdjDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filter:EodUnAdjDataCommand';

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

// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/stock/sbdev/artisan filter:EodUnAdjData
//php 7 is returning 2 digit after decimal but php 71 returning 14 digit . see https://stackoverflow.com/questions/41824959/json-encode-adding-lots-of-decimal-digits
// we have set precision = 14  and serialize_precision = -1 for php 7.1 from whm

    public function handle()
    {


        $trade_date=date('Y-m-d');

        if($activeTradeDates=Market::validateTradeDate($trade_date))
        //if(1)
        {

            $rustart = getrusage();

            $sql = "select instrument_id,open,high,low,close,volume,date
from data_banks_eods
where date >= DATE_SUB(NOW(),INTERVAL 1 YEAR) ORDER BY DATE desc";

            $data = \DB::select($sql);

            $data = collect($data)->groupBy('instrument_id');

            foreach ($data as $instrument_id => $ohlc) {

                $o = $ohlc->pluck('open');
                $h = $ohlc->pluck('high');
                $l = $ohlc->pluck('low');
                $c = $ohlc->pluck('close');
                $v = $ohlc->pluck('volume');
                $d = $ohlc->pluck('date');

                $file_path = "data/$instrument_id/eod/unadjusted";


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


              /*  $file = "$file_path/d.txt";
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


                //Storage::append($file, $csv);

            }


            $ru = getrusage();
            $this->info("This process used " . rutime($ru, $rustart, "utime") .
                " ms for its computations\n");
            $this->info("It spent " . rutime($ru, $rustart, "stime") .
                " ms in system calls\n");

        }
        else
        {
            // Its not returning today data. We will just send a message in console
            $this->info('Today is not Trading day. So no data updated');
        }

    }
}
