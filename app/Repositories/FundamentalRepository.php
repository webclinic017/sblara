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
use App\Repositories\SectorListRepository;
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

                $latestData = $instrumentData->first();
                $meta_key = $metaInfo->where('id', $latestData->meta_id)->first()->meta_key;
                $latestData['meta_key'] = $meta_key;
                $fundamentalData[$meta_key][$instrumentId] = $latestData;

            }
        }

        return collect($fundamentalData);

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


    public static function getAmibrokerFundamentalData($instrument_code)
    {

        // this is sample data
        // https://www.amibroker.com/guide/objects.html

        $allInstrumentData=array();
        $instrumentList = InstrumentRepository::getInstrumentsScripWithIndex();
        $sectorList=SectorListRepository::getSectorList();
       // dd($sectorList);
        foreach ($instrumentList as $ins) {
            $returnData=array();
            $returnData['Ticker']=$ins->instrument_code;
            $returnData['FullName']=$ins->name;
            $returnData['Market'] = 'DSE';
            $sector= $sectorList->where('id', $ins->sector_list_id)->first();
            if(count($sector)) {
                $returnData['SectorName'] = $sector->name;
                $returnData['IndustryName'] = $sector->name;
            }
            else
            {
                $returnData['SectorName'] = 'Undefined';
                $returnData['IndustryName'] = 'Undefined';
            }
            $returnData['Group'] = 'Beximco group';

            if($ins->id==10001 || $ins->id==10002 || $ins->id==10003)
                $returnData['Index']=true;
            else
                $returnData['Index']=false;


            $returnData['EPS']=2.53;
            $returnData['EPSEstCurrentYear']=3.12;
            $returnData['EPSEstNextYear']=3.45;
            $returnData['EPSEstNextQuarter']=0.78;
            $returnData['PEGRatio']=8;
            $returnData['SharesFloat']=1245547;
            $returnData['SharesOut']=545588989;
            $returnData['DividendPayDate']='17/07/2016';
            $returnData['ExDividendDate']='17/09/2016';
            $returnData['BookValuePerShare']=7.5;
            $returnData['DividendPerShare']=10;
            $returnData['ProfitMargin']=1521;
            $returnData['OperatingMargin']=4546;
            $returnData['OneYearTargetPrice']=200;
            $returnData['ReturnOnAssets']=124;
            $returnData['ReturnOnEquity']=120;
            $returnData['QtrlyRevenueGrowth']=15;
            $returnData['GrossProfitPerShare']=23;
            $returnData['SalesPerShare']=30;
            $returnData['EBITDAPerShare']=14;
            $returnData['QtrlyEarningsGrowth']=3;
            $returnData['InsiderHoldPercent']=25;
            $returnData['InstitutionHoldPercent']=8;
            $returnData['SharesShort']=10;
            $returnData['SharesShortPrevMonth']=15;
            $returnData['ForwardDividendPerShare']=25;
            $returnData['ForwardEPS']=5.6;
            $returnData['OperatingCashFlow']=145;
            $returnData['LeveredFreeCashFlow']=150;
            $returnData['Beta']=40;
            $returnData['LastSplitRatio']='2:1';
            $returnData['LastSplitDate']='19/03/2016';
            $returnData['Alias']='ABBANK';  //(returns symbol alias - string) - 5.50 and above
            $returnData['Address']='Address 1'; //(returns symbol address - string) - 5.50 and above
            $returnData['Country']='Bangladesh'; //(returns symbol country - string) - 5.60 and above

            $allInstrumentData[$ins->instrument_code]=$returnData;
        }






        /*$returnData=array();
        $returnData['DIV_PAY_DATE']='';
        $returnData['EX_DIV_DATE']='';
        $returnData['LAST_SPLIT_DATE']='';
        $returnData['LAST_SPLIT_RATIO']='';
        $returnData['EPS']='';
        $returnData['EPS_EST_CUR_YEAR']='';
        $returnData['EPS_EST_NEXT_YEAR']='';
        $returnData['EPS_EST_NEXT_QTR']='';
        $returnData['FORWARD_EPS']='';
        $returnData['PEG_RATIO']='';
        $returnData['BOOK_VALUE']='';  //(requires SHARES_OUT to be specified as well)
        $returnData['BOOK_VALUE_PER_SHARE']='';
        $returnData['EBITDA']='';
        $returnData['PRICE_TO_SALES']='';  //(requires CLOSE to be specified as well)
        $returnData['PRICE_TO_EARNINGS']=''; //(requires CLOSE to be specified as well)
        $returnData['PRICE_TO_BV']='';  //(requires CLOSE to be specified as well)
        $returnData['FORWARD_PE']='';  //(requires CLOSE to be specified as well)
        $returnData['REVENUE']='';
        $returnData['SHARES_SHORT']='';
        $returnData['DIVIDEND']='';
        $returnData['ONE_YEAR_TARGET']='';
        $returnData['MARKET_CAP']=''; //(requires CLOSE to be specified as well - it is used to calculate shares outstanding)
        $returnData['SHARES_FLOAT']='';
        $returnData['SHARES_OUT']='';
        $returnData['PROFIT_MARGIN']='';
        $returnData['OPERATING_MARGIN']='';
        $returnData['RETURN_ON_ASSETS']='';
        $returnData['RETURN_ON_EQUITY']='';
        $returnData['QTRLY_REVENUE_GROWTH']='';
        $returnData['GROSS_PROFIT']='';
        $returnData['QTRLY_EARNINGS_GROWTH']='';
        $returnData['INSIDER_HOLD_PERCENT']='';
        $returnData['INSTIT_HOLD_PERCENT']='';
        $returnData['SHARES_SHORT_PREV']='';
        $returnData['FORWARD_DIV']='';
        $returnData['OPERATING_CASH_FLOW']='';
        $returnData['FREE_CASH_FLOW']='';
        $returnData['BETA']='';*/

        return $allInstrumentData;


    }



} 