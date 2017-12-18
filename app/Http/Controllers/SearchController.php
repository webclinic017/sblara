<?php
namespace App\Http\Controllers;
use App\Instrument;
use App\Portfolio;
use Illuminate\Http\Request;
use App\News;
use App\NewspaperNews;

class SearchController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
    }


    function search(Request $request, $type, $search) {
         return $this->{$request->type}($search); 
    }

    public function company($search)
    {   
        $data = Instrument::where('instrument_code', 'like', ''.$search.'%')->with('data_banks_intraday')->get();
        return response()->json($data);
    }

    public function news($search)
    {   
        $data = News::where('instrument_code', 'like', ''.$search.'%')->with('data_banks_intraday')->paginate(10);
        return response()->json($data);
    }

}
