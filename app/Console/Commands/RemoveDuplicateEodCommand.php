<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Repositories\InstrumentRepository;
use App\Market;

class RemoveDuplicateEodCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plugin:removeDuplicateEod';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove duplicate from eod data';

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



// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan plugin:removeDuplicateEod

    public function handle()
    {

        $instrumentList = InstrumentRepository::getInstrumentsScripWithIndex();
        foreach($instrumentList as $ins)
        {
            $instrument_id=$ins->id;
            //$instrument_id=146;
            dump("started cleaning  ". $ins->instrument_code);
            $data = DB::select("SELECT id,market_id,instrument_id,volume  FROM `data_banks_eods` where instrument_id=$instrument_id  ORDER BY market_id desc,volume desc");
            //dd($data);

            $all=array();
            $duplicateArr=array();
            foreach ($data as $row) {
                $temp = array();
                $temp['market_id'] = $row->market_id;
                $temp['volume'] = $row->volume;
                $temp['instrument_id'] = $row->instrument_id;
                $temp['id'] = $row->id;
                $all[$row->market_id][] = $temp;
                if(count($all[$row->market_id])>1) {
                    $duplicateArr[]= $all[$row->market_id];

                }
            }
            $del_id_arr=array();
            foreach($duplicateArr as $arr)
            {

                foreach($arr as $row)
                {
                    $del_id_arr[]=$row['id'];
                }

            }
            $ids=collect($del_id_arr)->implode(', ');
            //dd($ids);
            if(count($del_id_arr))
            DB::select("delete FROM `data_banks_eods` WHERE id in ($ids)");

            dump("Total ".count($del_id_arr)." Rows deleted\n\n");

        }



        $this->info('ok');
    }
}
