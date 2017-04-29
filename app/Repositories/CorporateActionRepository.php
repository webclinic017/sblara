<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\CorporateAction;

class CorporateActionRepository {



    public static function getCorporateAction($instrumentId)
    {
        $exchangeDetails=CorporateAction::where('instrument_id',$instrumentId)->where('active',1)->get();
        return $exchangeDetails;
    }


} 