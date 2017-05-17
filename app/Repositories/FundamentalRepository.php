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
                $meta_key=$metaInfo->where('id',$latestData->meta_id)->first()->meta_key;
                $instrument_code=$instrumentInfo->where('id',$latestData->instrument_id)->first()->instrument_code;
                $latestData['meta_key']=$meta_key;
                $latestData['instrument_code']=$instrument_code;
                $fundamentalData[$meta_key][$instrumentId]=$latestData;

            }
        }

        return collect($fundamentalData);

    }


    public static function getFundamentalDataHistory($meta=array(),$ins=array())
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
            $meta_key=$metaInfo->where('id',$metaId)->first()->meta_key;
            $groupByInstrumentData=$metaData->groupby('instrument_id');
            $fundamentalData[$meta_key]=$groupByInstrumentData;
        }

        return collect($fundamentalData);

    }

    /*
     * fundamental data for all instrument
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


    public static function getAnnualizedEPS($instrumentIdArr=array())
    {
        // Configure::write('debug', 2);

        $metaKey=array('q1_eps_cont_op','half_year_eps_cont_op','q3_nine_months_eps','earning_per_share');

        $fundaData=self::getFundamentalData($metaKey,$instrumentIdArr);
        $fundaData=r_collect($fundaData);


        $returnData=array();
        foreach($instrumentIdArr as $instrument_id)
        {

            // collecting all q data for this instrument

            $qData[]=$fundaData['q1_eps_cont_op']->where('instrument_id',$instrument_id)->first();
            $qData[]=$fundaData['half_year_eps_cont_op']->where('instrument_id',$instrument_id)->first();
            $qData[]=$fundaData['q3_nine_months_eps']->where('instrument_id',$instrument_id)->first();
            $qData[]=$fundaData['earning_per_share']->where('instrument_id',$instrument_id)->first();

            // sorting by q data publish date and taking latest published data into consideration

            $latestQdata=collect($qData)->sortByDesc('meta_date')->first()->toArray();


            if($latestQdata['meta_key']=='q1_eps_cont_op')
            {
                $returnData[$instrument_id]['annualized_eps']= $latestQdata['meta_value']*4;
                $returnData[$instrument_id]['meta_date']= $latestQdata['meta_date'];
                $returnData[$instrument_id]['text']= 'Q1';
            }

            if($latestQdata['meta_key']=='half_year_eps_cont_op')
            {
                $returnData[$instrument_id]['annualized_eps']= $latestQdata['meta_value']*2;
                $returnData[$instrument_id]['meta_date']= $latestQdata['meta_date'];
                $returnData[$instrument_id]['text']= 'Half year';
            }

            if($latestQdata['meta_key']=='q3_nine_months_eps')
            {

                $returnData[$instrument_id]['annualized_eps']= (float) number_format(((float)$latestQdata['meta_value']/3)*4, 2, '.', '');
                $returnData[$instrument_id]['meta_date']= $latestQdata['meta_date'];
                $returnData[$instrument_id]['text']= '9 months';

            }

            if($latestQdata['meta_key']=='earning_per_share')
            {
                $returnData[$instrument_id]['annualized_eps']= $latestQdata['meta_value'];
                $returnData[$instrument_id]['meta_date']= $latestQdata['meta_date'];
                $returnData[$instrument_id]['text']= 'Annual';
            }


        }
        return $returnData;
    }


} 