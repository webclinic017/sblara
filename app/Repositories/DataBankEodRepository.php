<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\DataBanksEod;
use App\Exchange;
use Carbon\Carbon;
use App\Repositories\FundamentalRepository;
use App\Repositories\InstrumentRepository;
use App\Repositories\CorporateActionRepository;
use DB;
class DataBankEodRepository {



    public static function getDataForTradingView($instrumentId,$from,$to,$resolution)
    {
        $from=Carbon::createFromTimestamp($from);
        $to=Carbon::createFromTimestamp($to);

        $returnData = array();

            $eodData = DataBanksEod::getEodByInstrument($instrumentId, $from->format('Y-m-d'), $to->format('Y-m-d'));
            if(count($eodData)) {
                $eodData = $eodData->reverse();
                $dateArr = $eodData->pluck('date_timestamp')->toArray();
                $closeArr = $eodData->pluck('close')->toArray();
                $openArr = $eodData->pluck('open')->toArray();
                $highArr = $eodData->pluck('high')->toArray();
                $lowArr = $eodData->pluck('low')->toArray();
                $volumeArr = $eodData->pluck('volume')->toArray();

                $returnData['t'] = $dateArr;
                $returnData['c'] = $closeArr;
                $returnData['o'] = $openArr;
                $returnData['h'] = $highArr;
                $returnData['l'] = $lowArr;
                $returnData['v'] = $volumeArr;
                $returnData['s'] = "ok";
            }else
            {
                $returnData['s'] = "no_data";
                $returnData['nextTime'] = strtotime('yesterday');
            }


        return collect($returnData)->toJson();

    }
    public static function getAdjustedDataForTradingView($instrumentId,$from,$to,$resolution)
    {
        $from=Carbon::createFromTimestamp($from);
        $to=Carbon::createFromTimestamp($to);

        $returnData = array();

        $eodData = self::getEodDataAdjusted($instrumentId, $from, $to, 0);

            if(count($eodData)) {
                $eodData = $eodData->reverse();
                $dateArr = $eodData->pluck('date_timestamp')->toArray();
                $closeArr = $eodData->pluck('close')->toArray();
                $openArr = $eodData->pluck('open')->toArray();
                $highArr = $eodData->pluck('high')->toArray();
                $lowArr = $eodData->pluck('low')->toArray();
                $volumeArr = $eodData->pluck('volume')->toArray();

                $returnData['t'] = $dateArr;
                $returnData['c'] = $closeArr;
                $returnData['o'] = $openArr;
                $returnData['h'] = $highArr;
                $returnData['l'] = $lowArr;
                $returnData['v'] = $volumeArr;
                $returnData['s'] = "ok";
            }else
            {
                $returnData['s'] = "no_data";
                $returnData['nextTime'] = strtotime('yesterday');
            }
        return collect($returnData)->toJson();

    }

    // return data desc
    public static function getSectorEod($sector_list_id=11,$from,$to)
    {
        $from=Carbon::parse($from);
        $to=Carbon::parse($to);

        $from_date=$from->format('Y-m-d');
        $to_date=$to->format('Y-m-d');

        $sql="SELECT
count(data_banks_eods.instrument_id) as total_share,
avg(data_banks_eods.volume) as volume,
avg(data_banks_eods.open)as open,
avg(data_banks_eods.high)as high,
avg(data_banks_eods.low)as low,
avg(data_banks_eods.close)as close ,
data_banks_eods.date
FROM data_banks_eods,instruments
where (data_banks_eods.instrument_id=instruments.id) and
(instruments.sector_list_id=$sector_list_id) and
data_banks_eods.date BETWEEN '$from_date' AND '$to_date'
GROUP BY data_banks_eods.date ORDER BY data_banks_eods.date desc";

        $data=DB::select(DB::raw($sql));

        return $data;
    }

    public static function getIntradayCandle($instrument_id=13,$from,$to,$period=60)
    {

        $from=Carbon::parse($from);
        $to=Carbon::parse($to);

        $from_date=$from->format('Y-m-d');
        $to_date=$to->format('Y-m-d');

        $sql="SELECT
SUBSTRING_INDEX(GROUP_CONCAT(CAST(open_price AS CHAR) ORDER BY lm_date_time), ',', 1 ) as open,
MAX(high_price) as high,
MIN(low_price) as low,
SUBSTRING_INDEX(GROUP_CONCAT(CAST(pub_last_traded_price AS CHAR) ORDER BY lm_date_time DESC), ',', 1 ) as close,
AVG(total_volume) volume,
lm_date_time
FROM data_banks_intradays
WHERE instrument_id=$instrument_id AND lm_date_time BETWEEN '$from_date' AND '$to_date'
GROUP BY (UNIX_TIMESTAMP(lm_date_time) + 0) DIV $period
ORDER BY lm_date_time DESC";

        $data=DB::select(DB::raw($sql));

        return $data;
    }


