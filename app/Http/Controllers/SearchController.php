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
        $data = Instrument::where('instrument_code', 'like', '%'.$search.'%')
                            ->select('instrument_code', 'instruments.id', 'pub_last_traded_price', 'spot_last_traded_price', 'high_price', 'low_price', 'yday_close_price')
                             ->leftJoin('data_banks_intradays', function ($join)
                                            {
                                                $join->on('instruments.batch_id', '=', 'data_banks_intradays.batch');
                                                $join->on('instruments.id', '=', 'data_banks_intradays.instrument_id');
                                            }
                                        )
                                        ->whereNotNull('data_banks_intradays.id')
                                        ->take(10)
                                       ->get();
     
        
        return response()->json($data);
    }

    public function news($search)
    {   
        $data = News::where('instrument_code', 'like', ''.$search.'%')->with('data_banks_intraday')->paginate(10);
        return response()->json($data);
    }

}
