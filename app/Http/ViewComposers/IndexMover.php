<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\FundamentalRepository;
use App\Repositories\InstrumentRepository;
use App\Repositories\CorporateActionRepository;
use App\Instrument;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\MarketStatRepository;
use App\Repositories\IndexRepository;
use Illuminate\Support\Facades\Cache;


class IndexMover
{
    /**
     * The index repository implementation.
     *
     * @var IndexRepository
     */

    /**
     * Create a new market_summary composer.
     *
     * @param  IndexRepository  $indexes
     * @return void
     */


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {


        //Cache::forget("index_mover");

        $indexmover = Cache::remember("index_mover", 1, function () {


            $instrument_list = InstrumentRepository::getInstrumentsScripOnly()->keyBy('id');


            $cap_equity = MarketStatRepository::getMarketStatsData(array('cap_equity'), null);
            $ob_cap_equity_today = $cap_equity->first();
            $ob_cap_equity_yesterday = $cap_equity->last();
            $cap_equity_yesterday = $ob_cap_equity_yesterday['cap_equity']['meta_value'];


            // DSEX is using here. instrument_id of dsex=10001

            $index_data_yesterday = IndexRepository::getIndexDataYesterday(10, null, 0);
            $trade_date_yesterday = $index_data_yesterday['index']['10001']['data'][0]->index_date->format('Y-m-d');
            $dsex_yesterday = $index_data_yesterday['index']['10001']['data'][0]->capital_value;
            $market_id_yesterday = $index_data_yesterday['index']['10001']['data'][0]->market_id;


            $index_data_today = IndexRepository::getIndexData(10, null, 0);
            $trade_date_today = $index_data_today['index']['10001']['data'][0]->index_date->format('Y-m-d');
            $market_id_today = $index_data_today['index']['10001']['data'][0]->market_id;


            $all_corporate_action_of_yesterday = CorporateActionRepository::getCorporateActionAll($trade_date_yesterday, $trade_date_yesterday);
            $adjustmentFactor = array();
            foreach ($all_corporate_action_of_yesterday as $row) {
                if ($row->action == 'stockdiv') {
                    $adjustmentFactor[$row->instrument_id] = (100 + $row->value) / 100;
                }
            }


            $instrument_list_of_dsex = FundamentalRepository::getFundamentalDataAll(array('dsex_listed'));
            $instrument_list_of_dsex = collect($instrument_list_of_dsex['dsex_listed'])->where('meta_value', '1');
            // extracting all instrument_id
            $instrument_id_of_all_dsex_listed_company = $instrument_list_of_dsex->pluck('instrument_id');


            // total_no_securities,public_share_per under meta_group=company_financial_performance
            $needed_fundamentals_of_dsex_listed_company = FundamentalRepository::getFundamentalData(array('total_no_securities', 'public_share_per'), $instrument_id_of_all_dsex_listed_company);


            $latestTradeDataAll = DataBanksIntradayRepository::getLatestTradeDataAll()->keyBy('instrument_id');


            $market_capital_public_yesterday = 0;
            $market_capital_public_today = 0;


            $impact_arr = array();

            foreach ($instrument_id_of_all_dsex_listed_company as $instrument_id) {

                // skip mutual fund
                if ($instrument_list[$instrument_id]->sector_list_id == 14)
                    continue;

                //skip corporate bond
                if ($instrument_list[$instrument_id]->sector_list_id == 4)
                    continue;


                //checking if this share has been traded. If traded taking the $total_volume. Other wise setting the $total_volume=0
                if (isset($latestTradeDataAll[$instrument_id])) {

                    $category = category($latestTradeDataAll[$instrument_id]);
                    //skip Z category
                    if ($category == 'Z')
                        continue;

                    if (isset($needed_fundamentals_of_dsex_listed_company['total_no_securities'][$instrument_id])) {
                        $total_no_securities = $needed_fundamentals_of_dsex_listed_company['total_no_securities'][$instrument_id]->meta_value;
                        //dump($total_no_securities);
                    } else {
                        $total_no_securities = 0;

                        //send an email to rnd manager informing  that  $total_no_securities is missing for this share

                    }
                    if (isset($needed_fundamentals_of_dsex_listed_company['public_share_per'][$instrument_id])) {
                        $public_share_per = $needed_fundamentals_of_dsex_listed_company['public_share_per'][$instrument_id]->meta_value;

                    } else {
                        $public_share_per = 0;
                        //send an email to rnd manager informing  that  $public_share_per is missing for this share

                    }

                    $total_no_securities_public = $total_no_securities * $public_share_per / 100;

                    $volume = $latestTradeDataAll[$instrument_id]->total_volume;
                    $instrument_code = $instrument_list[$instrument_id]->instrument_code;
                    $yday_close_price = $latestTradeDataAll[$instrument_id]->yday_close_price;

                    if (isset($adjustmentFactor[$instrument_id])) {
                        $yday_close_price = $yday_close_price / $adjustmentFactor[$instrument_id];
                    }


                    $pub_last_traded_price = $latestTradeDataAll[$instrument_id]->close_price;
                    $market_capital_public_yesterday += $total_no_securities_public * $yday_close_price;
                    $market_capital_public_today += $total_no_securities_public * $pub_last_traded_price;


                    $price_change = $pub_last_traded_price - $yday_close_price;


                    $total_impact_for_this_instrument = $price_change * $total_no_securities;
                    $market_capital_increased_for_this_instrument = $cap_equity_yesterday + $total_impact_for_this_instrument;


                    /*
                     *                                  Yesterday's Closing Index X Current M.Cap
                                Current Index = --------------------------------------------------------------
                                                                    Opening M.Cap
                     * */

                    // Yesterday's Closing Index =$dsex_yesterday
                    //  Opening M.Cap= $cap_equity_yesterday


                    $final_index = ($dsex_yesterday * $market_capital_increased_for_this_instrument) / $cap_equity_yesterday;
                    $final_index_change = $final_index - $dsex_yesterday;
                    $final_index_change_per = $final_index_change / $dsex_yesterday;


                    $impact_arr[$instrument_id]['final_index_change'] = round($final_index_change, 5);
                    $impact_arr[$instrument_id]['instrument_code'] = $instrument_code;
                    $impact_arr[$instrument_id]['final_index_change_per'] = round($final_index_change_per, 6);
                    $impact_arr[$instrument_id]['contribution'] = $price_change ? $final_index_change / $price_change : 0;
                    $impact_arr[$instrument_id]['yday_close_price'] = $yday_close_price;
                    $impact_arr[$instrument_id]['ltp'] = $pub_last_traded_price;
                    $impact_arr[$instrument_id]['volume'] = $volume;


                }

            }


            // dump($impact_arr);
            arsort($impact_arr);
            $count = 0;
            $indexmover = array();
            foreach ($impact_arr as $instrument_id => $info) {
                //pr($id);
                $indexmover['positive'][$count]['instrument_id'] = $instrument_id;
                $indexmover['positive'][$count]['instrument_code'] = $info['instrument_code'];
                $indexmover['positive'][$count]['ltp'] = $info['ltp'];
                $indexmover['positive'][$count]['yday_close_price'] = $info['yday_close_price'];
                $indexmover['positive'][$count]['final_index_change'] = round($info['final_index_change'],4);
                $indexmover['positive'][$count]['final_index_change_per'] = round($info['final_index_change_per'],4);
                $indexmover['positive'][$count]['volume'] = $info['volume'];
                $count++;
                if ($count == 7) {
                    break;
                }
            }
            asort($impact_arr);

            //$indexmover = array();
            $count = 0;
            foreach ($impact_arr as $instrument_id => $info) {

                $indexmover['negative'][$count]['instrument_id'] = $instrument_id;
                $indexmover['negative'][$count]['instrument_code'] = $info['instrument_code'];
                $indexmover['negative'][$count]['ltp'] = $info['ltp'];
                $indexmover['negative'][$count]['yday_close_price'] = $info['yday_close_price'];
                $indexmover['negative'][$count]['final_index_change'] = round($info['final_index_change'],4);
                $indexmover['negative'][$count]['final_index_change_per'] = round($info['final_index_change_per'],4);
                $indexmover['negative'][$count]['volume'] = $info['volume'];
                $count++;
                if ($count == 7) {
                    break;
                }
            }


            return $indexmover;

        });




        $view->with('indexmover', $indexmover);


    }


}