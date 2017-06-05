<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Market;
Use App\DataBanksIntraday;

class PluginIntradayDataWriteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plugin:writeLastIntra';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'write last minute intraday data to file';

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
                $time_formated = $row['lm_date_time']->format('H:i');
                $date_formated = $row['lm_date_time']->format('d/m/Y');

                $strToadd .= $instrument_code . ',' . $time_formated . ',' . $date_formated . ',' . $row->open_price . ',' . $row->high_price . ',' . $row->low_price . ',' . $row->close_price . ',' . $row->total_volume."\n";


            }

        }
       // dd($strToadd);
        Storage::prepend($file, $strToadd);

        $zipper = new \Chumper\Zipper\Zipper;
        $files = glob(storage_path() .'/app/plugin/intra/*');
        $zipper->make(storage_path() .'/app/plugin/intra.zip')->add($files)->close();

    }

    // live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan plugin:writeLastIntra
    public function handle()
    {
        $file="plugin/intra/data.txt";
        $tradeDate = Market::getActiveDates();
        $last_trade_date = $tradeDate->first()->trade_date->format('Y-m-d');
        $instrumentList = InstrumentRepository::getInstrumentsScripWithIndex();

        $today=date('Y-m-d');
       // $today='2017-04-06';

        if($today==$last_trade_date)
        {
            //$data= DataBanksIntradayRepository::getLatestTradeDataAll();
            $data= DataBanksIntraday::whereDate('trade_date',$last_trade_date)->groupBy('lm_date_time')->orderBy('lm_date_time', 'desc')->get();
            //dd($data->first());
            self::writeData($data, $instrumentList, $file);
            $this->info('Last day EOD data written to fie');

        }
        else
        {
            $this->info('Today is not trade date. SO no EOD data written to file');
        }



    }
}
