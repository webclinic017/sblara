<?php
namespace App\Http\Controllers;
use App\Instrument;
use App\Portfolio;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
    }

    function search(Request $request, $type, $search) {
        return $search;
         return $this->{$request->search}(); 
    }

    public function company()
    {   
        $data = Instrument::where('instrument_code', 'like', '%'.request()->q.'%')->paginate(10);
        return response()->json($data);
    }

}
