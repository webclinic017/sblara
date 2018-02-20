<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
    	if(request()->has('TickerSymbol'))
    	{
    	 	$chart = new \App\Classes\Chart();
    	 	return response()->make($chart->html())->setTtl(60);
    	}
        $id = request()->instrumentCode?:'DSEX';
    	$instrumentInfo = \App\Instrument::where('instrument_code', $id)->first();
        return view("ta_chart/panel")->with('instrumentInfo', $instrumentInfo);
    }
}
