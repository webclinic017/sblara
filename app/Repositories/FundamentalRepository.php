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


    public static function getFundamentalData($metaKey=array(),$instrumentCode=array())
    {
        $metaInfo=Meta::getMetaInfo($metaKey);
       // dd($metaInfo);
        $metaId=$metaInfo->pluck('id')->toArray();
        $metaInfo=$metaInfo->keyBy('id');
       // dd($metaInfo->toArray());

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

               // dump($metaInfo);
                //$key=$metaInfo->where('id',$latestData->meta_id)->first()->meta_key;
dd($latestData->id);
                //dump($instrumentData->first()->toArray());
                $latestData->put('meta_key','hhhhh');
                $fundamentalData[]=$latestData;
                dump($latestData->toArray());
            }
        }
        //dd(collect($fundamentalData)->keyBy('meta_id'));
        return  1;
    }


} 