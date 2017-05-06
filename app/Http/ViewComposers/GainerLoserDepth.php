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

class GainerLoserDepth
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

        $height=500;
        if(isset($viewdata['height']))
            $height=$viewdata['height'];

        $instrumentListMain=InstrumentRepository::getInstrumentsScripOnly();
        $instrumentList=$instrumentListMain->groupBy('sector_list_id');

        $instrumentTradeData=DataBanksIntradayRepository::getLatestTradeDataAll();
        $instrumentTradeData=$instrumentTradeData->keyBy('instrument_id');

        $range_plus_2=array();
        $range_0_to_plus_2=array();
        $range_0_to_minus_2=array();
        $range_minus_2=array();


        $category=array();

        foreach($instrumentList as $sector_id=>$instrument_arr)
        {

            $sector_name=$instrument_arr->first()->sector_list->name;

            $sector_plus_2=0;
            $sector_0_to_plus_2=0;
            $sector_0_to_minus_2=0;
            $sector_minus_2=0;

            foreach($instrument_arr as $instrument)
            {

                $instrument_id=$instrument->id;
                if(isset($instrumentTradeData[$instrument_id])) {

                    if($instrumentTradeData[$instrument_id]->price_change_per>2)
                        $sector_plus_2++;

                    if($instrumentTradeData[$instrument_id]->price_change_per>=0 and $instrumentTradeData[$instrument_id]->price_change_per<2)
                        $sector_0_to_plus_2++;

                    if($instrumentTradeData[$instrument_id]->price_change_per>=-2 and $instrumentTradeData[$instrument_id]->price_change_per<0)
                        $sector_0_to_minus_2++;

                    if($instrumentTradeData[$instrument_id]->price_change_per<-2)
                        $sector_minus_2++;

                }




            }


            $range_plus_2[]=$sector_plus_2;
            $range_0_to_plus_2[]=$sector_0_to_plus_2;
            $range_0_to_minus_2[]=$sector_0_to_minus_2;
            $range_minus_2[]=$sector_minus_2;
            $category[]=$sector_name;


        }
        $todayDate=$instrumentTradeData->first()->lm_date_time;

        $view->with('range_plus_2', collect($range_plus_2)->toJson(JSON_NUMERIC_CHECK))
            ->with('range_0_to_plus_2', collect($range_0_to_plus_2)->toJson(JSON_NUMERIC_CHECK))
            ->with('range_0_to_minus_2', collect($range_0_to_minus_2)->toJson())
            ->with('range_minus_2', collect($range_minus_2)->toJson())
            ->with('category', collect($category)->toJson())
            ->with('todayDate', $todayDate)
            ->with('renderTo', "gainer_loser_depth")
            ->with('height',$height);


    }
}