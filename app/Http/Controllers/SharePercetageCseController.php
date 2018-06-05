<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SharePercetageCseController extends Controller
{
    public function index()
    {
    	 	// 18 director
    	 	// 21 foreign
    	 	// 19 govt
    	 	// 20 institute
    	 	// 22 public
    	 	$fundamentals = \App\Fundamental::whereIn("meta_id", [18, 21, 19, 20, 22])->where('is_latest', 1)->orderBy('meta_date', 'desc')->get();
    	 	$date = \Carbon\Carbon::parse(\DB::select("select max(created_at) as `date` from cse_share_percentage")[0]->date)->format('Y-m-d');

    	 	$sql = "select * from cse_share_percentage left join instruments on instruments.id = instrument_id where created_at like '$date%' and sponsor is not NULL";
    	 	$cse = collect(\DB::select($sql))->keyBy('instrument_id');

    	 	$data = [];
    	 	foreach ($fundamentals as $fundamental) {
    	 		$data[$fundamental->instrument_id][$fundamental->meta_id] = $fundamental->meta_value;
    	 		$data[$fundamental->instrument_id]['meta_date'] = $fundamental->meta_date;
    	 	}
    	 	$fundamentals = $data;

    	// $instruments = \DB::select($sql);
    	return view('share-percentage-cse')->with(compact(['instruments', 'cse', 'fundamentals']));
    }

    public function scrape()
    {
    	$d = date('Y-m-d');
    	$ids = collect(\DB::select('select instrument_id from cse_share_percentage where created_at like "'.$d.'%"'))->pluck('instrument_id');
    	$instruments =\App\Instrument::whereNotIn('id', $ids)->orderBy('instrument_code', 'asc')->whereNotIn('sector_list_id', [5, 23, 22])->where('active', '=', '1')->take(5)->get();

    	$rows = [];
    	foreach ($instruments as  $instrument) {
			    	$page = file_get_contents("http://www.cse.com.bd/companyDetails.php?scriptCode=".base64_encode($instrument->instrument_code));
			    	$dom = new \DOMDocument();
			    	@$dom->loadHTML($page);
			    	$xpath = new \DOMXpath($dom);

			    	$data = $xpath->query("/html/body/div/div/div[5]/div/div[2]/table/tr[3]/td/table/tr[3]/td/table/tr[2]/td/table/tr[4]/td/table/tr/td[1]/table");
			    	$date = $xpath->query("/html/body/div/div/div[5]/div/div[2]/table/tr[3]/td/table/tr[3]/td/table/tr[2]/td/table/tr[5]/td[2]")->item(0)->nodeValue;
			    	try {
			    	$date = \Carbon\Carbon::parse("last day of ".$date)->format('Y-m-d');
			    		
			    	} catch (\Exception $e) {
			    		$date = null;
			    	}
			    	
			    	foreach ($data->item(0)->getElementsByTagName('tr') as $key => $value) {
			    		
			    		if($key == 0 ){
			    			continue;
			    		}
			    		foreach ($value->getElementsByTagName('td') as $k => $v) {
			    			if($k == 0){
			    				@$row['sponsor'] = $v->childNodes->item(0)->data;
			    			}else if($k == 1){
			    				@$row['government'] = $v->childNodes->item(0)->data;
			    			}else if($k == 2){
			    				@$row['institute'] = $v->childNodes->item(0)->data;
			    			}else if($k == 3){
			    				@$row['foreign'] = $v->childNodes->item(0)->data;
			    			}else if($k == 4){
			    				@$row['public'] = $v->childNodes->item(0)->data;
			    			}
			    		}

			    	}
			    	$row['meta_date'] = $date;
			    	$row['instrument_id'] = $instrument->id;
			    	$row['created_at'] = \Carbon\Carbon::now();
			    	$rows[] = $row; 
			    	// /html/body/div/div/div[5]/div/div[2]/table/tbody/tr[3]/td/table/tbody/tr[3]/td/table/tbody/tr[2]/td/table/tbody/tr[4]/td/table/tbody/tr/td[1]/table
    	}
    	\DB::table('cse_share_percentage')->insert($rows);
    	if(count($instruments) < 1){
    		$html = "All Done!";
    	}else{
    		$html = "Please wait! Don't close the browser. <script> location.reload(); </script>";
    	}
    	return  $html;
    }

    public function update(Request $request)
    {

    	$metas = $request->except(['_token', 'instrument_id', 'meta_date']);
    	$instrument_id = $request->instrument_id;
    	$meta_date = $request->meta_date;
    	foreach ($metas as $meta_id => $meta_value) {
    	$row = null;
    		$row = \App\Fundamental::where('instrument_id', $instrument_id)->where('meta_id', $meta_id)->where('meta_date', $meta_date)->first();
    		if($row == null){
    			\App\Fundamental::where('instrument_id', $instrument_id)->where('meta_id', $meta_id)->where('is_latest', 1)->update(['is_latest'=> 0]);
    			$row = new \App\Fundamental();
    			$row->is_latest = 1;
    			$row->meta_id = $meta_id;
    			$row->instrument_id = $instrument_id;
    			// dump('insert');
    		}
    		$row->meta_value = $meta_value;
    		$row->meta_date = $meta_date;
    		// dd($row);
    		$row->save();
    		// dd($row->id);

    	}
    	return redirect()->back()->with(['success' => 'Data succesfully updated']);
    }
}
