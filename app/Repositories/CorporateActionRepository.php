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
        $date=date('Y-m-d');
        $corporateActionData=CorporateAction::where('instrument_id',$instrumentId)->where('active',1)->where('record_date','<', $date)->get();
        return $corporateActionData;
    }

    public static function getCorporateActionAll($fromDate='1999-01-01',$toDate=0,$instrumentIdArr=array())
    {
        if(!$toDate)
        {
            $toDate=date('Y-m-d');
        }

        $query=CorporateAction::whereBetween('record_date', [$fromDate, $toDate])->where('active',1);

        if(!empty($instrumentIdArr))
        {
            $query->whereIn('instrument_id',$instrumentIdArr);
        }
        $corporateActionData=$query->get();

        return $corporateActionData;
    }


} 