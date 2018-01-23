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



class UpdateDseNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dse:UpdateDseNews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching dse news from DSE MAN tables';

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


// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan dse:UpdateDseNews
    public function handle()
    {



            $querystr = "select * from MAN ORDER BY MAN_ANNOUNCEMENT_DATE_TIME ASC";
            $dataFromDseServer = DB::connection('dse')->select($querystr);

            $date_time = $dataFromDseServer[0]->MAN_ANNOUNCEMENT_DATE_TIME;
            $convertedTimestamp = strtotime($date_time);
            $trade_date = date('Y-m-d', $convertedTimestamp);


            // Market is open. Now we will check if dse server returning today's data. Sometimes dse return previous day data
            if($activeTradeDates=Market::validateTradeDate($trade_date))
            {
                // its returning today data. So we will proceed here
                $market_id=$activeTradeDates->id;
                $instrumentList = InstrumentRepository::getInstrumentsScripWithIndex();


                foreach($dataFromDseServer as $data)
                {
                    $instrument_info = $instrumentList->where('instrument_code', trim($data->MAN_ANNOUNCEMENT_PREFIX))->first();


                    if(!is_null($instrument_info))
                    {
                        $instrument_id = $instrument_info->id;
                    }
                    else
                    {
                        // some prefix like REGL, EXCH etc is not instrument. So we will set instrument_id =0 for these type of prefix
                        $instrument_id = 0;
                    }


                    $temp = array();
                    $temp['market_id'] = $market_id;
                    $temp['instrument_id'] = $instrument_id;
                    $temp['prefix'] = trim($data->MAN_ANNOUNCEMENT_PREFIX);
                    $temp['details'] = $data->MAN_ANNOUNCEMENT;
                    $temp['post_date'] = date('Y-m-d H:i:s', strtotime($data->MAN_ANNOUNCEMENT_DATE_TIME));
                    $temp['expire_date'] = date('Y-m-d H:i:s', strtotime($data->MAN_EXPIRY_DATE));
                    $temp['is_active'] = 1;

                    $dataToSave[] = $temp;


                }




                if (!empty($dataToSave)) {
                    //first delete all news of trade_date
                    DB::table('news')->where('market_id', $market_id)->delete();

                    // re insert all news of trade date.
                    DB::table('news')->insert($dataToSave);

                    $this->info(count($dataToSave) . ' row inserted into news');

                }

            }
            else
            {
                // Its not returning today data. We will just send a message in console
                $this->info('Dse returning previous data');
            }




    }
}
