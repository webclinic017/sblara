<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\Instrument;
use App\Exchange;
use App\SectorList;
class InstrumentRepository {

    //$key= name or id
    public static function getInstrumentsGroupBySector($key='name',$exchangeId=0)
    {
        $allInstruments=Instrument::getInstrumentsAll()->groupBy('sector_list_id');
        $allSectors=SectorList::getSectorList();

        $instrumentGrouped=array();
        foreach($allInstruments as $sector_list_id=>$all_instrument_of_this_sector)
        {
            $key_value=$allSectors->where('id',$sector_list_id)->first()->$key;
            $instrumentGrouped[$key_value]=$all_instrument_of_this_sector;
        }

        return $instrumentGrouped;
    }


    public static function getInstrumentsBySectorName($sectorName='Bank',$exchangeId=0)
    {
        $returnData=Instrument::getInstrumentsBySectorName($sectorName,$exchangeId);
        return $returnData;
    }

    public static function getInstrumentList($exchangeId=0)
    {
        $returnData=Instrument::getInstrumentsScripOnly($exchangeId);
        return $returnData;
    }

    /*
     * Return all instrument including debenture treasury bonds
     * */
    public static function getInstrumentsAll($exchangeId = 0)
    {
        $returnData = Instrument::getInstrumentsAll($exchangeId);
        return $returnData;
    }


    public static function getInstrumentsByCode($instrumentCode=array(),$exchangeId=0)
    {
        $returnData=Instrument::getInstrumentsAll($exchangeId)->whereInStrict('instrument_code',$instrumentCode);
        return $returnData;
    }

    public static function getInstrumentsById($instrumentId=array(),$exchangeId=0)
    {
        $returnData=Instrument::getInstrumentsAll($exchangeId)->whereInStrict('id',$instrumentId);
        return $returnData;
    }

    //{"symbol":"APC","full_name":"APC","description":"Anadarko Petroleum Corporation","exchange":"NYSE","type":"stock"}
    public static function getTradingViewInstrumentList($limit,$query,$type,$exchangeDetails)
    {
        $exchangeName=$exchangeDetails->name;
        $exchangeDetails=Exchange::where('name','like',"$exchangeName")->get()->first();
        $instrumentList=Instrument::queryInstruments($query,$exchangeDetails->id);

        $returnData=array();
        foreach($instrumentList as $instrument)
        {
            $temp=array();
            $temp['symbol']=$instrument->instrument_code;
            $temp['full_name']=$instrument->instrument_code;
            $temp['description']=$instrument->name;
            $temp['exchange']=$exchangeDetails->name;
            $temp['type']='stock';
            $returnData[]=$temp;
        }


        return collect($returnData)->take($limit);
    }

    /*
     * It will avoid index and debenture and others unnecessary code.
     * */
    public static function getInstrumentsScripOnly($exchangeId=0)
    {
        return Instrument::getInstrumentsScripOnly($exchangeId);

    }


    /*
     * It will avoid  debenture and others unnecessary code but include index.
     * */
    public static function getInstrumentsScripWithIndex($exchangeId=0)
    {
        return Instrument::getInstrumentsScripWithIndex($exchangeId);

    }


    public static function getDateLessTradeData($instrumentIDs = array())
    {
        return Instrument::getDateLessTradeData($instrumentIDs);
    }

    public static function isMature($instrumentId = 0, $buyDate = null)
    {
        $exchangeId = session('active_exchange_id', 1);
        if (is_null($buyDate))
            $buyDate = date('Y-m-d');
        $today = date('Y-m-d');
        $tradeDatePassed = \DB::table('markets')->where('trade_date', '>', $buyDate)->where('trade_date', '<=', $today)->where('exchange_id', $exchangeId)->count();
        $category_Z_mutured_day = 7;
        $category_Others_mutured_day = 1;
        $lastTradeInfo = \DB::table('data_banks_intradays')->where('instrument_id', $instrumentId)->orderBy('lm_date_time', 'desc')->skip(0)->take(1)->first();
        $isSpot = $lastTradeInfo->spot_last_traded_price == 0 ? 0 : 1;
        $isLocked = 0;
        $quote_bases = $lastTradeInfo->quote_bases;
        $categoryArr = explode('-', $quote_bases);
        $category = trim($categoryArr[0]);
        if ($isLocked) { // if it is locked do nothing
        } else {
            if ($isSpot) {
                if ($tradeDatePassed > 0) {  // checking if it is not same date of buying date. share should not be mature at same date
                    return true;
                }
            } else {
                if ($category == 'Z') {
                    if ($tradeDatePassed > $category_Z_mutured_day) {
                        return true;
                    }
                } else {
                    if ($tradeDatePassed > $category_Others_mutured_day) {
                        return true;
                    }
                }
            }
        }
        return false;
    }


}