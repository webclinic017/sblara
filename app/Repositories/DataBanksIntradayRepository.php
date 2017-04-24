<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/17/2017
 * Time: 12:09 PM
 */

namespace App\Repositories;
Use App\DataBanksIntraday;
Use App\Instrument;

class DataBanksIntradayRepository {

    public static function upDownStats()
    {
        $allTradeData=DataBanksIntraday::getLatestTradeDataAll();
        $up = $allTradeData->filter(function ($value, $key) {
            return $value->price_change > 0;
        });

        $down = $allTradeData->filter(function ($value, $key) {
            return $value->price_change < 0;
        });

        $eq = $allTradeData->filter(function ($value, $key) {
            return $value->price_change = 0;
        });

        $returnData=array();
        $returnData['up']=$up;
        $returnData['down']=$down;
        $returnData['eq']=$eq;

        $prevDayData=DataBanksIntraday::getPreviousDayData();

        $up = $prevDayData->filter(function ($value, $key) {
            return $value->price_change > 0;
        });

        $down = $prevDayData->filter(function ($value, $key) {
            return $value->price_change < 0;
        });

        $eq = $prevDayData->filter(function ($value, $key) {
            return $value->price_change = 0;
        });



        $returnData['up_prev']=$up;
        $returnData['down_prev']=$down;
        $returnData['eq_prev']=$eq;

        return $returnData;
    }

    public static function significantValueLastMinute($field='price_change',$limit=10,$tradeDate = null, $exchangeId = 0)
    {
        $lastMinuteData=DataBanksIntraday::getLatestTradeDataAll($tradeDate,$exchangeId);
        $lastMinuteData=$lastMinuteData->keyBy('instrument_id');
        $prevMinuteData=DataBanksIntraday::getMinuteAgoTradeDataAll($tradeDate,1,$exchangeId);
        $prevMinuteData = $prevMinuteData->keyBy('instrument_id');

        $lastMinuteData=self::growthCalculate($lastMinuteData,$prevMinuteData,$field,$limit);

        return $lastMinuteData;
    }

    public static function getMinuteData($instrumentsIdArr=array(),$minute=15,$field='total_volume',$tradeDate=null,$exchangeId=0)
    {

        $minuteData=DataBanksIntraday::getWholeDayData($instrumentsIdArr,$minute,$tradeDate,$exchangeId);
        $minuteData=$minuteData->groupBy('instrument_id');

        $returnData=array();

        foreach($minuteData as $instrument_id=>$dataObj) {
            $returnData[$instrument_id]=self::calculateDifference($dataObj,$field);
        }

        return collect($returnData);
    }
    //$tradeDate needed for make cache variable only
    public static function getMinuteDataByMarketId($marketId=array(),$instrumentId=array(),$field=null,$tradeDate=null)
    {
        $minuteData=DataBanksIntraday::getIntraDayDataByMarketId($marketId,$instrumentId,$tradeDate);
        return $minuteData;
    }

    public static function getYdayMinuteData($instrumentsIdArr=array(),$minute=15,$field='total_volume',$exchangeId=0)
    {
        $minuteData=DataBanksIntraday::getPreviousDayData($instrumentsIdArr,null,$minute,$exchangeId);
        $minuteData=$minuteData->groupBy('instrument_id');

        $returnData=array();

        foreach($minuteData as $instrument_id=>$dataObj) {
            $returnData[$instrument_id]=self::calculateDifference($dataObj,$field);
        }

        return collect($returnData);
    }

    /*
     * This is to calculate the difference between 2 object data
     *
     * */
    public static function growthCalculate($lastMinuteData,$prevMinuteData,$field='price_change',$limit=10)
    {
        // writing the new property name to add in object.
        $new_property=$field."_growth";
        $collection = $lastMinuteData->each(function ($item, $key) use($prevMinuteData,$field,$new_property) {

            // checking if it has traded previous minute
            if(isset($prevMinuteData[$key])) {
                $change=$item->$field-$prevMinuteData[$key]->$field;
                $item->$new_property=(float) number_format($change, 2, '.', '');
            }

        });
        $collection = $collection->sortByDesc($new_property)->take($limit);
        return $collection;
    }


    /*
     * This is to calculate the difference between 2 consecutive row of same object data
     *
     * If we dont take whole day data. 1st difference (last value of the obj) will be incorrect. So we have to discard this
     * For example. If we pass 35 minutes data from 1.55 PM. It will assume 1.54 data 0 (which is not true). As a result
     * It will return (all data i.e: volume -0 ). In this case we can discard 1st va;ue and start using from next
     * */
    public static function calculateDifference($data,$field='total_volume')
    {
        // writing the new property name to add in object.
        $new_property=$field."_difference";

        // copy total separate obj
        $data1=clone $data;
        //removing 1st element from the obj
        $data1->shift();

        $data2=$data;

        $collection = $data2->each(function ($item, $key) use($data1,$field,$new_property) {

            // checking if key exist in shifted data ($data1). It will miss last element normally
            if(isset($data1[$key])) {
                $change=$item->$field-$data1[$key]->$field;
                $item->$new_property=(float) number_format($change, 2, '.', '');
            }else
            // very 1st data (10.30) has no previous data. so we are subtracting 0
                $change=$item->$field-0;
                $item->$new_property=(float) number_format($change, 2, '.', '');

        });

        return $collection;
    }


} 