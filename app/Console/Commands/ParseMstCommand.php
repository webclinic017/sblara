<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Market;

use App\Repositories\InstrumentRepository;
use App\Repositories\MarketStatRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\DataBankEodRepository;
Use App\DataBanksIntraday;
use App\Repositories\CorporateActionRepository;
use App\Repositories\FundamentalRepository;
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

        $oddLotArr = array();
        $oddLotStr = "Instr Code    Max Price    Min Price    Trades    Quantity   Value(In Mn)";
        $oddlotEndStr = "Total number of scrips traded in Oddlot";
        $oddLotStart = false;


        $blockLotArr = array();
        $blockLotStr = "PRICES IN BLOCK TRANSACTIONS";
        $blockLotEndStr = "Total number of scrips traded in Block";
        $blockLotStart = false;


        $marketMetaData = array();

        $page = getWebPage('http://www.dsebd.org/mst.txt');
        $rawData = explode("\n", $page);

        foreach ($rawData as $key => $data) {

            // parsing mst date

            if (strstr($data, $mstDateString)) {
                $dateArr = explode(':', $data);
                $mstDate = trim($dateArr[1]);
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



        if ($activeTradeDates = Market::validateTradeDate($mstDate)) {
            $market_id = $activeTradeDates->id;
            $instrumentList = InstrumentRepository::getInstrumentsScripOnly();



            // processing block lot
            if (!empty($blockLotArr)) {

                $dataToSave = array();
                foreach ($blockLotArr as $data) {

                    $temp = array();
                    $data = trim($data);
                    $datalen = strlen($data);

                    // check if line (here $data) is not empty (len is greater than 70)
                    // 70 is taken just arbitrary. 70 will remove "------    --------    ------------" line too

                    if (70 < $datalen) {

                        // check if it is header line. We dont need it
                        if (strstr($data, "Instr Code")) {
                            continue;
                        }


                        //removing space between column. it will be like ACTIVEFINE,61.00,61.00,1,116000,7.076,
                        $nospaces = preg_replace('/\s+/', ',', $data);
                        $dataForBlockOutputs = explode(',', $nospaces);

                        $instrument_info = $instrumentList->where('instrument_code', trim($dataForBlockOutputs[0]))->first();
                        $instrumentId = $instrument_info->id;


                        $temp['market_id'] = $market_id;

                        $temp['instrument_id'] = $instrumentId;

                        $temp['max_price'] = $dataForBlockOutputs[1];

                        $temp['min_price'] = $dataForBlockOutputs[2];

                        $temp['trade'] = $dataForBlockOutputs[3];

                        $temp['volume'] = $dataForBlockOutputs[4];

                        $temp['tradevalues'] = $dataForBlockOutputs[5];

                        $temp['date'] = $mstDate;

                        $dataToSave[] = $temp;

                    }

                }


                if (!empty($dataToSave)) {
                    //first delete all news of trade_date
                    DB::table('data_bank_blocks')->where('market_id', $market_id)->delete();

                    // re insert all news of trade date.
                    DB::table('data_bank_blocks')->insert($dataToSave);

                    $this->info(count($dataToSave) . ' row inserted into data_bank_blocks');

                }

            }



            // processing odd lot

            if (!empty($oddLotArr)) {

                $dataToSave = array();
                foreach ($oddLotArr as $data) {

                    $temp = array();
                    $data = trim($data);
                    $datalen = strlen($data);

                    // check if line (here $data) is not empty (len is greater than 70)
                    // 70 is taken just arbitrary. 70 will remove "------    --------    ------------" line too

                    if (70 < $datalen) {

                        // check if it is header line. We dont need it
                        if (strstr($data, "Instr Code")) {
                            continue;
                        }


                        //removing space between column. it will be like ACTIVEFINE,61.00,61.00,1,116000,7.076,
                        $nospaces = preg_replace('/\s+/', ',', $data);
                        $dataForBlockOutputs = explode(',', $nospaces);


                        $instrument_info = $instrumentList->where('instrument_code', trim($dataForBlockOutputs[0]))->first();
                        $instrumentId = $instrument_info->id;


                        /*

                         * TODO: If instrument id not found it means new instrument availabale. So we have to add new instrument

                         * in instrument table. We have to add an email function to alert manager that you have not added

                         * new instrument yet

                         * */



                        $temp['market_id'] = $market_id;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['max_price'] = $dataForBlockOutputs[1];
                        $temp['min_price'] = $dataForBlockOutputs[2];
                        $temp['trade'] = $dataForBlockOutputs[3];
                        $temp['volume'] = $dataForBlockOutputs[4];
                        $temp['tradevalues'] = $dataForBlockOutputs[5];
                        $temp['date'] = $mstDate;
                        $dataToSave[] = $temp;

                    }

                }


                if (!empty($dataToSave)) {
                    //first delete all news of trade_date
                    DB::table('data_bank_oddlots')->where('market_id', $market_id)->delete();

                    // re insert all news of trade date.
                    DB::table('data_bank_oddlots')->insert($dataToSave);

                    $this->info(count($dataToSave) . ' row inserted into data_bank_oddlots');

                }

            }


            // Processing $marketMetaData

            if (!empty($marketMetaData)) {

                $dataToSave = array();
                if (!empty($marketMetaData['cap_equity'])) {

                    $temp = array();
                    $temp['market_id'] = $market_id;
                    $temp['meta_key'] = 'cap_equity';
                    $temp['meta_value'] = $marketMetaData['cap_equity'];
                    $temp['meta_date'] = $mstDate;

                    $dataToSave[] = $temp;

                }

                if (!empty($marketMetaData['cap_mutual_fund'])) {

                    $temp = array();
                    $temp['market_id'] = $market_id;
                    $temp['meta_key'] = 'cap_mutual_fund';
                    $temp['meta_value'] = $marketMetaData['cap_mutual_fund'];
                    $temp['meta_date'] = $mstDate;

                    $dataToSave[] = $temp;

                }

                if (!empty($marketMetaData['cap_debt_sec'])) {

                    $temp = array();
                    $temp['market_id'] = $market_id;
                    $temp['meta_key'] = 'cap_debt_sec';
                    $temp['meta_value'] = $marketMetaData['cap_debt_sec'];
                    $temp['meta_date'] = $mstDate;

                    $dataToSave[] = $temp;

                }

                if (!empty($marketMetaData['cap_total'])) {

                    $temp = array();
                    $temp['market_id'] = $market_id;
                    $temp['meta_key'] = 'cap_total';
                    $temp['meta_value'] = $marketMetaData['cap_total'];
                    $temp['meta_date'] = $mstDate;

                    $dataToSave[] = $temp;

                }

                if (!empty($dataToSave)) {

                   MarketStatRepository::saveMarketStatsData($dataToSave);
                    $this->info(count($dataToSave) . ' row inserted into market_stats');

                }

            }


        }
        else
        {
            // Its not returning today data. We will just send a message in console
            $this->info('mst returning previous data');
        }




    }
}