    // return data desc
    public static function getEodData($instrumentId,$from,$to)
    {

        $from=Carbon::parse($from);
        $to=Carbon::parse($to);
       $eodData=DataBanksEod::getEodByInstrument($instrumentId,$from->format('Y-m-d'),$to->format('Y-m-d'));
       $eodData=$eodData->sortByDesc('date_timestamp');


       $timestampArr=$eodData->pluck('date_timestamp')->toArray();
       $closeArr=$eodData->pluck('close')->toArray();
       $openArr=$eodData->pluck('open')->toArray();
       $highArr=$eodData->pluck('high')->toArray();
       $lowArr=$eodData->pluck('low')->toArray();
       $volumeArr=$eodData->pluck('volume')->toArray();


        $returnData=array();
        $returnData['t']=$timestampArr;
        $returnData['c']=$closeArr;
        $returnData['o']=$openArr;
        $returnData['h']=$highArr;
        $returnData['l']=$lowArr;
        $returnData['v']=$volumeArr;
        $returnData['s']="ok";
        return collect($returnData);

    }

    // return data asc. This is needed for highchart candle. Otherwise candle chart will not be shown
    public static function getEodDataAsc($instrumentId,$from,$to)
    {

       $from=Carbon::parse($from);
       $to=Carbon::parse($to);
       $eodData=DataBanksEod::getEodByInstrument($instrumentId,$from->format('Y-m-d'),$to->format('Y-m-d'));
       $eodData=$eodData->sortBy('date_timestamp');


       $timestampArr=$eodData->pluck('date_timestamp')->toArray();
       $closeArr=$eodData->pluck('close')->toArray();
       $openArr=$eodData->pluck('open')->toArray();
       $highArr=$eodData->pluck('high')->toArray();
       $lowArr=$eodData->pluck('low')->toArray();
       $volumeArr=$eodData->pluck('volume')->toArray();


        $returnData=array();
        $returnData['t']=$timestampArr;
        $returnData['c']=$closeArr;
        $returnData['o']=$openArr;
        $returnData['h']=$highArr;
        $returnData['l']=$lowArr;
        $returnData['v']=$volumeArr;
        $returnData['s']="ok";
        return collect($returnData);

    }

