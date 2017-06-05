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
       /* $file="plugin/eod/data.txt";
        //$heading = 'Code,Date,Open,High,Low,Close,Volume';
        $heading = '';
        Storage::disk('local')->put($file, $heading);

        $tradeDate=Market::getActiveDates();
        $last_trade_date= $tradeDate->first()->trade_date->format('Y-m-d');

        $instrumentList=InstrumentRepository::getInstrumentsScripWithIndex();*/

        $instrumentList = InstrumentRepository::getInstrumentsScripWithIndex();

        foreach($instrumentList as $ins)
        {
            $instrument_id=$ins->id;
            $instrument_id=146;
            dump("started processing ". $ins->instrument_code);
            $data = DB::select("SELECT id,market_id,instrument_id,volume  FROM `data_banks_eods2` where instrument_id=$instrument_id  ORDER BY market_id desc,volume asc");
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
                /*if(count($all[$row->market_id]>1)) {
                    $duplicateArr[]= $all[$row->market_id];
                    dd($duplicateArr);
                }*/

                $duplicateArr[$row->market_id]['volume']= $row->volume;
                $duplicateArr[$row->market_id]['id']= $row->id;
            }
            dd($duplicateArr);


        }



        $result = DB::select('SELECT count(id) as total FROM data_banks_eods2');
        $total_row= $result[0]->total;
        $id_to_delete = array();

        $all=array();
       // $total_row=50000;
        $limit=5000;
        for($i=0;$i<$total_row;$i=$i+ $limit)
        {
            dump(".... processing start=$i, limit=$limit");
            $data = DB::select("SELECT id,market_id,instrument_id,volume  FROM `data_banks_eods2` where instrument_id=146  ORDER BY id desc limit $i,$limit");


            foreach($data as $row)
            {
                $temp=array();
                $temp['market_id']= $row->market_id;
                $temp['instrument_id']= $row->instrument_id;
                $temp['volume']= $row->volume;
                $temp['id']= $row->id;
                $all[$row->instrument_id][$row->market_id][]= $temp;


                if(count($all[$row->instrument_id][$row->market_id])>1) {
                    $duplicate = array();

                    foreach($all[$row->instrument_id][$row->market_id] as $dup)
                    {
                        $duplicate[]= $dup;
                    }
                    $duplicate=collect($duplicate);
                    $duplicate=$duplicate->sortByDesc('volume');
                    $delIds=$duplicate->pluck('id');
                    unset($delIds[0]); // unsetting max volume
                    dump($all);
dd($delIds);
                    //dump($duplicate->sortByDesc('volume'));
                 //   dump("duplicate found");
                    $id_to_delete[]= $delIds;
                    $all[]= $temp;
                }
            }
        }

dd($id_to_delete);
        dd($all[]);



        $this->info('ok');
    }
}
