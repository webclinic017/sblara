<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\UserRepository;
use Log;

class AjaxController extends Controller
{
    //
    public function monitor($inst_id, $period,$dayBefore=0)
    {
        $minuteChartData = DataBanksIntradayRepository::getDataForMinuteChart($inst_id,1,$dayBefore);

        $instrumentIdArr=array();
        $instrumentIdArr[]=(int) $inst_id;

        $instrumentInfo=InstrumentRepository::getInstrumentsById($instrumentIdArr)->first();

        $returnData=array();
        $returnData['div'] ='mm_div_'.rand(1111,1111111); // required
        $returnData['height'] = 200; // required
        $returnData['title'] = 'name';
        $returnData['instrumentInfo'] = $instrumentInfo->instrument_code;

        $returnData['xcat'] =array_slice($minuteChartData['date_data'],(-1)*$period);
        $returnData['ydata']=array_slice($minuteChartData['volume_data'],(-1)*$period);
        $returnData['xdata']=array_slice($minuteChartData['close_data'],(-1)*$period);

        $returnData['price_chart_color'] = $minuteChartData['yday_close_price']<$minuteChartData['cp']?'#26C281':'#D91E18';
        $returnData['lm_date_time'] = $minuteChartData['lm_date_time'];
        $returnData['bullBear'] = array_reverse($minuteChartData['bullBear']);
        $returnData['day_total_volume'] = $minuteChartData['day_total_volume'];

        return collect($returnData)->toJson(JSON_NUMERIC_CHECK);
    }

    public function market($inst_id)
    {
        $instrumentIdArr=array();
        $instrumentIdArr[]=(int) $inst_id;

        $instrumentInfo=InstrumentRepository::getInstrumentsById($instrumentIdArr)->first();
        $instrumentCode=$instrumentInfo->instrument_code;
    	$ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, "http://www.dsebd.org/bshis_new1_old.php?w=$instrumentCode&sid=0.3340593789410694");
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
    	date_default_timezone_set('UTC');
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
				
				$bearVolumeData[] = [$row->lm_date_time->timestamp*1000, $row->total_volume_difference];
			}
    		elseif(($lastprice - $row->close_price) == 0) {
    			$neutral += $row->total_volume_difference;
    			$neutVolumeData[] = [$row->lm_date_time->timestamp*1000, $row->total_volume_difference];
			}
    		elseif(($lastprice - $row->close_price) > 0) {
    			$bull += $row->total_volume_difference;
    			$bullVolumeData[] = [$row->lm_date_time->timestamp*1000, $row->total_volume_difference];
    		}
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
    	date_default_timezone_set('asia/dhaka');
    	return json_encode($returnData);
    }
    public function saveData(Request $request)
    {
    	$savedUserData = ['symbols'=>array(),'periods' => array()];
    	$savedUserData['symbols'] = explode(',', $request->input('symbols'));
    	$savedUserData['periods'] = explode(',', $request->input('periods'));
    	UserRepository::saveUserInfo(array('market_monitor_settings'),serialize($savedUserData),5);
    	return view('monitor');
    }
}
