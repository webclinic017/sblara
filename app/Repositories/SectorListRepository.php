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

    public static function getSectorPE($sector_list_id=0)
    {
        $latestData = DataBanksIntradayRepository::getAvailableLTP();
        dd($latestData);
        $latestData=collect($latestData)->keyBy('instrument_id');
        $instrumentList = InstrumentRepository::getInstrumentsScripOnly();
        $grouped_instrument_list=$instrumentList->groupBy('sector_list_id');
        $instrument_arr = $instrumentList->pluck('id');

        $epsData = Cache::remember("annualized_eps_all_instruments", 720, function () use ($instrument_arr) {
            $epsData = FundamentalRepository::getAnnualizedEPS($instrument_arr);
            return $epsData;
        });


        $metaKey = array('no_of_securities');
        $fundamentaInfo = FundamentalRepository::getFundamentalData($metaKey, $instrument_arr);


        if($sector_list_id==0)
        {
            // Calculate all sectors pe

            $sector_pe_arr=array();
            $market_capital_arr=array();
            $total_earnings_arr=array();
            foreach($grouped_instrument_list as $sector_id=>$all_instruments_of_this_sector)
            {

                if($sector_id==14)  //skipping mutual fund sector
                    continue;

                $total_market_capital_of_this_sector=0;
                $total_earnings_of_this_sector=0;
                foreach($all_instruments_of_this_sector as $instrument)
                {
                    $instrument_id= $instrument['id'];


                    $last_trade_data_of_this_instrument=$latestData[$instrument_id];
                    $explode_arr=explode('-', $last_trade_data_of_this_instrument->quote_bases);
                    $category= $explode_arr[0];

                    // skipping Z category
                    if($category=='Z')
                        continue;

                    $ltp = $last_trade_data_of_this_instrument->close_price != 0 ? $last_trade_data_of_this_instrument->close_price : ($last_trade_data_of_this_instrument->pub_last_traded_price != 0 ? $last_trade_data_of_this_instrument->pub_last_traded_price : $last_trade_data_of_this_instrument->spot_last_traded_price);

                    $nos= (int)$fundamentaInfo['no_of_securities'][$instrument_id]['meta_value'];
                    $market_capital_of_this_instrument= $ltp* $nos;
                    $market_capital_arr[$sector_id][$instrument_id]= $market_capital_of_this_instrument;
                    $total_market_capital_of_this_sector+= $market_capital_of_this_instrument;

                    $annualized_eps=$epsData[$instrument_id]['annualized_eps'];
                    $total_earnings_of_this_instrument= $annualized_eps* $nos;

                    $total_earnings_arr[$sector_id][$instrument_id]= $total_earnings_of_this_instrument;
                    $total_earnings_of_this_sector+= $total_earnings_of_this_instrument;
                   // $latestData[]
                }

                $sector_pe_arr[$sector_id]['pe']= round($total_market_capital_of_this_sector/ $total_earnings_of_this_sector,2);
                $sector_pe_arr[$sector_id]['sector_earning'] = $total_earnings_of_this_sector;
                $sector_pe_arr[$sector_id]['sector_cap'] = $total_market_capital_of_this_sector;

            }


            dump($sector_pe_arr);
            dump($market_capital_arr);
            dd($total_earnings_arr);
        }

        //return SectorList::getSectorDetailsByInstrumentId($instrumentId);
    }


} 