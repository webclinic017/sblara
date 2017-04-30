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
class InstrumentRepository {

    public static function getInstrumentList($exchangeId=0)
    {
        $returnData=Instrument::getInstrumentsScripOnly($exchangeId);
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
        $instrumentList=Instrument::getInstrumentsScripOnly($exchangeDetails->id);

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


        return collect($returnData);
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




} 