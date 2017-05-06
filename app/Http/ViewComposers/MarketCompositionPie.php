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

class MarketCompositionPie
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

        $height=700;
        if(isset($viewdata['height']))
        $height=$viewdata['height'];

        $instrumentListMain=InstrumentRepository::getInstrumentsScripOnly();
        $instrumentList=$instrumentListMain->groupBy('sector_list_id');

        $instrumentTradeData=DataBanksIntradayRepository::getLatestTradeDataAll();
        $instrumentTradeData=$instrumentTradeData->keyBy('instrument_id');

        $instrumentTradeDataPrev=DataBanksIntradayRepository::getPreviousDayData();
        $instrumentTradeDataPrev=$instrumentTradeDataPrev->keyBy('instrument_id');


        $colorArr=array("#058DC7","#50B432","#ED561B","#DDDF00","#24CBE5","#64E572",
            "#FF9655","#FFF263","#6AF9C4","#058DC7","#50B432","#ED561B",
            "#DDDF00","#24CBE5","#64E572","#FF9655","#FFF263","#6AF9C4","#058DC7","#50B432");
        $today=array();
        $prevDay=array();
        $category=array();
        $color=0;
        $totalColor=count($colorArr);
        foreach($instrumentList as $sector_id=>$instrument_arr)
        {
            $todayTemp=array();
            $prevTemp=array();



            $sector_name=$instrument_arr->first()->sector_list->name;

            $sector_area_total=0;
            $sector_area_total_prev=0;

            foreach($instrument_arr as $instrument)
            {

                $instrument_id=$instrument->id;
                //dd($instrumentTradeDataPrev[$instrument_id]);
                if(isset($instrumentTradeData[$instrument_id]))
                    $sector_area_total+=$instrumentTradeData[$instrument_id]->$base;


                if(isset($instrumentTradeDataPrev[$instrument_id]))
                    $sector_area_total_prev+=$instrumentTradeDataPrev[$instrument_id]->$base;

            }

            $todayTemp['name']=$sector_name;
            $todayTemp['color']=$colorArr[$color%$totalColor];
            $todayTemp['y']=$sector_area_total;

            $prevTemp['name']=$sector_name;
            $prevTemp['color']=$colorArr[$color%$totalColor];
            $prevTemp['y']=$sector_area_total_prev;



            $today[]=$todayTemp;
            $prevDay[]=$prevTemp;
            $category[]=$sector_name;
            $color++;

        }

        $todayDate=$instrumentTradeData->first()->lm_date_time;
        $prevDate=$instrumentTradeDataPrev->first()->lm_date_time;

      $view->with('today', collect($today)->toJson())
          ->with('prevDay', collect($prevDay)->toJson())
          ->with('category', collect($category)->toJson())
          ->with('todayDate', $todayDate)
          ->with('prevDate', $prevDate)
          ->with('renderTo', "market_composition_pie_$base")
          ->with('height',$height);

    }
}