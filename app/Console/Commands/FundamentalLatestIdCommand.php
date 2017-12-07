<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Market;
use App\DataBanksEod;
use App\Repositories\InstrumentRepository;
use App\Repositories\SectorListRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\DataBankEodRepository;
Use App\DataBanksIntraday;
use App\Repositories\CorporateActionRepository;
use App\Repositories\FundamentalRepository;
use App\Repositories\MarketStatRepository;
use App\Repositories\IndexRepository;



class FundamentalLatestIdCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:FundamentalLatestIdCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will update latest_id field of fundamental tables';

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


// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan data:FundamentalLatestIdCommand
    public function handle()
    {

        // first setting all is_latest=0

        DB::table('fundamentals')
            ->update(['is_latest' => 0]);


        // taking all existing meta_id from fundamentals table
        $all_meta_id=DB::table('fundamentals')->select('meta_id')->distinct()->get();

        foreach($all_meta_id as $row)
        {

            if($row->meta_id) // avoiding meta_id=0
            {
                $this->info("\n\nStarting Meta Id= ".$row->meta_id);
                $all_data_of_this_meta_id_grouped_by_instrument_id = DB::table('fundamentals')->where('meta_id', $row->meta_id)->get()->groupBy('instrument_id');

                foreach($all_data_of_this_meta_id_grouped_by_instrument_id as $instrument_id=>$all_meta_data_of_this_instrument)
                {
                    $this->info("        --- Processing Instrument Id = " . $instrument_id);
                    $sorting_arr = array();
                    foreach($all_meta_data_of_this_instrument as $meta_data)
                    {
                        $meta_date_timestamp=strtotime($meta_data->meta_date);
                        $sorting_arr[$meta_date_timestamp]= $meta_data->id;
                    }

                    krsort($sorting_arr);
                    //dd($sorting_arr);
                    $latest_id= array_values($sorting_arr)[0];

                    DB::table('fundamentals')
                        ->where('id', $latest_id)
                        ->update(['is_latest' => 1]);
                }

            }




        }
        //dd($all_meta_id);

    }
}
