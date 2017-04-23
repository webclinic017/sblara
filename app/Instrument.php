<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Instrument extends Model
{

    public function sector_list()
    {
        return $this->belongsTo('App\SectorList','sector_list_id');
    }

    public static function getInstrumentsBySectorName($sectorName='Bank',$exchangeId=0)
    {
        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $returnData = static::whereHas('sector_list', function($q) use($sectorName,$exchangeId) {
            $q->where('name', 'like', "$sectorName");
            $q->where('exchange_id', $exchangeId);
        })->where('active','1')->orderBy('instrument_code', 'asc')->get();


        return $returnData;

    }

    public static function getInstrumentsAll($exchangeId=0)
    {

        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }


        $cacheVar="InstrumentList$exchangeId";
        $returnData = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId)  {
            $returnData=static::where('exchange_id',$exchangeId)->where('active',"1")->orderBy('instrument_code', 'asc')->get();
            return $returnData;

        });

        return $returnData;
    }

    public static function getInstrumentsByCode($instrumentCode=array(),$exchangeId=0)
    {

        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }
        $returnData=self::getInstrumentsAll($exchangeId)->whereInStrict('instrument_code',$instrumentCode);
        return $returnData;
    }

    public static function getInstrumentsById($instrumentId=array(),$exchangeId=0)
    {

        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }
        $returnData=self::getInstrumentsAll($exchangeId)->whereInStrict('id',$instrumentId);
        return $returnData;
    }

    /*
     * It will avoid index.
     * */
    public static function getInstrumentsScripOnly($exchangeId=0)
    {

        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $cacheVar="InstrumentsScripOnly$exchangeId";

        $returnData = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId)  {

            $returnData = static::whereHas('sector_list', function($q) use($exchangeId) {
                $q->where('exchange_id', $exchangeId);
                $q->where('name', 'not like', "Index");
                $q->where('name', 'not like', "Debenture");
                $q->where('name', 'not like', "Treasury Bond");
            })->where('active','1')->orderBy('instrument_code', 'asc')->get();

            return $returnData;
        });

        return $returnData;


    }

}
