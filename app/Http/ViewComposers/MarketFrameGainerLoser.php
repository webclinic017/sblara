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

            $sector_data=array();
            $sector_data['playcount']=$up;
            $sector_data['$color']='blue';
            $sector_data['image']='#';
            //$sector_data['$area']=$up+$down+$eq;
            $sector_data['$area']=$up;

            $sector_node['children']=Array();
            $sector_node['data']=$sector_data;
            $sector_node['id']="$sector_name";
            $sector_node['name']="$sector_name";


            $up_data=array();
            $up_data['playcount']=$up;
            $up_data['$color']='#1BA39C';
            $up_data['image']='#';
            $up_data['$area']=$up;

            $up_node['children']=Array();
            $up_node['data']=$up_data;
            $up_node['id']="up_$sector_name";
            $up_node['name']="Up";

            $down_data=array();
            $down_data['playcount']=$down;
            $down_data['$color']='#EF4836';
            $down_data['image']='#';
            $down_data['$area']=$down;

            $down_node['children']=Array();
            $down_node['data']=$down_data;
            $down_node['id']="down_$sector_name";
            $down_node['name']="Down";


            $eq_data=array();
            $eq_data['playcount']=$eq;
            $eq_data['$color']='#ACB5C3';
            $eq_data['image']='#';
            $eq_data['$area']=$eq;

            $eq_node['children']=Array();
            $eq_node['data']=$eq_data;
            $eq_node['id']="equal_$sector_name";
            $eq_node['name']="Equal";


            $sector_node['children'][]=$up_node;
            $sector_node['children'][]=$down_node;
            $sector_node['children'][]=$eq_node;
            $mainnode['children'][]=$sector_node;

        }

        //dd(collect($mainnode));



        //dd($viewData);
        $view->with('sectorGainerLoserNode', collect($mainnode)->toJson());
    }
}