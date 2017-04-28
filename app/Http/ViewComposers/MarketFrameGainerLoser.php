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

class MarketFrameGainerLoser
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $instrumentList=InstrumentRepository::getInstrumentsScripOnly();
        $instrumentList=$instrumentList->groupBy('sector_list_id');

        $upDownData=DataBanksIntradayRepository::upDownStats();


        $upArr=array();
        $downArr=array();
        $eqArr=array();
        $category=array();


        $mainnode['children']=Array();
        $mainnode['data']=array();
        $mainnode['id']="top";
        $mainnode['name']="Sector wise Gainer loser";


        foreach($instrumentList as $sector_id=>$instrument_arr)
        {
            $sector_name=$instrument_arr->first()->sector_list->name;
            $set_of_sectors_instrumentid=$instrument_arr->pluck('id');

            $set_of_up_instrument_id=$upDownData['up']->pluck('instrument_id');
            $set_of_down_instrument_id=$upDownData['down']->pluck('instrument_id');
            $set_of_eq_instrument_id=$upDownData['eq']->pluck('instrument_id');

            $up=$set_of_up_instrument_id->intersect($set_of_sectors_instrumentid)->count();
            $down=$set_of_down_instrument_id->intersect($set_of_sectors_instrumentid)->count();
            $eq=$set_of_eq_instrument_id->intersect($set_of_sectors_instrumentid)->count();
            $category[]=$sector_name;

            $data=array();
            $data['playcount']=$up;
            $data['$color']='#1BA39C';
            $data['image']='#';
            $data['$area']=$up;

            $node['children']=Array();
            $node['data']=$data;
            $node['id']="$sector_name";
            $node['name']="$sector_name";

            $mainnode['children'][]=$node;

        }

        //dd(collect($mainnode)->toJson());



        //dd($viewData);
        $view->with('sectorGainerLoserNode', collect($mainnode)->toJson());
    }
}