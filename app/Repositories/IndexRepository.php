<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 2:35 PM
 */

namespace App\Repositories;
Use App\IndexValue;
Use App\Trade;
Use App\Instrument;

class IndexRepository {

    public static function IndexChartData($tradeDate=null,$exchangeId=0)
    {
        // taking all index info from instrument table
        $instrumentInfoOfIndex=Instrument::getInstrumentsBySectorName('index');

        // setting instrument_id as key and returning array
        $instrumentInfoOfIndex=$instrumentInfoOfIndex->groupBy('id')->toArray();

        // all index of last trade date
        $indexValues=IndexValue::getWholeDayData();

        // setting setting instrument_id as key
        $indexValues=$indexValues->groupBy('instrument_id');

        // all trade value of last day
        $tradeData=Trade::getWholeDayData();
        $tradeDataPreviousDay=Trade::getPreviousDayData();

        $returnData=array();
        foreach($instrumentInfoOfIndex as $index_id=>$index_details)
        {
            if(isset($indexValues[$index_id]))
            {
                // taking 1st element of the array.
                $index_details = $index_details[0];

                // delivering index name
                $returnData['index'][$index_id]['details'] = $index_details;

                // delivering index data as object
                $returnData['index'][$index_id]['data'] = $indexValues[$index_id];


                //$returnData[$index_id]['capital_value']=$indexValues[$index_id]->pluck('date_time') ;
            }


        }
        ksort($returnData);
        $returnData['trade']=$tradeData;
        $returnData['trade_prev_day']=$tradeDataPreviousDay;
        return $returnData;
    }

    // $limit=0 will return all index data of a trade_date
    public static function getIndexData($limit=0,$tradeDate=null,$exchangeId=0)
    {

        // taking all index info from instrument table
        $instrumentInfoOfIndex=Instrument::getInstrumentsBySectorName('index');

        // setting instrument_id as key and returning array
        $instrumentInfoOfIndex=$instrumentInfoOfIndex->groupBy('id')->toArray();

        // all index of last trade date
        $indexValues=IndexValue::getWholeDayData($limit, $tradeDate, $exchangeId);  //($limit = 0, $tradeDate = null, $exchangeId = 0)

        $indexValues = $indexValues->groupBy('instrument_id');

        $returnData = array();
        foreach ($instrumentInfoOfIndex as $index_id => $index_details) {
            // taking 1st element of the array.
            $index_details = $index_details[0];

            // delivering index name
            $returnData['index'][$index_id]['details'] = $index_details;

            // delivering index data as object
            $returnData['index'][$index_id]['data'] = $indexValues[$index_id];

        }
        ksort($returnData);

        return $returnData;

    }
    public static function getIndexDataYesterday($limit=0,$tradeDate=null,$exchangeId=0)
    {

        // taking all index info from instrument table
        $instrumentInfoOfIndex=Instrument::getInstrumentsBySectorName('index');

        // setting instrument_id as key and returning array
        $instrumentInfoOfIndex=$instrumentInfoOfIndex->groupBy('id')->toArray();

        // all index of last trade date
        $indexValues=IndexValue::getWholeDayDataYesterday($limit, $tradeDate, $exchangeId);  //($limit = 0, $tradeDate = null, $exchangeId = 0)

        $indexValues = $indexValues->groupBy('instrument_id');

        $returnData = array();
        foreach ($instrumentInfoOfIndex as $index_id => $index_details) {
            // taking 1st element of the array.
            $index_details = $index_details[0];

            // delivering index name
            $returnData['index'][$index_id]['details'] = $index_details;

            // delivering index data as object
            $returnData['index'][$index_id]['data'] = $indexValues[$index_id];

        }
        ksort($returnData);

        return $returnData;

    }

} 