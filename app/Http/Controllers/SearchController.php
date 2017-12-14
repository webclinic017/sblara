<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;
use App\News;
use App\NewspaperNews;
use App\Instrument;

class SearchController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
    }

    function testSearch(Request $request) {
        
        $result = [];
        if($request->has('keyword')){
            
            $result = new News();
            
           if($request->instrument_id){
               
            $result = $result->where('instrument_id',$request->instrument_id);
            
           }
           if($request->keyword)
           {
               
            $result = $result->where('details','like', '%'.$request->keyword.'%');
           }
           if($request->from_date)
           {
              $result = $result->where('post_date', '>=', $request->from_date);
           }
           
           if($request->to_date)
           {
              $result = $result->where('post_date', '<=', $request->to_date.' 23:59:59');
           }
                    
             $result = $result->get();
        }
        $instrument = Instrument:: all();
        $request->flash();
        return view('test.ak',['instrument' => $instrument, 'result' => $result]);
    
    }

}
