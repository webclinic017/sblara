<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\Instrument;
class InstrumentRepository {

    public static function getInstrumentList($exchangeId=0)
    {
        $returnData=Instrument::getInstrumentsScripOnly($exchangeId);
        return $returnData;
    }


} 