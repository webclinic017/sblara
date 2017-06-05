<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Repositories\InstrumentRepository;
use App\Market;

class PluginEodDataWriteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plugin:writeLastEod';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'write last eod data to file';

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
    public function writeData($data, $instrumentList, $file)
    {
        $strToadd='';
        foreach ($data as $row) {
            $instrumentInfo = $instrumentList->where('id', $row->instrument_id);

            if (count($instrumentInfo)) {
                $instrument_code = $instrumentInfo->first()->instrument_code;
                $date_formated = date('d/m/Y', strtotime($row->date));
                $strToadd .= $instrument_code . ',' . $date_formated . ',' . $row->open . ',' . $row->high . ',' . $row->low . ',' . $row->close . ',' . $row->volume."\n";

            }

        }
        Storage::prepend($file, $strToadd);

        $zipper = new \Chumper\Zipper\Zipper;
        $files = glob(storage_path() .'/app/plugin/eod/*');
        $zipper->make(storage_path() .'/app/plugin/eod.zip')->add($files)->close();
    }

    // live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan plugin:writeLastEod
    //   /opt/cpanel/ea-php70/root/usr/bin/php /bin/composer.phar update

    public function handle()
    {
        $file = "plugin/eod/data.txt";
        $tradeDate = Market::getActiveDates();
        $last_trade_date = $tradeDate->first()->trade_date->format('Y-m-d');

        $instrumentList = InstrumentRepository::getInstrumentsScripWithIndex();

        $today=date('Y-m-d');

        if($today==$last_trade_date)
        {
            $data = DB::select("select instrument_id,open,high,low,close,volume,date from data_banks_eods where date='$last_trade_date' ORDER BY date desc");
            self::writeData($data, $instrumentList, $file);
            $this->info('Last day EOD data written to fie');

        }
        else
        {
            $this->info('Today is not trade date. SO no EOD data written to file');
        }



    }
}
