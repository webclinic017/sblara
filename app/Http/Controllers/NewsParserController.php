<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsParserController extends Controller
{
	public function index()
	{
		$news = \App\News::orderBy('post_date', 'desc');
		if(request()->type != "*"){
			$type = request()->type;
			if($type == "Q1" || $type == "Q2" || $type == "Q3"){
				$type.= " Un-audited):";
			}else if($type == "DIVIDEND"){
				$type = "The Board of Directors has recommended";
			}
			$news->where("details", 'like', "%$type%");
			$news->where("details", 'not like', "%Repeat News%");

		}
			$start = request()->start?:date('Y-m-d');
			$end = request()->end?:date('Y-m-d');
			$news->where('post_date', '>=', $start);
			$news->where('post_date', '<=', $end." 23:59:59");

				if(request()->has('instrument') && request()->instrument != "*"){
					$news->where("prefix", '=', request()->instrument);
					}

		$news = $news->paginate(20);

		return view('news-parser')->with(compact('news'));
	}

	public function update(Request $request)
	{
		foreach ($request->all() as $key => $value) {
			if(! is_int($key)){
				continue;
			}
			$fundamental = \App\Fundamental::where('instrument_id', $request->instrument_id)->where('meta_id', $key)->where('is_latest', 1)->first();
			if(!$fundamental){
				\APP\Fundamental::insert(['instrument_id' => $request->instrument_id, 'meta_id' => $key, 'is_latest' => 1, 'meta_value' => $value, 'meta_date' => $request->meta_date]);
				continue;
			}
			if($request->meta_date == $fundamental->meta_date->format('Y-m-d')){
				$fundamental->meta_value = $value;
				$fundamental->save();
			}else{
				if($request->meta_date < $fundamental->meta_date){
					//old news
			    	$f = \App\Fundamental::where('instrument_id', $request->instrument_id)->where('meta_id', $key)->where('meta_date', $request->meta_date)->first();
			    	if(!$f){
			    		\APP\Fundamental::insert(['instrument_id' => $request->instrument_id, 'meta_id' => $key,  'meta_value' => $value, 'meta_date' => $request->meta_date]);
			    	}else{
			    		$f->meta_value = $value;
			    		$f->save();
			    	}
				}else{
					// new news
					$fundamental->is_latest = 0;
					$fundamental->save();
			    	\APP\Fundamental::insert(['instrument_id' => $request->instrument_id, 'meta_id' => $key, 'is_latest' => 1, 'meta_value' => $value, 'meta_date' => $request->meta_date]);
				}
			}
			\App\News::where('id', request()->news_id)->update(['isUpdated' => 1]);
		}
		return redirect()->back()->with(['success' => 'Data successfully updated']);
	}
}
