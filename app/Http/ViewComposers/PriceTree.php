<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBanksIntradayRepository;

class PriceTree
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $viewdata= $view->getData();
        $base=$viewdata['base'];

        $instrumentListMain=InstrumentRepository::getInstrumentsScripOnly();
        $instrumentList=$instrumentListMain->groupBy('sector_list_id');

        $instrumentTradeData=DataBanksIntradayRepository::getLatestTradeDataAll();
        $instrumentTradeData=$instrumentTradeData->keyBy('instrument_id');

        $instrumentTradeDataPrev=DataBanksIntradayRepository::getPreviousDayData();
        $instrumentTradeDataPrev=$instrumentTradeDataPrev->keyBy('instrument_id');

//dd($instrumentTradeDataPrev->toArray());
        $market_turnover=0;
        $today=array();
        $prevDay=array();
        $category=array();
        foreach($instrumentList as $sector_id=>$instrument_arr)
        {
            $sector_node['children']=array();
            $sector_name=$instrument_arr->first()->sector_list->name;

            $sector_area_total=0;
            $sector_area_total_prev=0;

            foreach($instrument_arr as $instrument)
            {
                $instrument_id=$instrument->id;
              //  dump($instrumentTradeDataPrev[$instrument_id]->$base);
                if(isset($instrumentTradeData[$instrument_id]))
                    $sector_area_total+=$instrumentTradeData[$instrument_id]->$base;


                if(isset($instrumentTradeDataPrev[$instrument_id]))
                    $sector_area_total_prev+=$instrumentTradeDataPrev[$instrument_id]->$base;




            }

            $today[]=$sector_area_total;
            $prevDay[]=$sector_area_total;
            $category[]=$sector_name;


        }

      $view->with('today', collect($today)->toJson())
          ->with('prevDay', collect($prevDay)->toJson())
          ->with('category', collect($category)->toJson());

    }
}