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

        $instrumentListMain=InstrumentRepository::getInstrumentsScripOnly();
        $instrumentList=$instrumentListMain->groupBy('sector_list_id');

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
            $this_sectors_instrumentid=$instrument_arr->pluck('id');

            $all_up_instrument_id=$upDownData['up']->pluck('instrument_id');
            $all_down_instrument_id=$upDownData['down']->pluck('instrument_id');
            $all_eq_instrument_id=$upDownData['eq']->pluck('instrument_id');

            $this_sector_up=$all_up_instrument_id->intersect($this_sectors_instrumentid);
            $this_sector_down=$all_down_instrument_id->intersect($this_sectors_instrumentid);
            $this_sector_eq=$all_eq_instrument_id->intersect($this_sectors_instrumentid);

            $up=$this_sector_up->count();
            $down=$this_sector_down->count();
            $eq=$this_sector_eq->count();



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

            foreach($this_sector_up as $ins_id)
            {
                $price_change_per=$upDownData['up']->where('instrument_id',$ins_id)->first()->price_change_per;
                $total_volume=$upDownData['up']->where('instrument_id',$ins_id)->first()->total_volume;

                $instrument_code=$instrumentListMain->where('id',$ins_id)->first()->instrument_code;

                $details_data=array();
                $details_data['playcount']=$price_change_per;
                $details_data['$color']='#1BA39C';
                $details_data['image']='#';
                $details_data['$area']=$price_change_per;
                $details_data['$total_volume']=$total_volume;
                $details_data['$price_change_per']=$price_change_per;

                $details_node=array();
                $details_node['children']=Array();
                $details_node['data']=$details_data;
                $details_node['id']="up_$instrument_code";
                $details_node['name']=$instrument_code;
                $up_node['children'][]=$details_node;
            }


            $down_data=array();
            $down_data['playcount']=$down;
            $down_data['$color']='#EF4836';
            $down_data['image']='#';
            $down_data['$area']=$down;

            $down_node['children']=Array();
            $down_node['data']=$down_data;
            $down_node['id']="down_$sector_name";
            $down_node['name']="Down";


            foreach($this_sector_down as $ins_id)
            {

                $price_change_per=$upDownData['down']->where('instrument_id',$ins_id)->first()->price_change_per;
                $total_volume=$upDownData['down']->where('instrument_id',$ins_id)->first()->total_volume;


                $instrument_code=$instrumentListMain->where('id',$ins_id)->first()->instrument_code;

                $details_data=array();
                $details_data['playcount']=$price_change_per;
                $details_data['$color']='#EF4836';
                $details_data['image']='#';
                $details_data['$area']=$price_change_per;
                $details_data['$total_volume']=$total_volume;
                $details_data['$price_change_per']=$price_change_per;

                $details_node=array();
                $details_node['children']=Array();
                $details_node['data']=$details_data;
                $details_node['id']="up_$instrument_code";
                $details_node['name']=$instrument_code;
                $down_node['children'][]=$details_node;
            }



            $eq_data=array();
            $eq_data['playcount']=$eq;
            $eq_data['$color']='#ACB5C3';
            $eq_data['image']='#';
            $eq_data['$area']=$eq;

            $eq_node['children']=Array();
            $eq_node['data']=$eq_data;
            $eq_node['id']="equal_$sector_name";
            $eq_node['name']="Equal";

            foreach($this_sector_eq as $ins_id)
            {
                $price_change_per=$upDownData['eq']->where('instrument_id',$ins_id)->first()->price_change_per;
                $total_volume=$upDownData['eq']->where('instrument_id',$ins_id)->first()->total_volume;

                $instrument_code=$instrumentListMain->where('id',$ins_id)->first()->instrument_code;

                $details_data=array();
                $details_data['playcount']=$total_volume;
                $details_data['$color']='#ACB5C3';
                $details_data['image']='#';
                $details_data['$area']=$total_volume;
                $details_data['$total_volume']=$total_volume;
                $details_data['$price_change_per']=$price_change_per;

                $details_node=array();
                $details_node['children']=Array();
                $details_node['data']=$details_data;
                $details_node['id']="up_$instrument_code";
                $details_node['name']=$instrument_code;
                $eq_node['children'][]=$details_node;
            }


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