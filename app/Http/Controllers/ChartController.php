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
    	$instrumentInfo = \App\Instrument::first();
        return view("ta_chart/panel")->with('instrumentInfo', $instrumentInfo);
    }
}
