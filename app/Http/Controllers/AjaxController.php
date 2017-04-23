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

    	$volumeData = array();
    	$priceData = array();
    	$bull = $neutral = $bear = 0;
    	$lastprice = $data[$inst_id][0]->close_price;
    	foreach ($data[$inst_id] as $row) {    		
    		$volumeData[] = [$row->lm_date_time->timestamp*1000, $row->total_volume_difference];
    		$priceData[] = [$row->lm_date_time->timestamp*1000, $row->close_price];

    		if(($lastprice - $row->close_price) < 0) $bear += $row->total_volume_difference;
    		elseif(($lastprice - $row->close_price) == 0) $neutral += $row->total_volume_difference;
    		elseif(($lastprice - $row->close_price) > 0) $bull += $row->total_volume_difference;

    		$lastprice = $row->close_price;
    	}
    	$returnData = array();
    	$returnData['volumeData'] = $volumeData;
    	$returnData['priceData'] = $priceData;
    	$returnData['bull'] = $bull;
    	$returnData['bear'] = $bear;
    	$returnData['neutral'] = $neutral;

    	return json_encode($returnData);
    }
}
