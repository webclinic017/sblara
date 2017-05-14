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
use App\Repositories\InstrumentRepository;
class FundamentalRepository {


    /*
     * Sample call
     * dump(FundamentalRepository::getFundamentalData(array('stock_dividend','no_of_securities'),array('ABBANK','ACI'))->toArray());
        dump(FundamentalRepository::getFundamentalData(array(13,211),array('ABBANK','ACI'))->toArray());
        dump(FundamentalRepository::getFundamentalData(array('stock_dividend','no_of_securities'),array(12,13))->toArray());
        dd(FundamentalRepository::getFundamentalData(array(13,211),array(12,13))->toArray());
     *
     * sample return
     * array:2 [▼
  "stock_dividend" => array:9 [▼
    "id" => 154788
    "instrument_id" => 12
    "meta_id" => 211
    "meta_value" => "12.50"
    "meta_date" => Carbon {#879 ▶}
    "created" => "2017-03-19 16:14:35"
    "updated" => "2017-03-19 16:14:35"
    "meta_key" => "stock_dividend"
    "instrument_code" => "ABBANK"
  ]
  "no_of_securities" => array:9 [▼
    "id" => 3389
    "instrument_id" => 13
    "meta_id" => 13
    "meta_value" => "34394122"
    "meta_date" => Carbon {#893 ▶}
    "created" => "2014-10-29 11:38:31"
    "updated" => "2014-10-29 11:38:31"
    "meta_key" => "no_of_securities"
    "instrument_code" => "ACI"
  ]
]
     * */
    public static function getFundamentalData($meta=array(),$ins=array())
    {

        // if id provided
        if(is_int($meta[0]))
        {
            //Meta id provided
            $metaId = $meta;
            $metaInfo = Meta::getMetaInfoById($metaId);

        }else
        {
            // metaKey provided

            $metaInfo = Meta::getMetaInfo($meta);
            $metaId = $metaInfo->pluck('id')->toArray();

        }


        if(is_int($ins[0]))
        {
            // instrument id provided
            $instrumentId=$ins;
            $instrumentInfo = InstrumentRepository::getInstrumentsById($instrumentId);

        }else
        {
            // instrument code provided

            $instrumentInfo = InstrumentRepository::getInstrumentsByCode($ins);
            $instrumentId = $instrumentInfo->pluck('id')->toArray();

        }


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
     * for all instrument
     * */
    public static function getFundamentalDataAll($meta=array())
    {

        // if id provided
        if(is_int($meta[0]))
        {
            //Meta id provided
            $metaId = $meta;
            $metaInfo = Meta::getMetaInfoById($metaId);

        }else
        {
            // metaKey provided

            $metaInfo = Meta::getMetaInfo($meta);
            $metaId = $metaInfo->pluck('id')->toArray();

        }




        $groupByMetaData = Fundamental::getData($metaId,array())->groupby('meta_id');



        $fundamentalData=array();
        foreach($groupByMetaData as $metaId=>$metaData)
        {
            $groupByInstrumentData=$metaData->groupby('instrument_id');


            foreach($groupByInstrumentData as $instrumentId=>$instrumentData)
            {
                $latestData=$instrumentData->first();

                $latestData['meta_key']=$metaInfo->where('id',$latestData->meta_id)->first()->meta_key;
                $fundamentalData[$instrumentId]=$latestData;

            }
        }
        return collect($fundamentalData)->groupBy('meta_key');

    }


} 