<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsParserController extends Controller
{
	public function index()
	{
		if(request()->has('meta_key')){
			return $this->history();
		}
		$news = \App\News::orderBy('post_date', 'desc');
		if(request()->type != "*"){
			$type = request()->type;
			if($type == "Q1" || $type == "Q2" || $type == "Q3"){
				$type.= " Un-audited):";
			}else if($type == "DIVIDEND"){
				$type = "The Board of Directors has recommended";
			}else if ($type == 'mf'){
				$type = "the Fund has reported Net Asset";
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
		// dd($news->pluck('instru
		// ment_id'));
		$fundamentals = \App\Fundamental::whereIn('instrument_id', $news->pluck('instrument_id'))->where('is_latest', 1)->whereIn('meta_id', [211, 245, 227, 308, 319, 314, 226, 434, 320, 313, 225, 315, 310, 201, 205, 318, 1486, 1487])->get();
		$fdata = [];
		foreach ($fundamentals as  $fundamental) {
			$fdata[$fundamental->instrument_id][$fundamental->meta_id] = ['meta_value' => $fundamental->meta_value, 'meta_date' => $fundamental->meta_date];
		}
		// dd($fdata);
		return view('news-parser')->with(compact('news', 'fdata'));
	}

	public function update(Request $request)
	{
		  // 211 => "0" stock
  			// 245 => "30" cash
		if($request->has('record_date') && $request->record_date != ""){
			$stock = $request->{"211"};
			$cash = $request->{"245"};
//  no dividend
			if($stock == '0' && $cash == 0){
			$action = \App\CorporateAction::where('record_date', $request->record_date)->where('instrument_id', $request->instrument_id)->where('action', '')->where('value', $stock)->first();
						if(!$action){
				$action = new \App\CorporateAction();
				$action->instrument_id = $request->instrument_id;
				$action->record_date = $request->record_date;
				$action->action = 'nodiv';
				$action->active = 1;
			}
			$action->value = $stock;
			$action->save();
			// dump($action);
			// 	dump("stock");
			}
// no dividend
			if($stock != '0'){
			$action = \App\CorporateAction::where('record_date', $request->record_date)->where('instrument_id', $request->instrument_id)->where('action', 'stockdiv')->where('value', $stock)->first();
						if(!$action){
				$action = new \App\CorporateAction();
				$action->instrument_id = $request->instrument_id;
				$action->record_date = $request->record_date;
				$action->action = 'stockdiv';
				$action->active = 1;
			}
			$action->value = $stock;
			$action->save();
			// dump($action);
			// 	dump("stock");
			}
			if($cash != "0"){
			$action = \App\CorporateAction::where('record_date', $request->record_date)->where('instrument_id', $request->instrument_id)->where('action', 'cashdiv')->where('value', $cash)->first();
			if(!$action){
				$action = new \App\CorporateAction();
				$action->instrument_id = $request->instrument_id;
				$action->record_date = $request->record_date;
				$action->action = 'cashdiv';
				if($action->record_date <= date('Y-m-d')){
				$action->active = 1;
				}else{
				$action->active = 1;
				}
			}
			$action->value = $cash;
			$action->save();
			// dump($action);
			// 	dump("cash");
			}
		}
		// dd($request->all());
		foreach ($request->all() as $key => $value) {
			if(! is_int($key)){
				continue;
			}
			if($value == ''){
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

	public function history()
	{
		$fundamentals = \App\Fundamental::where('instrument_id', request()->instrument_id);
		
		if(request()->meta_key != 'meta_date'){
			$fundamentals = $fundamentals->where('meta_key', request()->meta_key);
		}else{
			$fundamentals = $fundamentals->where('meta_date', request()->meta_date);
		}

		$fundamentals = $fundamentals->leftJoin('metas', 'metas.id', 'fundamentals.meta_id')
		->orderBy('meta_date', 'desc')
		->orderBy('is_latest', 'desc')
		->get();
		return view('fundamental-history')->with(compact('fundamentals'));
	}
}
