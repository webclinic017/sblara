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



class ParseMstCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dse:ParseMst';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parsing mst.tx file from dse site';

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


// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan dse:ParseMst
    public function handle()
    {


        set_time_limit(0);

        $mstDateString = "TODAY'S SHARE MARKET";
        $mstDateString = "TODAY'S SHARE MARKET";
        $dateArr = array();

        $oddLotArr = array();
        $oddLotStr = "Instr Code    Max Price    Min Price    Trades    Quantity   Value(In Mn)";
        $oddlotEndStr = "Total number of scrips traded in Oddlot";
        $oddLotStart = false;


        $blockLotArr = array();
        $blockLotStr = "PRICES IN BLOCK TRANSACTIONS";
        $blockLotEndStr = "Total number of scrips traded in Block";
        $blockLotStart = false;


        $marketMetaData = array();


        include(app_path() . '/Text2Array/text2array.php');

        $dataObj = new \Text2Array ();
        $page = getWebPage('http://www.dsebd.org/mst.txt');


        foreach (file('yourfile.txt') as $line) {
            // loop with $line for each line of yourfile.txt
        }


        $dataObj->setTextData($page);
        $rawData = $dataObj->getArrayData();

        /*for($i=0;$i<20;$i++)
        {
            dump(" $i ) ". $rawData[$i]);
        }*/
dd($rawData[4]);
        /*

         * Retrieving Various data

         * */


        foreach ($rawData as $key => $data) {

            // parsing mst date
            dump($data);
            if (strstr($data, $mstDateString)) {
                $dateArr = explode(':', $data);
                $mstDate = trim($dateArr[1]);
            }else
            {
                continue;
            }


            // Checking if odd lot starting string matches. If matches line will be added in $oddLotArr array

            if (strstr($data, $oddLotStr)) {
                $oddLotStart = true;
            }



            /* Checking if odd lot ending string matches. If matches flag is set to false
            so that no more line will be added to $oddLotArr afterward.
            */

            if (strstr($data, $oddlotEndStr)) {

                $oddLotStart = false;

            }



            // adding odd lot line in the array to process it later

            if ($oddLotStart) {
                $oddLotArr[] = $data;
            }


            // Checking if block lot starting string matches. If matches line will be added in $blockLotArr array

            if (strstr($data, $blockLotStr)) {
                $blockLotStart = true;
            }


            /* Checking if block lot ending string matches. If matches flag is set to false
            so that no more line will be added to $blockLotArr afterward.
            */

            if (strstr($data, $blockLotEndStr)) {
                $blockLotStart = false;
            }


            // adding block lot line in the array to process it later

            if ($blockLotStart) {
                $blockLotArr[] = $data;

            }


            // adding other information in $marketMetaData array

            if (strstr($data, "1. EQUITY")) {

                $nospaces = preg_replace('/\s+/', ',', $data);

                $data2array = explode(',', $nospaces);

                $marketMetaData ['cap_equity'] = trim($data2array [4]);

            }

            if (strstr($data, "2. MUTUAL FUND")) {

                $nospaces = preg_replace('/\s+/', ',', $data);

                $data2array = explode(',', $nospaces);

                $marketMetaData ['cap_mutual_fund'] = trim($data2array [5]);

            }

            if (strstr($data, "3. DEBT SECURITIES")) {

                $nospaces = preg_replace('/\s+/', ',', $data);

                $data2array = explode(',', $nospaces);

                $marketMetaData ['cap_debt_sec'] = trim($data2array [5] + 0);

            }

            if (strstr($data, "TOTAL   ")) {

                $nospaces = preg_replace('/\s+/', ',', $data);

                $data2array = explode(',', $nospaces);

                $marketMetaData ['cap_total'] = trim($data2array [3] + 0);

            }

        }


        App::uses('CakeTime', 'Utility');

        if ($activeTradeDates = Market::validateTradeDate($mstDate)) {
            $this->info("$mstDate");
        }
        else
        {
            // Its not returning today data. We will just send a message in console
            $this->info('mst returning previous data');
        }

dd($marketMetaData);



    }
}
