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
        return SectorList::getSectorList($exchangeId);
    }

    public static function getSectorDetailsByInstrumentId($instrumentId=0)
    {
        return SectorList::getSectorDetailsByInstrumentId($instrumentId);
    }


} 