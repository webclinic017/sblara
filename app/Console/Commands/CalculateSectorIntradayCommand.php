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



class CalculateSectorIntradayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dse:CalculateSectorIntraday';

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


// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan dse:CalculateSectorIntraday
    public function handle()
    {
        $timeStart = microtime(true);
        if(!Market::isMarketOpen())
        {
            $this->info('market is not open');

        }
        else
        {

            $trade_date_info=Market::getActiveDates(2);
            $market_id_today = $trade_date_info[0]->id;
            $market_id_yesterday = $trade_date_info[1]->id;


            $market_stats_data=MarketStatRepository::getMarketStatsData(array('cap_equity','cap_mutual_fund','cap_debt_sec','cap_total',),null);
            $cap_equity_yesterday=$market_stats_data[$market_id_yesterday]['cap_equity']->meta_value; // yesterday cap_equity is normally available during trade time. Today cap_equity will be available at the afternoon




            $index_data_today = IndexRepository::getIndexData(5);
            $dsex_index_data_today=$index_data_today['index'][10001]['data'];
            $dsex_index_value_today=$dsex_index_data_today[0]->capital_value;


            // taking yesterday corporate action only
            $corporate_action_data=CorporateActionRepository::getCorporateActionAll($trade_date_info[1]->trade_date->format('Y-m-d'),$trade_date_info[1]->trade_date->format('Y-m-d'));
            $adjustment_factor = array();

            foreach ($corporate_action_data as $row) {

                if ($row['action'] == 'stockdiv') {

                    $adjustment_factor[$row['instrument_id']]['instrument_id'] = $row['instrument_id'];
                    $adjustment_factor[$row['instrument_id']]['value'] = (100 + $row['value']) / 100;

                }

            }



          /*

            * @todo: There is a bug of negetive volume.

            * @todo: Reason: Same databankIntraday row can be included in getLastTradeInfo if it is not traded during the time interval

            * @todo: solution: We have to query lasttrade info based on trade_time and set this time into sector intraday. suppose generate

            * @todo: sector_intraday for 10:30 minute by pulling all row of databankintraday traded in 10:30. Then calculate for 10:31 minute in same procedure

            *

            * NOTE: It may be solved as we have taken data from databankIntraday order by id desc (previously order by trade_time)

            * */

            $data_banks_intraday_data=DataBanksIntradayRepository::getLatestTradeDataAll();

            $sector_list_data=SectorListRepository::getSectorList();
            $instrument_list=InstrumentRepository::getInstrumentsGroupBySector('id');

            $needed_fundamentals_of_listed_company=FundamentalRepository::getFundamentalDataAll(array('total_no_securities'));

            $total_information_sector = array();
            $sec = array();
            $tsym = array();
            $dataToSave = array();


            foreach ($instrument_list as $sector_id => $all_instrument_of_this_sector) {

                if($sector_id == 23)
                    continue;

                $total_contribution_sector = 0;
                $total_change_sector = 0;
                $total_change_per_sector = 0;
                $total_price_change_sector = 0;
                $total_volume_sector = 0;
                $total_value_sector = 0;
                $trade_time_arr=array();

                foreach ($all_instrument_of_this_sector as  $instrument_info) {

                    $instrument_id=$instrument_info->id;

                    if (!is_null($trade_data_of_this_instrument=$data_banks_intraday_data->where('instrument_id',$instrument_id)->first()))
                    {
                        if(!$trade_data_of_this_instrument->trade_time->isToday())
                        {
                             /*sometimes very first $data_banks_intraday_data returns previous day data.
                             This happen normally if calculateSectorIntray corn runs before any data inserted of today in the database
                             so we are avoiding this case*/
                            break;
                        }

                        $yday_close_price=$trade_data_of_this_instrument->yday_close_price;



                        if (!empty($adjustment_factor[$instrument_id])) {
                            $yday_close_price = $trade_data_of_this_instrument->yday_close_price / $adjustment_factor[$instrument_id]['value'];
                        }

                        $quote_bases_arr=explode('-',$trade_data_of_this_instrument->quote_bases);
                        $category=$quote_bases_arr[0];

                        if ($category != 'Z') {
                            $price_change = $trade_data_of_this_instrument->close_price-$yday_close_price;
                            $no_of_securities=$needed_fundamentals_of_listed_company['total_no_securities'][$instrument_id]->meta_value;
                            $total_impact_of_this_instrument = $price_change * $no_of_securities;



                            $increased_cap_equity = $cap_equity_yesterday +$total_impact_of_this_instrument;
                            $final_index = ($dsex_index_value_today * $increased_cap_equity) / $cap_equity_yesterday;

                            $index_change = $final_index - $dsex_index_value_today;
                            $index_change_per = $index_change / $dsex_index_value_today;

                            $total_change_sector += $index_change;
                            $total_change_per_sector += $index_change_per;
                            $total_contribution_for_this_instrument= $price_change? $index_change / abs($price_change):0;
                            $total_contribution_sector += $total_contribution_for_this_instrument;


                            $total_price_change_sector += $price_change;

                            $total_volume_sector += $trade_data_of_this_instrument->total_volume;
                            $total_value_sector += $trade_data_of_this_instrument->total_value;
                            // we will sort according to timestamp and use latest one later
                            $trade_time_arr[$trade_data_of_this_instrument->trade_time->timestamp]= $trade_data_of_this_instrument->trade_time;


                        }




                    }

                    $sector_info=$sector_list_data->where('id',$sector_id)->first();
                    $total_information_sector[$sector_id]['price_change'] = $total_price_change_sector;
                    $total_information_sector[$sector_id]['index_change_per'] = $total_change_per_sector;
                    $total_information_sector[$sector_id]['sector_name'] = $sector_info->name;
                    $total_information_sector[$sector_id]['index_change'] = $total_change_sector;
                    $total_information_sector[$sector_id]['contribution'] = $total_contribution_sector;
                    $total_information_sector[$sector_id]['volume'] = $total_volume_sector;
                    $total_information_sector[$sector_id]['value'] = $total_value_sector;

                    // $time = date('H:i',time());



                }

                $temp = array();
                $temp['market_id'] = $market_id_today;
                $temp['sector_list_id'] = $sector_id;
                $temp['index_change'] = $total_change_sector;
                $temp['index_change_per'] = $total_change_per_sector;
                $temp['price_change'] = $total_price_change_sector;
                $temp['volume'] = $total_volume_sector;
                $temp['value'] = $total_value_sector;
                $temp['contribution'] = $total_contribution_sector;
                $temp['index_date'] = $trade_date_info[0]->trade_date->format('Y-m-d');

                if($total_volume_sector) {

                    // we are taking latest time of this sector.
                    krsort($trade_time_arr);
                    $time_latest = array_values($trade_time_arr);
                    $temp['index_time']= $time_latest[0];

                    $dataToSave[] = $temp;
                }




            }


            if (!empty($dataToSave)) {
                DB::table('sector_intradays')->insert($dataToSave);
                $this->info(count($dataToSave) . ' row inserted into sector_intradays');

            }








        }

        $diff = microtime(true) - $timeStart;
        $sec = intval($diff);
        $micro = $diff - $sec;

        dump("Time:  " . round($micro * 1000, 4) . " ms");
    }
}
