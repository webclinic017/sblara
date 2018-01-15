<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\DataBankEodRepository;
use App\Repositories\FundamentalRepository;
use App\Repositories\SectorListRepository;
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

        return response()
         ->json(collect($returnData))->setTtl(60);
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
    	UserRepository::saveUserInfo(array('market_monitor_settings'),serialize($savedUserData));
    	return redirect()->back();
    }
    public function load_block($param)
    {
        $paramArr=explode(':',$param);
        $viewData=array();
        foreach($paramArr as $each_param)
        {
            $explodeArr=explode('=',$each_param);
            $param_name=$explodeArr[0];
            $param_value=$explodeArr[1];

            $viewData[$param_name]=$param_value;

        }
        $viewData=r_collect($viewData);

        return response()->view('load_block',
            [
                'viewData' => $viewData

            ]
        //);
        )->setTtl(60);
        //return view('load_block',['viewData' => $viewData,'insid' => 12]);
    }

    public function marketDepthData($inst_id)
    {
        $instrumentInfo=InstrumentRepository::getInstrumentsById(array((int) $inst_id))->first();
        $code=$instrumentInfo->instrument_code;
        $getText = getWebPage('http://www.dsebd.org/bshis_new1_old.php?w=' . $code);
        //dd($getText);
        $getText = preg_replace('/Please click on the button to refresh/', ' ', $getText);
        $getText = preg_replace('/<INPUT\b[^>]*>(.*?)[^>]/', ' ', $getText);
        $getText = preg_replace('/<META\b[^>]*>(.*?)[^>]/', ' ', $getText);
        $getText = preg_replace('/<script async\b[^>]*>(.*?)script>/', ' ', $getText);

        $sendData['dsePage']=$getText;
        $sendData['code']=$code;
        $data=json_encode($sendData, JSON_HEX_QUOT | JSON_HEX_TAG);
        return $data;
    }
    public function data_matrix()
    {
        $latestData=DataBanksIntradayRepository::getLatestTradeDataAll();

        $metaKey=array("market_lot","face_value");
        $fundamentaInfo=FundamentalRepository::getFundamentalDataAll($metaKey);

        $instrumentList=InstrumentRepository::getInstrumentsScripOnly();
        $sectorList=SectorListRepository::getSectorList();

        $maingrid=array();
        foreach($latestData as $arr)
        {
            $temp=array();
            $instrument_id=$arr->instrument_id;
            $quote_bases=explode('-',$arr->quote_bases);
            $category=$quote_bases[0];

            $sector_list_id=$instrumentList->where('id',$instrument_id)->first()->sector_list_id;
            $temp['id']=$arr->instrument_id;
            $temp['code']=$instrumentList->where('id',$instrument_id)->first()->instrument_code;
            $temp['sector']=$sectorList->where('id',$sector_list_id)->first()->name;
            
            $temp['category']=$category;
            $temp['market_lot']=1;
            $temp['face_value']=10;
            $temp['nav']=0;
            $temp['lastprice']=$arr->close_price;
            $temp['open']=$arr->open_price;
            $temp['high']=$arr->high_price;
            $temp['low']=$arr->low_price;
            $temp['volume']=$arr->total_volume;
            $temp['value']=$arr->total_value;
            $temp['trade']=$arr->total_trades;
            $temp['ycp']=$arr->yday_close_price;
            $temp['pchange']=$arr->price_change_per;
            $temp['change']=$arr->price_change;
            $temp['pe']=0;
            $temp['eps']=0;
            $maingrid[]=$temp;
        }


        $jsonArr=array();
        $firstgrid=array();
        $secondgrid=array();
        $thirdgrid=array();

        $jsonArr['maingrid'] = $maingrid;
        $jsonArr['firstgrid'] = $firstgrid;
        $jsonArr['secondgrid'] = $secondgrid;
        $jsonArr['thirdgrid'] = $thirdgrid;

        $jsonresult = json_encode($jsonArr,JSON_NUMERIC_CHECK);

        return  $jsonresult;
    }
    public function price_matrix_data()
    {

        $from_date=date("Y-m-d", strtotime("-3 month"));
        $to_date=date("Y-m-d");
        $instrumentList=InstrumentRepository::getInstrumentsScripOnly();
        $sectorList=SectorListRepository::getSectorList();

        $eodData=DataBankEodRepository::getPriceChangeHistory($from_date,$to_date,array(1,2,3,7,15,21,30),array(),array('close','high'));

        $returnData=array();
        foreach($eodData as $instrument_id=>$data)
        {
            $instrumentInfo=$instrumentList->where('id',$instrument_id)->first();
            if(count($instrumentInfo))
            {
                $sector_list_id=$instrumentInfo->sector_list_id;
            }
            else
            {
                // we dont want index data those are exist in $eodData
               continue;
            }

            $sector_name=$sectorList->where('id',$sector_list_id)->first()->name;
            $temp=array();
            $temp['code']=$data[1]['code'];
            $temp['lastprice']=$data[1]['close'];
            $temp['sector']=$sector_name;
            $temp['oneDay']=$data[1]['price_change_per'];
            $temp['twoDay']=$data[2]['price_change_per'];
            $temp['threeDay']=$data[3]['price_change_per'];
            $temp['oneWeek']=$data[7]['price_change_per'];
            $temp['twoWeek']=$data[15]['price_change_per'];
            $temp['threeWeek']=$data[21]['price_change_per'];
            $temp['oneMonth']=$data[30]['price_change_per'];

            $returnData[]=$temp;
        }

        return json_encode($returnData,JSON_NUMERIC_CHECK);

    }


}
