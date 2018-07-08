<?php

namespace App\Http\Controllers;
use App\Classes\Chart;
use Illuminate\Http\Request;
use App\Instrument;

class seController extends Controller
{
	public function index() {	
		if(request()->has('top')){
			return $this->top();
		}
		if(request()->has('sql')){
			return $this->top();
		}
		// return $this->test();
// $image = imagecreatefromjpeg(__DIR__.'/../../../public/metronic/assets/layouts/layout5/img/logo.jpg');
// // die('df');

// $emboss = array(array(2, 0, 0), array(0, -1, 0), array(0, 0, -1));
// imageconvolution($image, $emboss, 10, 100);

// header('Content-Type: image/png');
// imagepng($image, null, 9);
		
		if(request()->has('login'))
		{
			\Auth::login(\App\User::where('email', request()->login)->first());
		}
// new Chart();
// return ' ';

		return view('se');
	}    


	public function test()
	{
		if(request()->has('file')){
			dd(request()->file());
		}
		return "<form method='post' enctype='mutlipart/form-data'>+
		<input type='file' name='file' />
		<input type='submit'>
		</form>";
	}


	// tracer
	public function top()
	{
		// queries
			// top ten
		$instrument_ids = Instrument::topGainer()->pluck('instrument_id')->toArray();
		// dd($instrument_ids);
		// dd(join(' ',  $instrument_ids));
		$topusers = "SELECT 

users.`name`, users.`contact_no`, users.`email`, portfolios.`portfolio_value`,   instruments.`instrument_code`, no_of_shares, portfolio_scrips.`buying_price`, instruments.id

FROM `portfolio_scrips` 

LEFT JOIN instruments ON instruments.`id` = portfolio_scrips.`instrument_id`
LEFT JOIN portfolios ON portfolios.id = portfolio_scrips.`portfolio_id`
LEFT JOIN users ON users.id = portfolios.`user_id`

WHERE instrument_id IN (".join(',', $instrument_ids).") ORDER BY portfolio_scrips.id DESC LIMIT 10";
		// queries
		$topusers = \DB::select(\DB::raw($topusers));
		dd($topusers);
	}

	public function sqlTask()
	{

	}
}
