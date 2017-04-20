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


} 