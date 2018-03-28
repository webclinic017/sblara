<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DataBankEodRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\ExchangeRepository;
use App\Repositories\InstrumentRepository;
use Carbon\Carbon;

class TradingViewController extends Controller
{

//[{"symbol":"APC","full_name":"APC","description":"Anadarko Petroleum Corporation","exchange":"NYSE","type":"stock"},{"symbol":"AA","full_name":"AA","description":"Alcoa Inc.","exchange":"NYSE","type":"stock"},{"symbol":"AAPL","full_name":"AAPL","description":"Apple Inc.","exchange":"NasdaqNM","type":"stock"},{"symbol":"ABB","full_name":"ABB","description":"ABB Ltd.","exchange":"NYSE","type":"stock"},{"symbol":"ABBV","full_name":"ABBV","description":"AbbVie Inc.","exchange":"NYSE","type":"stock"},{"symbol":"ABT","full_name":"ABT","description":"Abbott Laboratories","exchange":"NYSE","type":"stock"},{"symbol":"ABX","full_name":"ABX","description":"Barrick Gold Corporation","exchange":"NYSE","type":"stock"},{"symbol":"ACHN","full_name":"ACHN","description":"Achillion Pharmaceuticals, Inc.","exchange":"NasdaqNM","type":"stock"},{"symbol":"ACI","full_name":"ACI","description":"Arch Coal Inc.","exchange":"NYSE","type":"stock"},{"symbol":"ACN","full_name":"ACN","description":"Accenture plc","exchange":"NYSE","type":"stock"},{"symbol":"ACT","full_name":"ACT","description":"Actavis plc","exchange":"NYSE","type":"stock"},{"symbol":"ADBE","full_name":"ADBE","description":"Adobe Systems Inc.","exchange":"NasdaqNM","type":"stock"},{"symbol":"ADSK","full_name":"ADSK","description":"Autodesk, Inc.","exchange":"NasdaqNM","type":"stock"},{"symbol":"AEO","full_name":"AEO","description":"American Eagle Outfitters, Inc.","exchange":"NYSE","type":"stock"},{"symbol":"AGNC","full_name":"AGNC","description":"American Capital Agency Corp.","exchange":"NasdaqNM","type":"stock"},{"symbol":"AIG","full_name":"AIG","description":"American International Group, Inc.","exchange":"NYSE","type":"stock"},{"symbol":"AKAM","full_name":"AKAM","description":"Akamai Technologies, Inc.","exchange":"NasdaqNM","type":"stock"},{"symbol":"ALU","full_name":"ALU","description":"Alcatel-Lucent","exchange":"NYSE","type":"stock"},{"symbol":"ALXN","full_name":"ALXN","description":"Alexion Pharmaceuticals, Inc.","exchange":"NasdaqNM","type":"stock"},{"symbol":"AMAT","full_name":"AMAT","description":"Applied Materials, Inc.","exchange":"NasdaqNM","type":"stock"},{"symbol":"AMD","full_name":"AMD","description":"Advanced Micro Devices, Inc.","exchange":"NYSE","type":"stock"},{"symbol":"AMGN","full_name":"AMGN","description":"Amgen Inc.","exchange":"NasdaqNM","type":"stock"},{"symbol":"AMZN","full_name":"AMZN","description":"Amazon.com Inc.","exchange":"NasdaqNM","type":"stock"},{"symbol":"ANF","full_name":"ANF","description":"Abercrombie & Fitch Co.","exchange":"NYSE","type":"stock"},{"symbol":"ANR","full_name":"ANR","description":"Alpha Natural Resources, Inc.","exchange":"NYSE","type":"stock"},{"symbol":"APA","full_name":"APA","description":"Apache Corp.","exchange":"NYSE","type":"stock"},{"symbol":"AAL","full_name":"AAL","description":"American Airlines Group Inc.","exchange":"NasdaqNM","type":"stock"},{"symbol":"ARC","full_name":"ARC","description":"ARC Document Solutions, Inc.","exchange":"NYSE","type":"stock"},{"symbol":"ARIA","full_name":"ARIA","description":"Ariad Pharmaceuticals Inc.","exchange":"NasdaqNM","type":"stock"},{"symbol":"ARNA","full_name":"ARNA","description":"Arena Pharmaceuticals, Inc.","exchange":"NasdaqNM","type":"stock"}]

    public function search(Request $request)
    {
        $limit = (int) $request->input('limit', 30);
        $query = $request->input('query',null);
        $type='stock';
        $exchangeName = $request->input('exchange', 'DSE');
        if(is_null($exchangeName))
            $exchangeName='DSE';
        $exchangeDetails=ExchangeRepository::getExchangeInfo($exchangeName);
        $instrumentList=InstrumentRepository::getTradingViewInstrumentList($limit,$query,$type,$exchangeDetails);
        return $instrumentList->toJson();
    }


