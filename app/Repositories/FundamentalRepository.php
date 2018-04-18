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
use Illuminate\Support\Facades\Cache;
class FundamentalRepository {
    /*
     * Sample call
     * dump(FundamentalRepository::getFundamentalData(array('stock_dividend','total_no_securities'),array('ABBANK','ACI'))->toArray());
        dump(FundamentalRepository::getFundamentalData(array(13,211),array('ABBANK','ACI'))->toArray());
        dump(FundamentalRepository::getFundamentalData(array('stock_dividend','total_no_securities'),array(12,13))->toArray());
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
  "total_no_securities" => array:9 [▼
    "id" => 3389
    "instrument_id" => 13
    "meta_id" => 13
    "meta_value" => "34394122"
    "meta_date" => Carbon {#893 ▶}
    "created" => "2014-10-29 11:38:31"
    "updated" => "2014-10-29 11:38:31"
    "meta_key" => "total_no_securities"
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


        $groupByMetaData = Fundamental::getDataLatest($metaId,$instrumentId)->groupby('meta_id');
        //$groupByMetaData = Fundamental::getData($metaId,$instrumentId)->groupby('meta_id');


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
    public static function getFundamentalDataLatest($meta=array(),$ins=array())
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


        $groupByInstrumentData = Fundamental::getDataLatest($metaId,$instrumentId)->groupby('instrument_id');


        $fundamentalData=array();
        foreach($groupByInstrumentData as $instrumentId=>$allMetaData)
        {
            foreach($allMetaData as $metaData)
            {
                $meta_key=$metaInfo->where('id', $metaData->meta_id)->first()->meta_key;
                $instrument_code=$instrumentInfo->where('id', $metaData->instrument_id)->first()->instrument_code;
                $latestData['meta_key']=$meta_key;
                $latestData['instrument_code']=$instrument_code;
                $fundamentalData[$instrumentId][$meta_key]= $metaData;

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

        //$metaKey=array('q1_eps_cont_op','half_year_eps_cont_op','q3_nine_months_eps','earning_per_share');
        $metaKey=array('q1_eps_cont_op','q2_eps_cont_op','q3_eps_cont_op','earning_per_share');


        $fundaData=self::getFundamentalDataLatest($metaKey,$instrumentIdArr);



        $returnData = array();
        foreach ($instrumentIdArr as $instrument_id)
        {


            if(isset($fundaData[$instrument_id]))
            {



                foreach($fundaData[$instrument_id] as $eps_name=>$data)
                {

                    if ($eps_name == 'q1_eps_cont_op') {


                        $returnData[$instrument_id]['annualized_eps'] = (float) $data['meta_value'] * 4;
                        $returnData[$instrument_id]['meta_date'] = $data['meta_date'];
                        $returnData[$instrument_id]['meta_value'] = (float)$data['meta_value'];
                        //$returnData[$instrument_id]['text'] = date('M,y',strtotime($data['meta_date']));
                        $returnData[$instrument_id]['text'] = '3 months';
                    }

                    if ($eps_name == 'q2_eps_cont_op') {

                        $q2_eps_cont_op= (float)$data['meta_value'];

                        if (isset($fundaData[$instrument_id]['q1_eps_cont_op'])) {
                            $q2_eps_cont_op = $q2_eps_cont_op+ (float)$fundaData[$instrument_id]['q1_eps_cont_op']['meta_value'];
                        }

                        $returnData[$instrument_id]['annualized_eps'] = $q2_eps_cont_op * 2;
                        $returnData[$instrument_id]['meta_date'] = $data['meta_date'];
                        $returnData[$instrument_id]['meta_value'] = $q2_eps_cont_op;
                        //$returnData[$instrument_id]['text'] = date('M,y', strtotime($data['meta_date']));
                        $returnData[$instrument_id]['text'] = '6 Months';

                    }


                    if ($eps_name == 'q3_eps_cont_op') {

                        $q3_eps_cont_op = (float)$data['meta_value'];

                        if (isset($fundaData[$instrument_id]['q1_eps_cont_op'])) {
                            $q3_eps_cont_op = $q3_eps_cont_op + (float)$fundaData[$instrument_id]['q1_eps_cont_op']['meta_value'];
                        }

                        if (isset($fundaData[$instrument_id]['q2_eps_cont_op'])) {
                            $q3_eps_cont_op = $q3_eps_cont_op + (float)$fundaData[$instrument_id]['q2_eps_cont_op']['meta_value'];
                        }


                        $returnData[$instrument_id]['annualized_eps'] = ($q3_eps_cont_op/3) * 4;
                        $returnData[$instrument_id]['annualized_eps']=round($returnData[$instrument_id]['annualized_eps'],4);
                        $returnData[$instrument_id]['meta_date'] = $data['meta_date'];
                        $returnData[$instrument_id]['meta_value'] = round($q3_eps_cont_op,4);
                        //$returnData[$instrument_id]['text'] = date('M,y', strtotime($data['meta_date']));
                        $returnData[$instrument_id]['text'] = "9 months";

                    }

                    if ($eps_name == 'earning_per_share') {
                        $returnData[$instrument_id]['annualized_eps'] = (float)$data['meta_value'];
                        $returnData[$instrument_id]['meta_date'] = $data['meta_date'];
                        $returnData[$instrument_id]['meta_value'] = (float)$data['meta_value'];
                        $returnData[$instrument_id]['text'] = 'Annual';
                    }

                    break;

                }


            }
            else
            {
                $returnData[$instrument_id]['annualized_eps'] = 0;
                $returnData[$instrument_id]['meta_date'] = 'n/a';
                $returnData[$instrument_id]['text'] = 'n/a';
                $returnData[$instrument_id]['meta_value'] = 'n/a';
            }


        }



/*        sbdump($returnData,'afmsohail@gmail.com');
        sbdump($data_to_sort,'afmsohail@gmail.com');
        sbdd($fundaData->toArray(),'afmsohail@gmail.com');*/

