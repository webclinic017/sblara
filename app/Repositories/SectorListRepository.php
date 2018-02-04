<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\SectorList;
use Illuminate\Support\Facades\Cache;


class SectorListRepository {



    public static function getSectorList($exchangeId=0)
    {
        return SectorList::getSectorList($exchangeId);
    }

    public static function getSectorDetailsByInstrumentId($instrumentId=0)
    {
        return SectorList::getSectorDetailsByInstrumentId($instrumentId);
    }

    public static function getSectorPE($sector_list_id_arr=array())
    {
        $instrumentList = InstrumentRepository::getInstrumentsScripOnly();

        $grouped_instrument_list=$instrumentList->groupBy('sector_list_id');
        $instrument_arr = $instrumentList->pluck('id')->toArray();

        $epsData = Cache::remember("annualized_eps_all_instruments", 720, function () use ($instrument_arr) {
            $epsData = FundamentalRepository::getAnnualizedEPS($instrument_arr);
            return $epsData;
        });

        $sector_list=self::getSectorList()->keyBy('id');


            unset($grouped_instrument_list[14]); //skipping mutual fund sector


            $needed_grouped_instrument_list=array();
            // if sector id are given in parameter. taken only those sectors in consideration
            if(count($sector_list_id_arr))
            {
                $instrument_arr=array();
                foreach($sector_list_id_arr as $id)
                {
                    $needed_grouped_instrument_list[$id]=$grouped_instrument_list[$id];
                    $ins_ids=$grouped_instrument_list[$id]->pluck('id')->toArray();
                    $instrument_arr=array_merge($instrument_arr,$ins_ids);
                }

            }else
            {
                // taking all sectors in consideration
                $needed_grouped_instrument_list=$grouped_instrument_list;
            }

      //  $instrument_arr=collect($needed_grouped_instrument_list)->pluck('id');


        $latestData = DataBanksIntradayRepository::getAvailableLTP($instrument_arr);
        $latestData=collect($latestData)->keyBy('instrument_id');

        $metaKey = array('total_no_securities','list_of_life_insurance');
        $fundamentalInfo = FundamentalRepository::getFundamentalData($metaKey, $instrument_arr);

        $all_life_insurance_instrument_id=array();
        if(isset($fundamentalInfo['list_of_life_insurance']))
        $all_life_insurance_instrument_id = collect($fundamentalInfo['list_of_life_insurance'])->where('meta_value',1);


        // Calculate all sectors pe

            $sector_pe_arr=array();
            $market_capital_arr=array();
            $total_earnings_arr=array();
            $total_market_capital=0;
            $total_market_earnings=0;
            $instrumentList=$instrumentList->keyBy('id');

            foreach($needed_grouped_instrument_list as $sector_id=>$all_instruments_of_this_sector)
            {

                $total_market_capital_of_this_sector=0;
                $total_earnings_of_this_sector=0;
                foreach($all_instruments_of_this_sector as $instrument)
                {
                    $instrument_id= $instrument['id'];


                    if(isset($latestData[$instrument_id]))
                    {
                        $last_trade_data_of_this_instrument=$latestData[$instrument_id];
                    }else
                    {
/*                        $ins=$instrumentList->where('id',$instrument_id);
                        dump($ins);
                        dump("no trade data for $instrument_id");*/
                        continue;
                    }

                    $explode_arr=explode('-', $last_trade_data_of_this_instrument->quote_bases);
                    $category= $explode_arr[0];

                    // skipping Z category
                    if($category=='Z')
                        continue;

                    // skip life insurance
                    if(isset($all_life_insurance_instrument_id[$instrument_id]))
                        continue;

                    $ltp = $last_trade_data_of_this_instrument->close_price != 0 ? $last_trade_data_of_this_instrument->close_price : ($last_trade_data_of_this_instrument->pub_last_traded_price != 0 ? $last_trade_data_of_this_instrument->pub_last_traded_price : $last_trade_data_of_this_instrument->spot_last_traded_price);

                    if(isset($fundamentalInfo['total_no_securities'][$instrument_id]))
                    {
                        $nos= (int)$fundamentalInfo['total_no_securities'][$instrument_id]['meta_value'];
                    }
                    else
                    {
                  //      dump("no total_no_securities for $instrument_id");
                        continue;
                    }
                    $instrument_code=$instrumentList[$instrument_id]->instrument_code;

                    $market_capital_of_this_instrument= $ltp* $nos;
                    $market_capital_arr[$sector_id][$instrument_code]['cap']= $market_capital_of_this_instrument;
                    $market_capital_arr[$sector_id][$instrument_code]['instrument_id']= $instrument_id;
                    $total_market_capital_of_this_sector+= $market_capital_of_this_instrument;

                    if(isset($epsData[$instrument_id]))
                    {
                        $annualized_eps=$epsData[$instrument_id]['annualized_eps'];
                    }else
                    {
                    //    dump("no annualized_eps for $instrument_id");
                        continue;
                    }

                    $total_earnings_of_this_instrument= $annualized_eps* $nos;
                    $total_earnings_arr[$sector_id][$instrument_code]['earnings']= $total_earnings_of_this_instrument;
                    $total_earnings_arr[$sector_id][$instrument_code]['instrument_id']= $instrument_id;
                    $total_earnings_of_this_sector+= $total_earnings_of_this_instrument;
                   // $latestData[]
                }

                if($total_earnings_of_this_sector)
                {
                    $sector_pe_arr[$sector_id]['pe']= round($total_market_capital_of_this_sector/ $total_earnings_of_this_sector,2);
                    $sector_pe_arr[$sector_id]['sector_earning'] = $total_earnings_of_this_sector;
                    $sector_pe_arr[$sector_id]['sector_cap'] = $total_market_capital_of_this_sector;
                    $sector_pe_arr[$sector_id]['sector']=$sector_list[$sector_id]->name;
                }

                $total_market_capital+=$total_market_capital_of_this_sector;
                $total_market_earnings+=$total_earnings_of_this_sector;

            }

            $market_pe=round($total_market_capital/$total_market_earnings,2);

        $return=array();
        $return['market_pe']=$market_pe;
        $return['total_market_capital']=round($total_market_capital/1000000,2);
        $return['total_market_earnings']=round($total_market_earnings/1000000,2);
        $return['sector_pe_arr']=$sector_pe_arr;
        $return['market_capital_arr']=$market_capital_arr;
        $return['total_earnings_arr']=$total_earnings_arr;

        return $return;

    }
    public static function getCategoryPE($category_arr=array())
    {
        $instrumentList = InstrumentRepository::getInstrumentsScripOnly();

        $grouped_instrument_list=$instrumentList->groupBy('sector_list_id');
        $instrument_arr = $instrumentList->pluck('id')->toArray();

        $epsData = Cache::remember("annualized_eps_all_instruments", 720, function () use ($instrument_arr) {
            $epsData = FundamentalRepository::getAnnualizedEPS($instrument_arr);
            return $epsData;
        });
            unset($grouped_instrument_list[14]); //skipping mutual fund sector


        $latestData = DataBanksIntradayRepository::getAvailableLTP($instrument_arr);
        $latestData = collect($latestData)->keyBy('instrument_id');




        $metaKey = array('total_no_securities','list_of_life_insurance');
        $fundamentalInfo = FundamentalRepository::getFundamentalData($metaKey, $instrument_arr);
        $all_life_insurance_instrument_id = collect($fundamentalInfo['list_of_life_insurance'])->where('meta_value',1);



        $market_capital_arr = array();
        $total_earnings_arr = array();
        $instrumentList = $instrumentList->keyBy('id');

        foreach($instrument_arr as $instrument_id)
        {
            if (isset($all_life_insurance_instrument_id[$instrument_id]))
                continue;

            if (isset($latestData[$instrument_id])) {
                $last_trade_data_of_this_instrument = $latestData[$instrument_id];
            } else {

                continue;
            }


            $explode_arr = explode('-', $last_trade_data_of_this_instrument->quote_bases);
            $category = $explode_arr[0];

            $ltp = $last_trade_data_of_this_instrument->close_price != 0 ? $last_trade_data_of_this_instrument->close_price : ($last_trade_data_of_this_instrument->pub_last_traded_price != 0 ? $last_trade_data_of_this_instrument->pub_last_traded_price : $last_trade_data_of_this_instrument->spot_last_traded_price);

            if (isset($fundamentalInfo['total_no_securities'][$instrument_id])) {
                $nos = (int)$fundamentalInfo['total_no_securities'][$instrument_id]['meta_value'];
            } else {
                //      dump("no total_no_securities for $instrument_id");
                continue;
            }

            $instrument_code = $instrumentList[$instrument_id]->instrument_code;

            $market_capital_of_this_instrument = $ltp * $nos;

            $market_capital_arr[$category][$instrument_code] = $market_capital_of_this_instrument;
            //$market_capital_arr[$category][$instrument_code]['cap'] = $market_capital_of_this_instrument;
            //$market_capital_arr[$category][$instrument_code]['instrument_id'] = $instrument_id;


            if (isset($epsData[$instrument_id])) {
                $annualized_eps = $epsData[$instrument_id]['annualized_eps'];
            } else {
                //    dump("no annualized_eps for $instrument_id");
                continue;
            }

            $total_earnings_of_this_instrument = $annualized_eps * $nos;
            $total_earnings_arr[$category][$instrument_code] = $total_earnings_of_this_instrument;
          //  $total_earnings_arr[$category][$instrument_code]['earnings'] = $total_earnings_of_this_instrument;
          //  $total_earnings_arr[$category][$instrument_code]['instrument_id'] = $instrument_id;


        }

        $category_pe_arr = array();
        foreach($market_capital_arr as $category=>$capital_arr)
        {
            $category_pe_arr[$category]['cap']=array_sum($capital_arr);
            $category_pe_arr[$category]['earnings']=array_sum($total_earnings_arr[$category]);
            $category_pe_arr[$category]['pe']= round($category_pe_arr[$category]['cap']/ $category_pe_arr[$category]['earnings'],2);
        }

/*        dump($category_pe_arr);
        dump($market_capital_arr);
        dd($total_earnings_arr);
*/

        // Calculate all sectors pe

        $return=array();
        $return['category_pe_arr']=$category_pe_arr;

        return $return;

    }


} 