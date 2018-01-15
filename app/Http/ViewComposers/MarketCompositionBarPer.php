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

class MarketCompositionBarPer
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
            $height=(int) $viewdata['height'];

        $instrumentListMain=InstrumentRepository::getInstrumentsScripOnly();
        $instrumentList=$instrumentListMain->groupBy('sector_list_id');

        $instrumentTradeData=DataBanksIntradayRepository::getLatestTradeDataAll();
        $instrumentTradeData=$instrumentTradeData->keyBy('instrument_id');

        $instrumentTradeDataPrev=DataBanksIntradayRepository::getPreviousDayData();
        $instrumentTradeDataPrev=$instrumentTradeDataPrev->keyBy('instrument_id');


        $today=array();
        $prevDay=array();
        $category=array();

        $marketTotalToday=$instrumentTradeData->sum($base);
        $marketTotalPrev=$instrumentTradeDataPrev->sum($base);
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
            $todayTemp['color']='#1BA39C';
            $todayTemp['y']=($sector_area_total/$marketTotalToday)*100;
            $todayTemp['y']=number_format($todayTemp['y'], 2, '.', '');

            $prevTemp['name']=$sector_name;
            $prevTemp['color']='#EF4836';
            $prevTemp['y']=($sector_area_total_prev/$marketTotalPrev)*100;
            $prevTemp['y']=number_format($prevTemp['y'], 2, '.', '');



            $today[]=$todayTemp;
            $prevDay[]=$prevTemp;
            $category[]=$sector_name;


        }

        sbdump($today, 'afmsohail@gmail.com');
        sbdd($prevDay, 'afmsohail@gmail.com');


        $today=collect($today)->sortByDesc('y')->toArray();
        $today=array_values($today);
        $prevDay=collect($prevDay);

        $prevDaySorted=array();
        foreach($today as $row)
        {
            $prevDaySorted[]=$prevDay->where('name',$row['name'])->first();
        }


        $todayDate=$instrumentTradeData->first()->lm_date_time;
        $prevDate=$instrumentTradeDataPrev->first()->lm_date_time;

        $view->with('today', collect($today)->toJson(JSON_NUMERIC_CHECK))
            ->with('prevDay', collect($prevDaySorted)->toJson(JSON_NUMERIC_CHECK))
            ->with('category', collect($category)->toJson())
            ->with('todayDate', $todayDate)
            ->with('prevDate', $prevDate)
            ->with('renderTo', "market_composition_per_$base")
            ->with('height',$height)
            ->with('ylabel',$base);

    }
}