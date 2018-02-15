<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
    	if(request()->has('TickerSymbol'))
    	{
    	 	new \App\Classes\Chart();		
    	 	return '';
    	}
        $id = request()->instrumentCode?:1;
    	$instrumentInfo = \App\Instrument::where('instrument_code', $id)->first();
        return view("ta_chart/panel")->with('instrumentInfo', $instrumentInfo);
    }
}
