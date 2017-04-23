<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DataBankEodRepository;
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
        return $instrumentList;
    }

// {"name":"AAPL","exchange-traded":"NasdaqNM","exchange-listed":"NasdaqNM","timezone":"America/New_York","minmov":1,"minmov2":0,
//"pricescale":10,"pointvalue":1,"session":"0930-1630","has_intraday":false,"has_no_volume":false,"ticker":"AAPL",
//"description":"Apple Inc.","type":"stock","supported_resolutions":["D","2D","3D","W","3W","M","6M"]}
    public function symbols(Request $request)
    {
        $instrumentCode = $request->input('symbol','DSEX:DSE');
        dd($instrumentCode);
        $explodeArr=explode(':',$instrumentCode);
        $exchangeName=$explodeArr[1];
        $instrumentCode=$explodeArr[0];
        $exchangeDetails=ExchangeRepository::getExchangeInfo($exchangeName);
        $instrumentList=InstrumentRepository::getInstrumentList($exchangeDetails->id);

        $instrumentInfo=$instrumentList->where('instrument_code',"$instrumentCode")->first();

        $returnData['name']="$instrumentCode";
        $returnData['exchange-traded']="$exchangeName";
        $returnData['exchange-listed']="$exchangeName";
        $returnData['timezone']='Asia/Dhaka';
        $returnData['minmov']=1;
        $returnData['minmov2']=0;
        $returnData['pricescale']=10;
        $returnData['pointvalue']=1;
        $returnData['session']='1030-1430';
        $returnData['has_intraday']=false;
        $returnData['ticker']="$instrumentCode";
        $returnData['description']="$instrumentCode";
        $returnData['type']='stock';
        $returnData['supported_resolutions']=Array("D","2D","3D","W","3W","M","6M");

        return collect($returnData)->toJson();

    }


    public function history(Request $request)
    {
        $instrumentCode = $request->input('symbol','DSEX:DSE');
        $explodeArr=explode(':',$instrumentCode);
        $exchangeName=$explodeArr[1];
        $instrumentCode=$explodeArr[0];
        $exchangeDetails=ExchangeRepository::getExchangeInfo($exchangeName);
        $instrumentList=InstrumentRepository::getInstrumentList($exchangeDetails->id);

        $instrumentInfo=$instrumentList->where('instrument_code',"$instrumentCode")->first();


        $form=(int) $request->input('from');
        $to=(int) $request->input('to',time());


        $data=DataBankEodRepository::getDataForTradingView($instrumentInfo->id,$form,$to);

        return $data;
    }
}