    public function symbols(Request $request)
    {
        $instrumentCode = $request->input('symbol','DSEX');
        $exchangeName="DSE";
        $exchangeDetails=ExchangeRepository::getExchangeInfo($exchangeName);
        $instrumentList=InstrumentRepository::getInstrumentsScripWithIndex($exchangeDetails->id);

        $instrumentInfo=$instrumentList->where('instrument_code',"$instrumentCode")->first();

        $returnData['name']="$instrumentCode";
        $returnData['exchange-traded']="$exchangeName";
        $returnData['exchange-listed']="$exchangeName";
        //$returnData['timezone']='UTC';
        $returnData['timezone']='Asia/Almaty';
        $returnData['minmov']=1;
        $returnData['minmov2']=2;
        $returnData['pricescale']=10;
        $returnData['pointvalue']=1;
        $returnData['session']='24x7';  //24x 7 should be given otherwise it will remove sunday treating it weekend
        //$returnData['session']='1030-1430;1'; //https://github.com/tradingview/charting_library/wiki/Trading-Sessions   github user: afmsohail@gmail.com
        $returnData['session'] = '1;1000-1600:12345';
        $returnData['has_daily']=true;
        $returnData['has_weekly_and_monthly'] = false;
        $returnData['has_intraday']=true;
        $returnData['has_no_volume']=false;
        $returnData['ticker']="$instrumentCode";
        $returnData['description']="$instrumentCode-SB";
        $returnData['sector']='sector';
        $returnData['type']='stock';
        $returnData['supported_resolutions']=array("5","15","30","60","D","2D","3D","W","2W","M");

        return collect($returnData)->toJson();


    }

    public function intraData($instrument_id, $from, $to, $resolution)
    {
        $candle_time=$resolution*60;

        $from=Carbon::createFromTimestamp($from);
        $from_date=$from->format('Y-m-d H:i:s');

        $to=Carbon::createFromTimestamp($to);
        $to_date=  $to->format('Y-m-d H:i:s');


        $sql = "select DISTINCT(total_volume),instrument_id,markets.market_closed,open_price,close_price,pub_last_traded_price,spot_last_traded_price,UNIX_TIMESTAMP(lm_date_time) as date_timestamp
from data_banks_intradays,markets
where lm_date_time >= '$from_date' and lm_date_time < '$to_date' and instrument_id=$instrument_id and markets.id = data_banks_intradays.market_id
ORDER BY lm_date_time asc ,total_volume asc";

        $all_data = \DB::select($sql);

        $returnData=array();
        if (count($all_data)) {

            $grouped=array();
            foreach($all_data as $data)
            {
                $ltp=$data->spot_last_traded_price?$data->spot_last_traded_price:$data->pub_last_traded_price;
                $day_key=date('Y-m-d', $data->date_timestamp);

                // deducting 60 seconds so that 2.30 PM data includes in previous base_time_key (here 2.15 PM)
                $market_closed=strtotime("$day_key ".$data->market_closed);
                if($data->date_timestamp>=$market_closed)
                $data->date_timestamp= $data->date_timestamp-60;

                $q=$data->date_timestamp%$candle_time;
                //$base_time_key=date('Y-m-d H:i', $data->date_timestamp-$q);
                $base_time_key=$data->date_timestamp-$q;

                $time=date('H:i:s', $data->date_timestamp);
                $data->time=$time;
                $data->ltp=$ltp;
                $grouped[$day_key][$base_time_key][]= $data;
            }





            foreach($grouped as $trade_date=>$all_day_data)
            {
                $last_total_volume=0;
                $count=0;
                foreach($all_day_data as $base_time=>$grouped_by_time_frame_data)
                {
                    //if($count>5)  break;


                    $first_data= $grouped_by_time_frame_data[0];
                    $last_data= $grouped_by_time_frame_data[count($grouped_by_time_frame_data) - 1];


                    $date = $base_time;
                    if($count==0)
                    {
                        // its first data of the day. day open will be counted for very first data
                        $open= $first_data->open_price;

                    }else
                    {
                        $open= $first_data->ltp;
                    }

                    $close= $last_data->ltp;
                    $high=collect($grouped_by_time_frame_data)->max('ltp');
                    $low=collect($grouped_by_time_frame_data)->min('ltp');
                    // $volume = collect($grouped_by_time_frame_data)->sum('total_volume');

                    $volume=$last_data->total_volume-$last_total_volume;
                    if($volume<1)
                        continue;


                    //dump($grouped_by_time_frame_data);
                    // dump("o=$open h=$high l= $low c=$close v=$volume d=$date");
                    //    dump($last_data->total_volume."-".$last_total_volume."= $volume");

                    $last_total_volume=$last_data->total_volume;

                    $returnData['t'][] = $date;
                    $returnData['c'][] = $close;
                    $returnData['o'][] = $open;
                    $returnData['h'][] = $high;
                    $returnData['l'][] = $low;
                    $returnData['v'][] = $volume;


                    $count++;
                }



            }





        }

        if(count($returnData)) {
            $returnData['s'] = "ok";
        }else
        {
            // $returnData['s'] = "no_data";
            //  $returnData['nextTime'] = strtotime('1999-01-01');
        }

        return collect($returnData)->toJson();

    }


