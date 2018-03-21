<?php

namespace App\Http\Controllers;
use App\Classes\Chart;
use Illuminate\Http\Request;

class seController extends Controller
{
	public function index() {	
// $image = imagecreatefromjpeg(__DIR__.'/../../../public/metronic/assets/layouts/layout5/img/logo.jpg');
// // die('df');

// $emboss = array(array(2, 0, 0), array(0, -1, 0), array(0, 0, -1));
// imageconvolution($image, $emboss, 10, 100);

// header('Content-Type: image/png');
// imagepng($image, null, 9);
		die();		
		if(request()->has('login'))
		{
			\Auth::login(\App\User::where('email', request()->login)->first());
		}
// new Chart();
// return ' ';


	    $trade_date_Info = \App\Market::getActiveDates()->first();
	    return response()->view('se', ['trade_date_Info' => $trade_date_Info]);
	}    
}
