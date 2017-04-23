<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBanksIntradayRepository;
use Log;

class AjaxController extends Controller
{
    //
    public function monitor($inst_id, $period)
    {
    	# code...
    	$inst_ids = array();
    	$inst_ids[] = $inst_id;
    	if ($period < 0) $period = 15;
    	$data = DataBanksIntradayRepository::getMinuteData($inst_ids, $period);

    	$bearVolumeData = array();
    	$neutVolumeData = array();
    	$bullVolumeData = array();
    	$priceData = array();
    	$bull = $neutral = $bear = 0;
    	$lastprice = $data[$inst_id][0]->close_price;
    	foreach ($data[$inst_id] as $row) {    		
    		
			if(($lastprice - $row->close_price) < 0) {
				$bear += $row->total_volume_difference;
				//$clr = '#d9534f';
				$bearVolumeData[] = [$row->lm_date_time->timestamp*1000, $row->total_volume_difference];
			}
    		elseif(($lastprice - $row->close_price) == 0) {
    			$neutral += $row->total_volume_difference;
    			$clr = '#5bc0de';
    			$neutVolumeData[] = [$row->lm_date_time->timestamp*1000, $row->total_volume_difference];
			}
    		elseif(($lastprice - $row->close_price) > 0) {
    			$bull += $row->total_volume_difference;
    			$clr = '#5cb85c';
    			$bullVolumeData[] = [$row->lm_date_time->timestamp*1000, $row->total_volume_difference];
    		}


    		// $volumeData .= '{"x":' . $row->lm_date_time->timestamp*1000 . ',"color":"' . $clr . '","y":' . $row->total_volume_difference . '},';
    		
    		$priceData[] = [$row->lm_date_time->timestamp*1000, $row->close_price];

    		
    		$lastprice = $row->close_price;
    	}
    	
    	$returnData = array();
    	$returnData['bearVolumeData'] = $bearVolumeData;
    	$returnData['bullVolumeData'] = $bullVolumeData;
    	$returnData['neutVolumeData'] = $neutVolumeData;
    	$returnData['priceData'] = $priceData;
    	$returnData['bull'] = $bull;
    	$returnData['bear'] = $bear;
    	$returnData['neutral'] = $neutral;

    	return json_encode($returnData);
    }

    public function market()
    {	
    	$ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, "http://www.dsebd.org/bshis_new1_old.php?w=AGRANINS&sid=0.3340593789410694");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        $dataArr = explode("\n", $data);
        $returnArr = array();
        $returnArr[] = $dataArr[9];
        
        $returnArr = array_merge($returnArr, array_slice($dataArr, 22, count($dataArr) - 25));
        //print_r($returnArr);
        $data = implode("\n", $returnArr);
        return $data;
    }

    public function yDay($inst_id, $period)
    {
    	# code...
    	$inst_ids = array();
    	$inst_ids[] = $inst_id;
    	if ($period < 0) $period = 15;
    	$data = DataBanksIntradayRepository::getYdayMinuteData($inst_ids, $period);

    	$bearVolumeData = array();
    	$neutVolumeData = array();
    	$bullVolumeData = array();
    	$priceData = array();
    	$bull = $neutral = $bear = 0;
    	$lastprice = $data[$inst_id][0]->close_price;
    	foreach ($data[$inst_id] as $row) {    		
    		
			if(($lastprice - $row->close_price) < 0) {
				$bear += $row->total_volume_difference;
				//$clr = '#d9534f';
				$bearVolumeData[] = [$row->lm_date_time->timestamp*1000, $row->total_volume_difference];
			}
    		elseif(($lastprice - $row->close_price) == 0) {
    			$neutral += $row->total_volume_difference;
    			$clr = '#5bc0de';
    			$neutVolumeData[] = [$row->lm_date_time->timestamp*1000, $row->total_volume_difference];
			}
    		elseif(($lastprice - $row->close_price) > 0) {
    			$bull += $row->total_volume_difference;
    			$clr = '#5cb85c';
    			$bullVolumeData[] = [$row->lm_date_time->timestamp*1000, $row->total_volume_difference];
    		}


    		// $volumeData .= '{"x":' . $row->lm_date_time->timestamp*1000 . ',"color":"' . $clr . '","y":' . $row->total_volume_difference . '},';
    		
    		$priceData[] = [$row->lm_date_time->timestamp*1000, $row->close_price];

    		
    		$lastprice = $row->close_price;
    	}
    	
    	$returnData = array();
    	$returnData['bearVolumeData'] = $bearVolumeData;
    	$returnData['bullVolumeData'] = $bullVolumeData;
    	$returnData['neutVolumeData'] = $neutVolumeData;
    	$returnData['priceData'] = $priceData;
    	$returnData['bull'] = $bull;
    	$returnData['bear'] = $bear;
    	$returnData['neutral'] = $neutral;

    	return json_encode($returnData);
    }
}
