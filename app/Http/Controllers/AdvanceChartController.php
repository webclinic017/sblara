<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvanceChartController extends Controller
{
    public function index($instrument = "DSEX", $name = '')
    {
        $id = $instrument;
    	$instrumentInfo = \App\Instrument::where('instrument_code', $id)->first();
        return view('ta_chart.advance_ta_chart')->with(compact(['instrumentInfo']));
    }

    public function redirect()
    {
        if(request()->has('instrumentCode'))
        {
            $instrument = \App\Instrument::where('instrument_code', request()->instrumentCode)->first();
            return redirect("/dse/stock/".strtolower($instrument->instrument_code)."/".str_slug($instrument->name)."/chart/advance-technical-analysis", 301);
            
        }
        return redirect("/dse/stock/dsex/dse-broad-index/chart/advance-technical-analysis", 301);
    }
}
