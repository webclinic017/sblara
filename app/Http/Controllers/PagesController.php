<?php

namespace App\Http\Controllers;
use View;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsChart($instrument_id=13)
    {
        return View::make("news_chart_page")->with('instrument_id',(int)$instrument_id);
    }

    public function minuteChart($instrument_id=13)
    {
        return response()->view('minute_chart_page', ['instrument_id' => (int)$instrument_id])->setTtl(60);
        //return View::make("minute_chart_page")->with('instrument_id',(int)$instrument_id);

    }



}
