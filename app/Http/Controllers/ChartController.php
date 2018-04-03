<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index($instrument = "DSEX", $name = '')
    {
        $id = $instrument;
    	$instrumentInfo = \App\Instrument::where('instrument_code', $id)->first();
        return view("ta_chart/panel")->with('instrumentInfo', $instrumentInfo);
    }

    public function taChartImg()
    {
        if(request()->has('TickerSymbol'))
        {
            $chart = new \App\Classes\Chart();
            return response()->make($chart->html())->setTtl(60);
        }

    }

    public function redirect()
    {
        if(request()->has('instrumentCode'))
        {
            $instrument = \App\Instrument::where('instrument_code', request()->instrumentCode)->first();
            return redirect("/dse/stock/".strtolower($instrument->instrument_code)."/".str_slug($instrument->name)."/chart/technical-analysis", 301);
            
        }
        return redirect("/dse/stock/dsex/dse-broad-index/chart/technical-analysis", 301);
    }
}
