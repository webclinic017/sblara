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
use App\Repositories\SectorListRepository;
use App\Repositories\DataBanksIntradayRepository;

class MarketCompositionTable
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
        $instrumentListMain->load('sector_list');
        $instrumentList=$instrumentListMain->groupBy('sector_list_id');

        $instrumentTradeData=DataBanksIntradayRepository::getLatestTradeDataAll();
        $instrumentTradeData=$instrumentTradeData->keyBy('instrument_id');

        $instrumentTradeDataPrev=DataBanksIntradayRepository::getPreviousDayData();
        $instrumentTradeDataPrev=$instrumentTradeDataPrev->keyBy('instrument_id');

        $sector_list = SectorListRepository::getSectorList();
        $sector_list = $sector_list->keyBy('id');
        $today=array();
        $prevDay=array();
        $category=array();

        $marketTotalToday=$instrumentTradeData->sum($base);
        $marketTotalPrev=$instrumentTradeDataPrev->sum($base);

        $raw_value_today=array();
        $raw_value_prev=array();
        foreach($instrumentList as $sector_id=>$instrument_arr)
        {
            $sector_name= $sector_list[$sector_id]->name;

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


            //$raw_value_today[$sector_name]= ($sector_area_total / $marketTotalToday) * 100;
            $raw_value_today[$sector_name]= $sector_area_total;

            $raw_value_prev[$sector_name]= $sector_area_total_prev;


        }

        arsort($raw_value_today);

        $return=array();
        foreach($raw_value_today as $sector_name=>$data)
        {
            $temp=array();


            $temp['sector']= $sector_name;
            $temp['today']= round($data, 2);
            $temp['prev_day']= round($raw_value_prev[$sector_name], 2);
            $temp['changes']= $temp['today']- $temp['prev_day'];
            $temp['changes_per']= $temp['prev_day']?($temp['changes']/$temp['prev_day'])*100:0;
            $temp['changes_per']=round($temp['changes_per'],2);
            $temp['contribution_today']= round(($temp['today']/ $marketTotalToday)*100,2);
            $temp['contribution_prev_day']= round(($temp['prev_day']/ $marketTotalPrev)*100,2);
            $temp['contribution_change']= $temp['contribution_today']- $temp['contribution_prev_day'];
            $return[]= $temp;
        }


        $todayDate=$instrumentTradeData->first()->lm_date_time;
        $prevDate=$instrumentTradeDataPrev->first()->lm_date_time;
        $marketTotalChange= $marketTotalToday- $marketTotalPrev;

        $view->with('return', $return)
            ->with('todayDate', $todayDate)
            ->with('prevDate', $prevDate)
            ->with('marketTotalChange', $marketTotalChange)
            ->with('marketTotalPrev', $marketTotalPrev)
            ->with('marketTotalToday', $marketTotalToday);

    }
}