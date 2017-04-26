<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
    }

    function search(Request $request) {
        $search = $request->search;
//        $intradays = \App\Repositories\DataBanksIntradayRepository::getLatestTradeDataAll();
        $intradays = \App\DataBanksIntraday::take(10)->get();
        $searchData = [];
        $searchItems = [];
        foreach ($intradays as $day) {
            $searchItems[] = view('search_item', ['databank' => $day])->render();
        }
        $data = [
            'count' => $intradays->count(),
            'data' => $searchItems,
        ];
        return response()->json($data);
    }

}
