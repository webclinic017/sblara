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

class SectorGainerLoserColumn
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


        $instrumentList=InstrumentRepository::getInstrumentsScripOnly();
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

        $category=json_encode($category);
        $upArr=json_encode($upArr);
        $downArr=json_encode($downArr);
        $eqArr=json_encode($eqArr);
        $view->with('category', $category)
            ->with('upArr',$upArr)
            ->with('downArr',$downArr)
            ->with('eqArr',$eqArr)
            ->with('height',$height)
            ->with('renderTo','sector_gainer_loser_column');




    }
}