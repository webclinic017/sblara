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

class SectorGainerLoser
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

      /*  $instrumentList=InstrumentRepository::getInstrumentsScripOnly();

        $instrumentList=$instrumentList->groupBy('sector_list_id');

        $upDownData=DataBanksIntradayRepository::upDownStats();

        $upArr=array();
        $downArr=array();
        $eqArr=array();
        $category=array();
        foreach($instrumentList as $sector_id=>$instrument_arr)
        {
            $sector_name=$instrument_arr->first()->sector_list->name;
            $set_of_sectors_instrumentid=$instrument_arr->pluck('id');

            $set_of_up_instrument_id=$upDownData['up']->pluck('instrument_id');
            $set_of_down_instrument_id=$upDownData['down']->pluck('instrument_id');
            $set_of_eq_instrument_id=$upDownData['eq']->pluck('instrument_id');

            $upArr[]=$set_of_up_instrument_id->intersect($set_of_sectors_instrumentid)->count();
            $downArr[]=$set_of_down_instrument_id->intersect($set_of_sectors_instrumentid)->count();
            $eqArr[]=$set_of_eq_instrument_id->intersect($set_of_sectors_instrumentid)->count();
            $category[]=$sector_name;
        }

        // new

        $instrumentList = InstrumentRepository::getInstrumentsScripOnly();
        sbdump($instrumentList,'afmsohail@gmail.com');
*/


        $instrumentTradeData = DataBanksIntradayRepository::getLatestTradeDataAll();
        $instrumentTradeData = $instrumentTradeData->keyBy('instrument_id');

        $instrumentList = InstrumentRepository::getInstrumentsScripOnly();
        $instrumentList->load('sector_list');
        $up = array();
        $down = array();
        $eq = array();
        foreach ($instrumentList as $instrument) {
            $instrument_id = $instrument->id;
            $sector_name = $instrument->sector_list->name;

            if (isset($instrumentTradeData[$instrument_id])) {
                if ($instrumentTradeData[$instrument_id]->price_change > 0) {
                    if (isset($up[$sector_name])) {
                        $up[$sector_name] += 1;
                    } else {
                        $up[$sector_name] = 1;
                    }

                }

                if ($instrumentTradeData[$instrument_id]->price_change < 0) {
                    if (isset($down[$sector_name])) {
                        $down[$sector_name] += 1;
                    } else {
                        $down[$sector_name] = 1;
                    }

                }
                if ($instrumentTradeData[$instrument_id]->price_change == 0) {
                    if (isset($eq[$sector_name])) {
                        $eq[$sector_name] += 1;
                    } else {
                        $eq[$sector_name] = 1;
                    }

                }
            }


        }
        arsort($up);
        arsort($down);
        arsort($eq);


        $category_arr = array();

        foreach ($up as $sector_name => $share_no) {
            $category_arr[$sector_name] = $sector_name;

        }

        foreach ($down as $sector_name => $share_no) {
            $category_arr[$sector_name] = $sector_name;
        }

        foreach ($eq as $sector_name => $share_no) {
            $category_arr[$sector_name] = $sector_name;
        }

        $up_arr = array();
        $down_arr = array();
        $eq_arr = array();
        $category=array();

        foreach ($category_arr as $sector_name) {
            $category[]= $sector_name;
            if (isset($up[$sector_name]))
                $up_arr[] = $up[$sector_name];
            else
                $up_arr[] = 0;

            if (isset($down[$sector_name]))
                $down_arr[] = $down[$sector_name];
            else
                $down_arr[] = 0;

            if (isset($eq[$sector_name]))
                $eq_arr[] = $eq[$sector_name];
            else
                $eq_arr[] = 0;
        }


        $category=json_encode($category);
        $upArr=json_encode($up_arr);
        $downArr=json_encode($down_arr);
        $eqArr=json_encode($eq_arr);
        $view->with('category', $category)->with('upArr',$upArr)->with('downArr',$downArr)->with('eqArr',$eqArr);



    }
}