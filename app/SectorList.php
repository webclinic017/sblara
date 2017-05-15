<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SectorList extends Model
{
    public function instruments()
    {
        return $this->hasMany('App\Instrument','sector_list_id');
    }

    public static function getSectorList($exchangeId=0)
    {
        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }


        $cacheVar="getSectorList$exchangeId";
        $returnData = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId)  {

            $sectorList=SectorList::where('exchange_id',$exchangeId)->get();
            return $sectorList;

        });

        return $returnData;
    }

    public static function getSectorDetailsByInstrumentId($instrumentId=0)
    {
        $returnData = static::whereHas('instruments', function ($query) use($instrumentId) {
            $query->where('id', $instrumentId);
        })->get();

        return $returnData;

    }

}
