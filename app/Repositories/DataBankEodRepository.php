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
use App\Repositories\CorporateActionRepository;
class DataBankEodRepository {



    public static function getDataForTradingView($instrumentId,$form,$to)
    {


        $form=Carbon::createFromTimestamp($form);
        $to=Carbon::createFromTimestamp($to);

       $eodData=DataBanksEod::getEodByInstrument($instrumentId,$to->format('Y-m-d'),$form->format('Y-m-d'));
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
        return collect($returnData)->toJson();

    }

    public static function getEodData($instrumentId,$form,$to)
    {

        $form=Carbon::parse($form);
        $to=Carbon::parse($to);
       $eodData=DataBanksEod::getEodByInstrument($instrumentId,$to->format('Y-m-d'),$form->format('Y-m-d'));

        $dataBankallGroup = $eodData->groupBy(function($item){ return $item->date->format('Y-m-d'); });

        $eodData=array();
        //eliminating duplicate if exist
        foreach ($dataBankallGroup as $eachTradeDate) {
            $volume=0;
            foreach($eachTradeDate as $eachData)  // to eliminate duplicate data. We will take higher volume data
            {

                if($eachData->volume>$volume)
                {
                    $data=clone $eachData;
                    $volume=$eachData->volume;
                }
            }
            $eodData[]=$data;
        }

       $eodData=collect($eodData);


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
    public static function getEodDataAdjusted($instrumentId,$form,$to)
    {

        $form=Carbon::parse($form);
        $to=Carbon::parse($to);
       $eodData=DataBanksEod::getEodByInstrument($instrumentId,$to->format('Y-m-d'),$form->format('Y-m-d'));

        $dataBankallGroup = $eodData->groupBy(function($item){ return $item->date->format('Y-m-d'); });

        $eodData=array();
        //eliminating duplicate if exist
        foreach ($dataBankallGroup as $eachTradeDate) {
            $volume=0;
            foreach($eachTradeDate as $eachData)  // to eliminate duplicate data. We will take higher volume data
            {

                if($eachData->volume>$volume)
                {
                    $data=clone $eachData;
                    $volume=$eachData->volume;
                }
            }
            $eodData[]=$data;
        }

       $eodData=collect($eodData);

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


} 