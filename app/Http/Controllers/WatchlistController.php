<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watchlist;

class WatchlistController extends Controller
{
	public function create(Request $request)
	{
		$list = new Watchlist;
		$list->name = $request->name;
		$list->user_id = $request->user()->id;
		$list->save();
		return $list;
	}

	public function addItem($id)
	{
		$item = new \App\WatchlistItem;
		$item->watchlist_id = $id;
		$item->instrument_id = request()->instrument_id;
		$item->save();
	}
	public function remove()
	{
		if(Watchlist::find(request()->id)->user_id != request()->user()->id ){
			return "d";
		}
		\App\WatchlistItem::where('instrument_id', request()->instrument_id)->where('watchlist_id', request()->id)->delete();
		return "dd";
	}

	public function rename()
	{
		if(Watchlist::find(request()->id)->user_id != request()->user()->id ){
			return "d";
		}
		Watchlist::where('id', request()->id)->update(['name' => request()->name]);
	}
	public function delete()
	{
		if(Watchlist::find(request()->id)->user_id != request()->user()->id ){
			return "d";
		}
		Watchlist::where('id', (int) request()->id)->delete();
		dd(Watchlist::find(request()->id));
		\App\WatchlistItem::where('watchlist_id', (int) request()->id)->delete();
	}
}