    public function weeklyData($instrument_id, $from, $to, $resolution)
    {

        $eodData = DataBankEodRepository::getEodDataAdjusted($instrument_id, $from, $to, 0);
        $eodData = $eodData->reverse();
        //$eodData = DataBankEodRepository::getAdjustedDataForTradingView($instrument_id, $from, $to, 0);

        $returnData = array();

        if (count($eodData)) {

            $weekly_grouped = array();
            foreach ($eodData as $data) {
                $key = date('W-y', $data['date_timestamp'] + 24 * 60 * 60);  // adding 1 day to start week from sunday. other wise it will start from monday
                $weekly_grouped[$key][] = $data;
            }


            //$weekly_grouped = array_reverse($weekly_grouped, true);


            foreach ($weekly_grouped as $week => $data) {
                $first_day_of_week = $data[0];
                $last_day_of_week = $data[count($data) - 1];


                //$date = date('Y-m-d', $first_day_of_week['date_timestamp']);
                $date = $first_day_of_week['date_timestamp'];
                $open = $first_day_of_week['open'];
                $close = $last_day_of_week['close'];
                $high = collect($data)->max('high');
                $low = collect($data)->min('low');
                $volume = collect($data)->sum('volume');

                $returnData['t'][] = $date;
                $returnData['c'][] = $close;
                $returnData['o'][] = $open;
                $returnData['h'][] = $high;
                $returnData['l'][] = $low;
                $returnData['v'][] = $volume;


            }


        }


        if (count($returnData)) {
            $returnData['s'] = "ok";
        } else {
            // $returnData['s'] = "no_data";
            //  $returnData['nextTime'] = strtotime('1999-01-01');
        }

        return collect($returnData)->toJson();

    }

    public function history(Request $request)
    {
        $instrumentCode = $request->input('symbol','DSEX');
        $resolution = $request->input('resolution');

        $exchangeName="DSE";
        $exchangeDetails=ExchangeRepository::getExchangeInfo($exchangeName);
        $instrumentList=InstrumentRepository::getInstrumentsScripWithIndex($exchangeDetails->id);

        $instrumentInfo=$instrumentList->where('instrument_code',"$instrumentCode")->first();


        $from=(int) $request->input('from');
        $to=(int) $request->input('to',time());

        if($resolution=='D') {
           $data = DataBankEodRepository::getAdjustedDataForTradingView($instrumentInfo->id, $from, $to, $resolution);
            //$data = DataBankEodRepository::getEodDataAdjusted($instrumentInfo->id, $from, $to);
        }
        elseif($resolution=='W') {
            // if  $returnData['has_weekly_and_monthly']=true at symbols() then enable following line
           // $data = self::weeklyData($instrumentInfo->id, $from, $to, $resolution);

        }else
        {
            //$data = DataBanksIntradayRepository::getDataForTradingView($instrumentInfo->id, $from, $to, $resolution);
            $data = self::intraData($instrumentInfo->id, $from, $to, $resolution);

        }
       // return response()->view('dashboard', ['trade_date_Info' => $trade_date_Info])->setTtl(1);
        return response()->json($data)->setTtl(60);
        //return $data;

    }

    public function config()
    {
        //https://github.com/tradingview/charting_library/wiki/Customization-Overview
        //old config:   {"supports_search":true,"supports_group_request":false,"supports_marks":true,"supports_timescale_marks":true,"supports_time":true,"exchanges":[{"value":"","name":"All Exchanges","desc":""},{"value":"XETRA","name":"XETRA","desc":"XETRA"},{"value":"NSE","name":"NSE","desc":"NSE"},{"value":"NasdaqNM","name":"NasdaqNM","desc":"NasdaqNM"},{"value":"NYSE","name":"NYSE","desc":"NYSE"},{"value":"CDNX","name":"CDNX","desc":"CDNX"},{"value":"Stuttgart","name":"Stuttgart","desc":"Stuttgart"}],"symbolsTypes":[{"name":"All types","value":""},{"name":"Stock","value":"stock"},{"name":"Index","value":"index"}],"supportedResolutions":["D","2D","3D","W","3W","M","6M"]}
        $config=array();
        $config['supports_search']=true;
        $config['supports_group_request']=false;
        $config['supported_resolutions']=array("5","15","30","60","D","2D","3D","W","2W","M");
        $config['supports_marks']=false;
        $config['supports_time']=true;

        $exchange_dse=array();
        $exchange_dse['value']="DSE";
        $exchange_dse['name']="DSE";
        $exchange_dse['desc']="Dhaka Stock Exchange";

        $exchange_cse=array();
        $exchange_cse['value']="CSE";
        $exchange_cse['name']="CSE";
        $exchange_cse['desc']="Chittagong Stock Exchange";

        $config['exchanges'][]=$exchange_dse;
        $config['exchanges'][]=$exchange_cse;

        $symbolType=array();
        $symbolType['name']="Stock";
        $symbolType['value']="Stock";

        $config['symbolsTypes'][]=$symbolType;

        return collect($config)->toJson();
    }
}
