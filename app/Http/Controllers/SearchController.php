<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    function search(Request $request) {
        $search = $request->search;
        $intradays = \App\Repositories\DataBanksIntradayRepository::getLatestTradeDataAll();
        foreach ($intradays as $day) {
            dd($day);
        }
        $searchItems = [];
        $searchItems[] = view('search_item')->render();
        $searchItems[] = view('search_item')->render();
        $searchItems[] = view('search_item')->render();
        $searchItems[] = view('search_item')->render();
        $searchItems[] = view('search_item')->render();
        $searchItems[] = view('search_item')->render();
        $data = [
            'count' => 10,
            'data' => $searchItems,
        ];
        return response()->json($data);
    }

}
