<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Repositories\InstrumentRepository;
use App\Market;

class PluginEodDataResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plugin:resetEod';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset eod file';

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
        foreach ($data as $row) {
            $instrumentInfo = $instrumentList->where('id', $row->instrument_id);

            if (count($instrumentInfo)) {
                $instrument_code = $instrumentInfo->first()->instrument_code;
                $date_formated = date('d/m/Y', strtotime($row->date));
                $strToadd = $instrument_code . ',' . $date_formated . ',' . $row->open . ',' . $row->high . ',' . $row->low . ',' . $row->close . ',' . $row->volume;

                Storage::append($file, $strToadd);

            }

        }
    }

// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan plugin:resetEod
    public function handle()
    {
        $file="plugin/eod/data.txt";
        $heading = 'Code,Date,Open,High,Low,Close,Volume';
        Storage::disk('local')->put($file, $heading);

        $tradeDate=Market::getActiveDates();
        $last_trade_date= $tradeDate->first()->trade_date->format('Y-m-d');

        $instrumentList=InstrumentRepository::getInstrumentsScripWithIndex();

        //$result = DB::select('SELECT count(id) as total FROM data_banks_eods');
        //$total_row= $result[0]->total;
        $total_row=100000;
        $limit=5000;
        for($i=0;$i<$total_row;$i=$i+ $limit)
        {
            dump(".... processing start=$i, limit=$limit");
            $data = DB::select("select instrument_id,open,high,low,close,volume,date from data_banks_eods where date<'$last_trade_date' ORDER BY date desc limit $i,$limit");
            self::writeData($data, $instrumentList, $file);
        }




        $this->info('ok');
    }
}
