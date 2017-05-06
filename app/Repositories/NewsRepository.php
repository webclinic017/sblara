<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\News;

class NewsRepository {

    public static function getAllNewsByInstrumentId($instrument_id=0)
    {
        $allNews=News::getAllNewsByInstrumentId($instrument_id);
        return $allNews;
    }

    public static function getWholeDayNews($tradeDate=null,$exchangeId=0)
    {
        $allNews=News::getWholeDayNews($tradeDate,$exchangeId);
        return $allNews;
    }



} 