        return $returnData;
    }


    public static function getAmibrokerFundamentalData($instrument_code)
    {

        // this is sample data
        // https://www.amibroker.com/guide/objects.html

        $allInstrumentData=array();
        $instrumentList = InstrumentRepository::getInstrumentsScripWithIndex();
        $instrument_arr = $instrumentList->pluck('id');
        $sectorList=SectorListRepository::getSectorList();

        $metaKey = array("total_no_securities","paid_up_capital", "earning_per_share", "net_asset_val_per_share", "share_percentage_director", "share_percentage_public", "share_percentage_institute", "share_percentage_foreign", "share_percentage_govt");

        $fundamentaInfo = Cache::remember("plugin_fundamental", 300, function () use ($metaKey, $instrument_arr) {
            $fundamentaInfo = self::getFundamentalData($metaKey, $instrument_arr);
            return $fundamentaInfo;
        });


        $epsData = Cache::remember("plugin_annualized_eps", 300, function () use ($instrument_arr) {
            $epsData = FundamentalRepository::getAnnualizedEPS($instrument_arr);
            return $epsData;
        });


        $sql="SELECT * from corporate_action where (action LIKE 'stockdiv' or action LIKE 'cashdiv') and record_date in (SELECT MAX(record_date) as record_date FROM corporate_action GROUP BY instrument_id) ORDER BY instrument_id ASC,record_date desc";
        $corporate_action_all = \DB::select($sql);


        $corporate_action=array();
        foreach($corporate_action_all as $row)
        {
            $corporate_action[$row->instrument_id][$row->record_date][$row->action]= $row->value;
        }


        // dd($sectorList);
        foreach ($instrumentList as $ins) {
            $instrument_id=$ins->id;
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


            if (isset($fundamentaInfo['earning_per_share'][$instrument_id])) {
                $returnData['EPS'] = $fundamentaInfo['earning_per_share'][$instrument_id]['meta_value'];
            } else {
                $returnData['EPS'] = 0;
            }

            if (isset($epsData[$instrument_id])) {
                $returnData['EPSEstCurrentYear'] = $epsData[$instrument_id]['annualized_eps'];
            } else {
                $returnData['EPSEstCurrentYear'] = 0;
            }

            $returnData['EPSEstNextYear'] = 0;  // not providing
            $returnData['EPSEstNextQuarter'] = 0;  // not providing
            $returnData['PEGRatio'] = 0;  // not providing


            $total_no_securities= isset($fundamentaInfo['total_no_securities'][$instrument_id]) ? $fundamentaInfo['total_no_securities'][$instrument_id]['meta_value'] : 0;
            $total_no_securities=floatval($total_no_securities);

            $share_percentage_director= isset($fundamentaInfo['share_percentage_director'][$instrument_id])? $fundamentaInfo['share_percentage_director'][$instrument_id]['meta_value']:0;
            $share_percentage_director=floatval($share_percentage_director)/100* $total_no_securities;
            $share_percentage_public= isset($fundamentaInfo['share_percentage_public'][$instrument_id])? $fundamentaInfo['share_percentage_public'][$instrument_id]['meta_value']:0;
            $share_percentage_public = floatval($share_percentage_public) / 100 * $total_no_securities;
            $share_percentage_institute= isset($fundamentaInfo['share_percentage_institute'][$instrument_id])? $fundamentaInfo['share_percentage_institute'][$instrument_id]['meta_value']:0;
            $share_percentage_institute = floatval($share_percentage_institute) / 100 * $total_no_securities;
            $share_percentage_foreign= isset($fundamentaInfo['share_percentage_foreign'][$instrument_id])? $fundamentaInfo['share_percentage_foreign'][$instrument_id]['meta_value']:0;
            $share_percentage_foreign = floatval($share_percentage_foreign) / 100 * $total_no_securities;

            $returnData['SharesFloat'] = $share_percentage_public+ $share_percentage_institute+ $share_percentage_foreign; // providing pub+ins+foriegn
            $returnData['SharesOut'] = $total_no_securities; // providing

            if (isset($corporate_action[$instrument_id])) {
                $last_dividend = array_values($corporate_action[$instrument_id])[0];
                $total_dividend = array_sum($last_dividend);

                $last_dividend_date= array_keys($corporate_action[$instrument_id])[0];
                $last_dividend_date=date('d/m/Y',strtotime($last_dividend_date));

            }else
            {
                $total_dividend=0;
                $last_dividend_date='01/01/1970';
            }


            $returnData['DividendPayDate'] = $last_dividend_date;

            $returnData['ExDividendDate'] = '01/01/1970';

            $returnData['BookValuePerShare'] = isset($fundamentaInfo['net_asset_val_per_share'][$instrument_id]) ? $fundamentaInfo['net_asset_val_per_share'][$instrument_id]['meta_value'] : 0;


            $returnData['DividendPerShare'] = $total_dividend;
            $returnData['ProfitMargin'] = 0;
            $returnData['OperatingMargin'] = 0;
            $returnData['OneYearTargetPrice'] = 0;
            $returnData['ReturnOnAssets'] = 0;
            $returnData['ReturnOnEquity'] = 0;
            $returnData['QtrlyRevenueGrowth'] = 0;
            $returnData['GrossProfitPerShare'] = 0;
            $returnData['SalesPerShare'] = 0;
            $returnData['EBITDAPerShare'] = 0;
            $returnData['QtrlyEarningsGrowth'] = 0;
            $returnData['InsiderHoldPercent'] = isset($fundamentaInfo['share_percentage_director'][$instrument_id]) ? $fundamentaInfo['share_percentage_director'][$instrument_id]['meta_value'] : 0;  // providing -director
            $returnData['InstitutionHoldPercent'] = isset($fundamentaInfo['share_percentage_institute'][$instrument_id]) ? $fundamentaInfo['share_percentage_institute'][$instrument_id]['meta_value'] : 0;
            $returnData['SharesShort'] = 0;
            $returnData['SharesShortPrevMonth'] = 0;
            $returnData['ForwardDividendPerShare'] = 0;
            $returnData['ForwardEPS'] = 0;
            $returnData['OperatingCashFlow'] = 0;
            $returnData['LeveredFreeCashFlow'] = 0;
            $returnData['Beta'] = 0;
            $returnData['LastSplitRatio'] = '1:1'; // providing
            $returnData['LastSplitDate'] = '01/01/1970'; // providing
            $returnData['Alias'] = $ins->instrument_code;  //(returns symbol alias - string) - 5.50 and above
            $returnData['Address'] = ''; //(returns symbol address - string) - 5.50 and above
            $returnData['Country'] = 'Bangladesh'; //(returns symbol country - string) - 5.60 and above

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

    public static function store($instrument_id, $meta_key, $meta_value)
    {
        $meta_id = \App\Meta::where('meta_key', $meta_key)->first()->id;
       /*set preivous latest to 0*/
        \App\Fundamental::where('instrument_id', $instrument_id)
                         ->where('meta_id', $meta_id)
                         ->update(['is_latest' => 0]);
                         

        /*insert new row*/
        \App\Fundamental::create([
                            'is_latest' => 1, 
                            'instrument_id' => $instrument_id, 
                            'meta_id' => $meta_id, 
                            'meta_value' => $meta_value,
                            'meta_date' => date('Y-m-d')
                        ]);
    }



} 