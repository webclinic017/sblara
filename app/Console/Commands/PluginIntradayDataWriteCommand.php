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
    protected $description = 'write last day intraday data to file';

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

        $data = $data->groupBy('market_id');

        $strToadd = '';

        foreach ($data as $trade_date => $instrumentData) {

            $instrumentData = $instrumentData->unique('total_volume')->values();


            $i = 0;
            foreach ($instrumentData as $row) {
                $last_minute_total_volume = $row->total_volume;

                if (isset($instrumentData[$i + 1]))
                    $prev_minute_of_lastminute_volume = $instrumentData[$i + 1]->total_volume;
                else {
                    $prev_minute_of_lastminute_volume = 0;

                }


                $last_minute_traded_vol = $last_minute_total_volume - $prev_minute_of_lastminute_volume;

                if ($last_minute_traded_vol < 0)  // skip some negative value specially for dsex
                    continue;

                $time_formated = $row['lm_date_time']->format('H:i');
                $date_formated = $row['lm_date_time']->format('d/m/Y');


                $strToadd .= $instrument_code . ',' . $time_formated . ',' . $date_formated . ',' . $row->close_price . ',' . $row->close_price . ',' . $row->close_price . ',' . $row->close_price . ',' . $last_minute_traded_vol . "\n";

                $i++;
            }

        }

        Storage::prepend($file, $strToadd);

        $zipper = new \Chumper\Zipper\Zipper;
        $files = glob(storage_path() . '/app/plugin/intra_last_day/*');
        $zipper->make(storage_path() . '/app/plugin/intra_last_day.zip')->add($files)->close();

    }


    // live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan plugin:writeLastIntra

    public function handle()
    {
        $file = "plugin/intra_last_day/data.txt";


        $tradeDate = Market::getActiveDates();
        $last_trade_date = $tradeDate->first()->trade_date->format('Y-m-d');
        $today = date('Y-m-d');

        //if ($today == $last_trade_date) {
        if (1) {
            $instrumentList = InstrumentRepository::getInstrumentsScripWithIndex();
            foreach ($instrumentList as $ins) {
                $instrument_id = $ins->id;
                dump("started  " . $ins->instrument_code);
                $data = DataBanksIntraday::whereDate('trade_date', $last_trade_date)->where('instrument_id', $instrument_id)->orderBy('lm_date_time', 'desc')->get();
                self::writeData($data, $ins->instrument_code, $file);
            }

            $this->info('Last day Intraday  data written to fie');

        } else {
            $this->info('Today is not trade date. SO no Intra data written to file');
        }


    }
}
