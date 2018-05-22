<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Repositories\InstrumentRepository;
use App\Market;
Use App\DataBanksIntraday;

class PluginIntradayDataResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plugin:resetIntra';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Intraday data file';

    protected $debug = 0;

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



// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan plugin:resetIntra
    public function handle()
    {
        $file = "plugin/intra/data.txt";
        $heading = '';
        Storage::disk('local')->put($file, $heading);

        $instrument_list = InstrumentRepository::getInstrumentsScripWithIndex();
        //$instrument_list2[13]=$instrument_list[13];
        foreach ($instrument_list as $instrument) {

            $instrument_id = $instrument->id;
            $instrument_code = $instrument->instrument_code;


            $sql = "SELECT id,instrument_id,lm_date_time,open_price,high_price,low_price,close_price,new_volume,total_volume,pub_last_traded_price,spot_last_traded_price  FROM data_banks_intradays WHERE lm_date_time >= DATE_SUB(NOW(),INTERVAL 60 DAY) and instrument_id=$instrument_id ORDER BY lm_date_time ASC";
            $rawdata = \DB::select($sql);

            $this->info($instrument_code);


            $eod_data = array();
            $strToadd = '';
            foreach ($rawdata as $data) {

                if ($data->new_volume <= 0)  // skip some negative value specially for dsex
                    continue;
                $ltp = $data->pub_last_traded_price != 0 ? $data->pub_last_traded_price : $data->spot_last_traded_price;
                $volume = $data->new_volume;


                $date = date('d/m/Y', strtotime($data->lm_date_time));
                $time = date('H:i:s', strtotime($data->lm_date_time));

                $strToadd .= $instrument_code . ',' . $ltp . ',' . $ltp . ',' . $ltp . ','. $ltp . ','. $volume . ',' . $date. ',' . $time . "\n";


                $temp = array();

                $temp['o'] = $data->open_price;
                $temp['h'] = $data->high_price;
                $temp['l'] = $data->low_price;
                $temp['c'] = $data->close_price;
                $temp['v'] = $data->total_volume;
                $temp['d'] = date('d/m/Y', strtotime($data->lm_date_time));

                $eod_data[$temp['d']] = $temp;


            }

            foreach($eod_data as $eod)
            {
                $strToadd .= $instrument_code . ',' . $eod['o'] . ',' . $eod['h'] . ',' . $eod['l'] . ',' . $eod['c'] . ',' . $eod['v'] . ',' . $eod['d'] .',' . '12:00:00' . "\n";
            }


            Storage::append($file, $strToadd);


        }

        $zipper = new \Chumper\Zipper\Zipper;
        $files = glob(storage_path() . '/app/plugin/intra/*');
        $zipper->make(storage_path() . '/app/plugin/intra.zip')->add($files)->close();


        $this->info('Intraday data reset ok - run from test.stockbangladesh.com');
    }
}
