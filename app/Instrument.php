<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use DB;

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

    public static function getInstrumentsScripOnlyByDB($exchangeId=0){
      if(!$exchangeId) {
          $exchangeId = session('active_exchange_id', 1);
      }

      $sql = "select `id` ,`instrument_code` from `instruments` where exists (select * from `sector_lists` where `instruments`.`sector_list_id` = `sector_lists`.`id` and `exchange_id` = '".$exchangeId."' and `name` not like 'Index' and `name` not like 'Debenture' and `name` not like 'Treasury Bond') and `active` = '1' order by `id` asc";
      $instruments = DB::Select($sql);

      return $instruments;
    }

    public static function getInstrumentsScripWithIndex($exchangeId=0)
    {

        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $cacheVar="InstrumentsScripWithIndex$exchangeId";

        $returnData = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId)  {

            $returnData = static::whereHas('sector_list', function($q) use($exchangeId) {
                $q->where('exchange_id', $exchangeId);
                $q->where('name', 'not like', "Debenture");
                $q->where('name', 'not like', "Treasury Bond");
            })->where('active','1')->orderBy('instrument_code', 'asc')->get();

            return $returnData;
        });

        return $returnData;


    }

    public static function queryInstruments($query,$exchangeId=0)
    {
        $instrumentList=self::getInstrumentsScripWithIndex($exchangeId);
        $result = $instrumentList->filter(function ($value, $key) use ($query) {
            // select this row if strstr is true
            return strstr($value->instrument_code,$query);
        });

        return $result;

    }
}
