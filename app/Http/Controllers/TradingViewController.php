<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DataBankEodRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\ExchangeRepository;
use App\Repositories\InstrumentRepository;


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
        //$returnData['session']='24x7';
        $returnData['session']='1030-1430';
        $returnData['has_daily']=true;
        $returnData['has_intraday']=true;
        $returnData['has_no_volume']=false;
        $returnData['ticker']="$instrumentCode";
        $returnData['description']="$instrumentCode-SB";
        $returnData['sector']='sector';
        $returnData['type']='stock';
        $returnData['supported_resolutions']=array("5","15","30","60","D","2D","3D","W","2W","M");

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
            $data = DataBankEodRepository::getDataForTradingView($instrumentInfo->id, $from, $to, $resolution);
        }else
        {
            $data = DataBanksIntradayRepository::getDataForTradingView($instrumentInfo->id, $from, $to, $resolution);
        }

        return $data;

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
