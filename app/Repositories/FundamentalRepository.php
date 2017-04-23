<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\Meta;
use App\Fundamental;
use App\Instrument;
class FundamentalRepository {


    /*
     * Sample parameter
     * $metaKey=array('stock_dividend','no_of_securities');
     * $instrumentCode=array('ABBANK','ACI')
     *
     * sample return
     * Collection {#869 ▼
         #items: array:2 [▼
        "stock_dividend" => Fundamental {#863 ▶}
        "no_of_securities" => Fundamental {#859 ▶}
  ]
}
     * */
    public static function getFundamentalData($metaKey=array(),$instrumentCode=array())
    {

        $metaInfo=Meta::getMetaInfo($metaKey);
        $metaId=$metaInfo->pluck('id')->toArray();

        $instrumentInfo=Instrument::getInstrumentsByCode($instrumentCode);
        $instrumentId=$instrumentInfo->pluck('id')->toArray();
       // $instrumentInfo=$instrumentInfo->keyBy('instrument_id');

        $groupByMetaData = Fundamental::getData($metaId,$instrumentId)->groupby('meta_id');

        $fundamentalData=array();
        foreach($groupByMetaData as $metaId=>$metaData)
        {
            $groupByInstrumentData=$metaData->groupby('instrument_id');
            foreach($groupByInstrumentData as $instrumentId=>$instrumentData)
            {
                $latestData=$instrumentData->first();
                $latestData['meta_key']=$metaInfo->where('id',$latestData->meta_id)->first()->meta_key;
                $latestData['instrument_code']=$instrumentInfo->where('id',$latestData->instrument_id)->first()->instrument_code;
                $fundamentalData[]=$latestData;

            }
        }
        return collect($fundamentalData)->keyBy('meta_key');

    }

    /*
     * Sample parameter
     * $metaKey=array(13,211);
     * $instrumentCode=array(12,13)
     *
     * sample return
     * Collection {#869 ▼
         #items: array:2 [▼
        "stock_dividend" => Fundamental {#863 ▶}
        "no_of_securities" => Fundamental {#859 ▶}
  ]
}
     * */

    public static function getFundamentalDataById($metaId=array(),$instrumentId=array())
    {

        $metaInfo=Meta::getMetaInfoById($metaId);
        $instrumentInfo=Instrument::getInstrumentsById($instrumentId);

        $groupByMetaData = Fundamental::getData($metaId,$instrumentId)->groupby('meta_id');

        $fundamentalData=array();
        foreach($groupByMetaData as $metaId=>$metaData)
        {
            $groupByInstrumentData=$metaData->groupby('instrument_id');
            foreach($groupByInstrumentData as $instrumentId=>$instrumentData)
            {
                $latestData=$instrumentData->first();
                $latestData['meta_key']=$metaInfo->where('id',$latestData->meta_id)->first()->meta_key;
                $latestData['instrument_code']=$instrumentInfo->where('id',$latestData->instrument_id)->first()->instrument_code;
                $fundamentalData[]=$latestData;

            }
        }
        return collect($fundamentalData)->keyBy('meta_key');

    }


} 