    public static function getPluginEodData($instrumentCode,$from,$to,$adjusted=1)
    {
        $instrumentInfo=InstrumentRepository::getInstrumentsByCode($instrumentCode)->first();
        if($adjusted) {
            $returnData = self::getEodDataAdjusted($instrumentInfo->id, $from, $to, 0);
        }
        else
        {
            $eodData=DataBanksEod::getEodByInstrument($instrumentInfo->id,$from,$to);
            $returnData=$eodData->sortByDesc('date_timestamp');
        }
        $eodForPlugin=array();
        $eodForPlugin[]=array('Code','Date','Open','High','Low','Close','Volume');
        foreach($returnData as $row)
        {
            $temp=array();
            $temp[]=$instrumentInfo->instrument_code;
            $temp[]=date('d/m/Y',$row['date_timestamp']);
            $temp[]=$row['open'];
            $temp[]=$row['high'];
            $temp[]=$row['low'];
            $temp[]=$row['close'];
            $temp[]=$row['volume'];

            $eodForPlugin[]=$temp;
        }

        return $eodForPlugin;
    }
    public static function getPluginEodDataAll($from,$to,$adjusted=1,$instrumentCodeArr=array())
    {
        $instrumentIdArr=array();

        if(!empty($instrumentCodeArr))
        {
            $allInstrumentInfo=InstrumentRepository::getInstrumentsScripWithIndex();

            foreach($instrumentCodeArr as $instrumentCode)
            {
                $instrumentInfo=$allInstrumentInfo->whereInStrict('instrument_code',$instrumentCode)->first();
                $instrumentIdArr[]=$instrumentInfo->id;
            }

        }
        $eodForPlugin=self::getEodForCSV($from,$to,$instrumentIdArr,$adjusted);
        return $eodForPlugin;
    }
    /*
     * Buy default it will return ohlc array
     * @params instrument_id , form date, end date, $ohlc_format
     * */
    public static function getEodDataAdjusted($instrumentId,$form,$to,$ohlc_format=1)
    {
        if(is_int($form))
        {
            $form = Carbon::createFromTimestamp($form);

        }else
        {
            $form = Carbon::parse($form);
        }

        if (is_int($to)) {
            $to = Carbon::createFromTimestamp($to);
        } else {
            $to = Carbon::parse($to);
        }



       $eodData=DataBanksEod::getEodByInstrument($instrumentId,$form->format('Y-m-d'),$to->format('Y-m-d'));

        $faceValue=FundamentalRepository::getFundamentalData(array('face_value'),array($instrumentId))->toArray();
        $corporateActionData=CorporateActionRepository::getCorporateAction(array($instrumentId));

        $resultarr = $eodData->toArray();

        foreach ($corporateActionData as $row) {
            $action = $row->action;
            $adjustedArr = array();

            if ($action == 'stockdiv') {
                $adjustmentFactor = (100 + $row->value) / 100;
                $daystamp = $row->record_date->timestamp;

                foreach ($resultarr as $data) {

                    if ($data['date_timestamp'] < $daystamp) {
                        $data['date'] = $data['date'];
                        $data['open'] = $data['open'] / $adjustmentFactor;
                        $data['high'] = $data['high'] / $adjustmentFactor;
                        $data['low'] =  $data['low'] / $adjustmentFactor;
                        $data['close'] = $data['close'] / $adjustmentFactor;
                        // Notes: In previous version volume is not adjustd
                        $data['volume'] = $data['volume'] * $adjustmentFactor;
                    }

                    $adjustedArr[] = $data;
                }

                $resultarr = array();
                $resultarr = $adjustedArr;

            } elseif ($action == 'cashdiv') {


                if(isset($faceValue['face_value']['meta_value']))
                    $facevalue = $faceValue['face_value']['meta_value'];
                else
                    $facevalue=10;

                $adjustmentFactor = $facevalue * $row->value / 100;
                $daystamp = $row->record_date->timestamp;

                foreach ($resultarr as $data) {
                    if ($data['date_timestamp'] < $daystamp) {
                        $data['date'] = $data['date'];
                        $data['open'] = $data['open'] - $adjustmentFactor;
                        $data['high'] = $data['high'] - $adjustmentFactor;
                        $data['low'] = $data['low'] - $adjustmentFactor;
                        $data['close'] = $data['close'] - $adjustmentFactor;
                    }

                    $adjustedArr[] = $data;
                }

                $resultarr = array();
                $resultarr = $adjustedArr;

            } elseif ($action == 'rightshare') {

                if(isset($faceValue['face_value']['meta_value']))
                    $facevalue = $faceValue['face_value']['meta_value'];
                else
                    $facevalue=10;

                $adjustmentFactor = (100 + $row->value) / 100;
                $premium = $row->premium;

                $daystamp = $row->record_date->timestamp;

                foreach ($resultarr as $data) {
                    if ($data['date_timestamp'] < $daystamp) {
                        $data['date'] = $data['date'];
                        $data['open'] = (($data['open'] * 100) + (($premium + $facevalue) * $row->value)) / (100 + $row->value);
                        $data['high'] = (($data['high'] * 100) + (($premium + $facevalue) * $row->value)) / (100 + $row->value);
                        $data['low'] = (($data['low'] * 100) + (($premium + $facevalue) * $row->value)) / (100 + $row->value);
                        $data['close'] = (($data['close'] * 100) + (($premium + $facevalue) * $row->value)) / (100 + $row->value);
                        // Notes: In previous version volume is not adjustd
                        $data['volume'] = $data['volume'] * $adjustmentFactor;

                    }

                    $adjustedArr[] = $data;
                }

                $resultarr = array();
                $resultarr = $adjustedArr;

            } elseif ($action == 'split') {
                $adjustmentFactor = $row->value;

                $daystamp = $row->record_date->timestamp;

                foreach ($resultarr as $data) {
                    if ($data['date_timestamp'] < $daystamp) {
                        $data['date'] = $data['date'];
                        $data['open'] = $data['open'] / $adjustmentFactor;
                        $data['high'] = $data['high'] / $adjustmentFactor;
                        $data['low'] = $data['low'] / $adjustmentFactor;
                        $data['close'] = $data['close'] / $adjustmentFactor;
                        $data['volume'] = $data['volume'] * $adjustmentFactor;
                    }

                    $adjustedArr[] = $data;
                }
                $resultarr = array();
                $resultarr = $adjustedArr;

            }

        }

        $eodData = collect($resultarr);


        if($ohlc_format)
        {
            $dateArr=$eodData->pluck('date_timestamp')->toArray();
            $closeArr=$eodData->pluck('close')->toArray();
            $openArr=$eodData->pluck('open')->toArray();
            $highArr=$eodData->pluck('high')->toArray();
            $lowArr=$eodData->pluck('low')->toArray();
            $volumeArr=$eodData->pluck('volume')->toArray();

            $returnData=array();
            $returnData['t']=$dateArr;
            $returnData['c']=$closeArr;
            $returnData['o']=$openArr;
            $returnData['h']=$highArr;
            $returnData['l']=$lowArr;
            $returnData['v']=$volumeArr;
            $returnData['s']="ok";
            return collect($returnData);
        }
        else
        {
            return $eodData;
        }

    }

