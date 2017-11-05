<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 2:35 PM
 */

namespace App\Repositories;
Use App\SectorIntraday;


class SectorIntradayRepository {

    public static function getWholeDayData($limit=0,$tradeDate=null,$exchangeId=0,$sector_list_id)
    {
        $returnData= SectorIntraday::getWholeDayData($limit,$tradeDate,$exchangeId,$sector_list_id);
        return $returnData;
    }

} 