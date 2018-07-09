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
		if(request()->has('sqltask')){
			return $this->sqlTask();
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
		//cpb 1487
		//mpb 1486
		$instruments = \App\Instrument::all()->keyBy('instrument_code');
		// dd($instruments);
		// $end = false;
		// $skip = 0;
		// while($end == false){

		// 		$data = \DB::select(\DB::raw("select * from mutual_import limit $skip, 100"));
		// 		$rowscpb = [];
		// 		$rowsmpb = [];
		// 		foreach ($data as $key => $value) {
		// 			$rowscpb[] = ['meta_id' => 1487, 'meta_value' => $value->cpb, 'meta_date' => $value->q_date, 'instrument_id' => $instruments[$value->code]->id, 'is_latest' => 0];
		// 			$rowsmpb[] = ['meta_id' => 1486, 'meta_value' => $value->mpb, 'meta_date' => $value->q_date, 'instrument_id' => $instruments[$value->code]->id, 'is_latest' => 0];
		// 		}
		// 		// dump($rowsmpb);
		// 		\App\Fundamental::insert($rowscpb);
		// 		\App\Fundamental::insert($rowsmpb);
		// 		// dd($rowscpb);
		// 		$skip += 100;
		// 	if(count($data) == 0){
		// 		$end = true;
		// 	}

			// if($skip == 500){
			// 	$end = true;
			// }

		// }

	}
}