    public static function getEodForCSV($form,$to,$instrumentIdArr=array(),$adjusted=1)
    {

       $form=Carbon::parse($form);
       $to=Carbon::parse($to);
        $eodDataGrouped=DataBanksEod::getEodForCSV($form->format('Y-m-d'),$to->format('Y-m-d'),$instrumentIdArr);

        if($adjusted)
        {
            $faceValue=FundamentalRepository::getFundamentalDataAll(array('face_value'))->toArray();

            $corporateActionData=CorporateActionRepository::getCorporateActionAll($form->format('Y-m-d'),$to->format('Y-m-d'),$instrumentIdArr);
            $corporateActionDataGrouped=$corporateActionData->groupBy('instrument_id');

            // $eodDataGrouped = $eodData->groupBy('instrument_id')->toArray();
            //dd($resultarr);

            foreach($corporateActionDataGrouped as $instrument_id=>$corporateActionData)
            {
                foreach ($corporateActionData as $row) {
                    $action = $row->action;
                    $adjustedArr = array();

                    if(isset($eodDataGrouped[$instrument_id])) {
                        $resultarr = $eodDataGrouped[$instrument_id];
                    }else
                    {
                        //dump($instrument_id);
                        continue;
                    }

                    if ($action == 'stockdiv') {
                        $adjustmentFactor = (100 + $row->value) / 100;
                        $daystamp = $row->record_date->timestamp;

                        foreach ($resultarr as $data) {

                            if ($data['date_timestamp'] < $daystamp) {
                                $data['date'] = $data['date'];
                                $data['open'] = $data['open'] / $adjustmentFactor;
                                $data['high'] = $data['high'] / $adjustmentFactor;
                                $data['low'] =  $data['low'] / $adjustmentFactor;
                                $data['close'] = $data['close'] / $adjustmentFactor;
                                // Notes: In previous version volume is not adjustd
                                $data['volume'] = $data['volume'] * $adjustmentFactor;
                            }

                            $adjustedArr[] = $data;
                        }

                        $resultarr = array();
                        $resultarr = $adjustedArr;

                    } elseif ($action == 'cashdiv') {


                        if(isset($faceValue['face_value']['meta_value']))
                            $facevalue = $faceValue['face_value']['meta_value'];
                        else
                            $facevalue=10;

                        $adjustmentFactor = $facevalue * $row->value / 100;
                        $daystamp = $row->record_date->timestamp;

                        foreach ($resultarr as $data) {


                            if ($data['date_timestamp'] < $daystamp) {
                                $data['date'] = $data['date'];
                                $data['open'] = $data['open'] - $adjustmentFactor;
                                $data['high'] = $data['high'] - $adjustmentFactor;
                                $data['low'] = $data['low'] - $adjustmentFactor;
                                $data['close'] = $data['close'] - $adjustmentFactor;
                            }

                            $adjustedArr[] = $data;
                        }

                        $resultarr = array();
                        $resultarr = $adjustedArr;

                    } elseif ($action == 'rightshare') {

                        if(isset($faceValue['face_value']['meta_value']))
                            $facevalue = $faceValue['face_value']['meta_value'];
                        else
                            $facevalue=10;

                        $adjustmentFactor = (100 + $row->value) / 100;
                        $premium = $row->premium;

                        $daystamp = $row->record_date->timestamp;

                        foreach ($resultarr as $data) {


                            if ($data['date_timestamp'] < $daystamp) {
                                $data['date'] = $data['date'];
                                $data['open'] = (($data['open'] * 100) + (($premium + $facevalue) * $row->value)) / (100 + $row->value);
                                $data['high'] = (($data['high'] * 100) + (($premium + $facevalue) * $row->value)) / (100 + $row->value);
                                $data['low'] = (($data['low'] * 100) + (($premium + $facevalue) * $row->value)) / (100 + $row->value);
                                $data['close'] = (($data['close'] * 100) + (($premium + $facevalue) * $row->value)) / (100 + $row->value);
                                // Notes: In previous version volume is not adjustd
                                $data['volume'] = $data['volume'] * $adjustmentFactor;

                            }

                            $adjustedArr[] = $data;
                        }

                        $resultarr = array();
                        $resultarr = $adjustedArr;

                    } elseif ($action == 'split') {
                        $adjustmentFactor = $row->value;

                        $daystamp = $row->record_date->timestamp;

                        foreach ($resultarr as $data) {


                            if ($data['date_timestamp'] < $daystamp) {
                                $data['date'] = $data['date'];
                                $data['open'] = $data['open'] / $adjustmentFactor;
                                $data['high'] = $data['high'] / $adjustmentFactor;
                                $data['low'] = $data['low'] / $adjustmentFactor;
                                $data['close'] = $data['close'] / $adjustmentFactor;
                                $data['volume'] = $data['volume'] * $adjustmentFactor;
                            }

                            $adjustedArr[] = $data;
                        }
                        $resultarr = array();
                        $resultarr = $adjustedArr;

                    }

                }

                $eodDataGrouped[$instrument_id]=$resultarr;
            }


        }

        $returnData[]=array('Code','Date','Open','High','Low','Close','Volume');

        foreach($eodDataGrouped as $dataByInstrumentId)
        {
            foreach($dataByInstrumentId as $row) {
                $temp = array();
                $temp[] = $row['code'];
                $temp[] = $row['ndate'];
                $temp[] = $row['open'];
                $temp[] = $row['high'];
                $temp[] = $row['low'];
                $temp[] = $row['close'];
                $temp[] = $row['volume'];
                $returnData[] = $temp;
            }
        }

        /*$eodData = collect($resultarr);



       $dateArr=$eodData->pluck('date_timestamp')->toArray();
       $closeArr=$eodData->pluck('close')->toArray();
       $openArr=$eodData->pluck('open')->toArray();
       $highArr=$eodData->pluck('high')->toArray();
       $lowArr=$eodData->pluck('low')->toArray();
       $volumeArr=$eodData->pluck('volume')->toArray();

        $returnData=array();
        $returnData['t']=$dateArr;
        $returnData['c']=$closeArr;
        $returnData['o']=$openArr;
        $returnData['h']=$highArr;
        $returnData['l']=$lowArr;
        $returnData['v']=$volumeArr;
        $returnData['s']="ok";*/

        return collect($returnData);

    }




    public static function getPriceChangeHistory($from,$to,$resolutionArr=array(),$instrumentIdArr=array(),$select=array())
    {

        $from=Carbon::parse($from);
        $to=Carbon::parse($to);


        $eodDataGrouped=DataBanksEod::getEodForCSV($from->format('Y-m-d'),$to->format('Y-m-d'),$instrumentIdArr,$select);


        $returnArr=array();

        foreach($eodDataGrouped as $instrument_id=>$allDataOfThisInstrument)
        {

            foreach($resolutionArr as $period)
            {
                $chunk=collect($allDataOfThisInstrument)->chunk($period);
                $latest=$chunk->first()->first()->toArray();
                $oldest=$chunk->last()->first()->toArray();

                $price_change=$latest['close']-$oldest['close'];
                $price_change_per=$price_change/$oldest['close']*100;
                $latest['price_change']=$price_change;
                $latest['price_change_per']= (float) number_format($price_change_per, 2, '.', '');

                $returnArr[$instrument_id][$period]=$latest;

            }

        }
        return collect($returnArr);

    }


} 