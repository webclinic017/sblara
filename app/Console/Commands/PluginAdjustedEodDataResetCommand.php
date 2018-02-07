<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBankEodRepository;
use App\Market;

class PluginAdjustedEodDataResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plugin:resetAdjustedEod';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset adjusted eod file';

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

    public function writeData($data, $instrument_code, $file)
    {
        $strToadd='';
        foreach ($data as $row) {
            $date_formated = date('d/m/Y', strtotime($row['date']));
            $strToadd .= $instrument_code . ',' . $date_formated . ',' . round($row['open'],2). ',' . round($row['high'],2) . ',' . round($row['low'],2) . ',' . round($row['close'],2) . ',' . round($row['volume'],0) . "\n";

        }
        Storage::append($file, $strToadd);



    }

// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan plugin:resetAdjustedEod

    public function handle()
    {
        $file="plugin/adjusted_eod/data.txt";
        //$heading = 'Code,Date,Open,High,Low,Close,Volume';
        $heading = '';
        Storage::disk('local')->put($file, $heading);

        $instrumentList=InstrumentRepository::getInstrumentsScripWithIndex();

        foreach ($instrumentList as $ins) {
            $instrument_id = $ins->id;
            echo "\n started  " . $ins->instrument_code;
            $to=date('Y-m-d');
            //$from='2007-01-01';
            $from='2007-01-01';
            $data=DataBankEodRepository::getEodDataAdjusted($instrument_id, $from,$to,0);

            self::writeData($data, $ins->instrument_code, $file);

//            dd($data->first());
        }
        $zipper = new \Chumper\Zipper\Zipper;
        $files = glob(storage_path() . '/app/plugin/adjusted_eod/*');
        $zipper->make(storage_path() . '/app/plugin/adjusted_eod.zip')->add($files)->close();

        $this->info('adjusted eod data written successfully');
    }
}
