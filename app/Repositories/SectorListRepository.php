<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\SectorList;

class SectorListRepository {



    public static function getSectorList($exchangeId=0)
    {
        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $sectorList=SectorList::where('exchange_id',$exchangeId)->get();
        return $sectorList;
    }

    public static function getSectorDetailsByInstrumentId($instrumentId=0)
    {
        return SectorList::getSectorDetailsByInstrumentId($instrumentId);
    }


} 