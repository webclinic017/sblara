<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceBoardController extends Controller
{
    public function data()
    {
			//gain round(((d.close_price - d.yday_close_price)/d.close_price)*100, 2)
    		$raw = 'instruments.instrument_code, instruments.id as instrument_id, d.close_price, d.total_trades, d.total_value, d.total_volume,

    		 sector_lists.name as sector_name, LEFT(d.quote_bases , 1) as category';

                         $endDate = date('Y-m-d');
            if(request()->has('range')){
                $startDate = request()->startDate;
                $endDate = request()->endDate;
            }else{
                $endDate = request()->startDate;
                $startDate = \Carbon\Carbon::parse( request()->startDate)->subDay()->format('Y-m-d');
            }

            if($endDate == $startDate){
                $startDate = \Carbon\Carbon::parse( request()->startDate)->subDay()->format('Y-m-d');
            }
            $prevBatch = lastBatchByDate($startDate);
            $batch = false;
            if($endDate != date('Y-m-d')){
               $batch = lastBatchByDate($endDate);
            }

        	$data = \App\Instrument::where('batch_id', '!=', null)->join('data_banks_intradays as d', function ($join) use ($batch)
        {
            if($batch != false){
                $join->on('d.batch', '=', \DB::raw($batch));
            }else{
                $join->on('d.batch', '=', 'instruments.batch_id');
            }
            $join->on('d.instrument_id', '=', 'instruments.id');
        });
            // dd($prevBatch);

         
                $data->leftJoin('data_banks_intradays as prev', function ($join) use ($prevBatch)
                {

                    $join->on('prev.instrument_id', 'instruments.id');
                    $join->on('prev.batch', \DB::raw($prevBatch));
                });

                $raw .= ", prev.close_price as prev_close_price, prev.total_value as prev_total_value, prev.total_trades as prev_total_trades, prev.total_volume as prev_total_volume";
       

        	$data = $data->select(\DB::raw($raw));
        	$data = $data->orderBy('instrument_code', 'asc');
        if(request()->has('category') && request()->category != 'All'){
            $data->where('quote_bases', 'like', request()->category."%");
        
}        if(request()->has('sector') && request()->sector != 'All'){
            $data->where('sector_list_id', request()->sector);
        }
        $data->leftJoin('sector_lists', 'sector_lists.id', 'instruments.sector_list_id');
        $data->whereNotIn('sector_list_id', [22, 23, 24]);
        $data = $data->get();
        return $data;     
    	
    }

    public function index()
    {
        if(request()->has('startDate')){
            return $this->data();
        }
        return view('price-board');
    }
}
