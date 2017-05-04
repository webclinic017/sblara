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

class MarketFrameOldSite
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

        $mainnode['data']=array('$class'=>'exchnage');
        $mainnode['id']="root";
        $mainnode['name']="Dhaka Stock Exchange";


        $market_turnover=0;
        foreach($instrumentList as $sector_id=>$instrument_arr)
        {
            $sector_node['children']=array();
            $sector_name=$instrument_arr->first()->sector_list->name;

            $sector_area_total=0;
            foreach($instrument_arr as $instrument)
            {
                $instrument_id=$instrument->id;
                if(!isset($instrumentTradeData[$instrument_id]))
                    continue;

                $sector_area_total+=$instrumentTradeData[$instrument_id]->$base;

                $share_data=array();
                $share_data['playcount']=208; // fixed
                $share_data['$color']='#AA5432';
                $share_data['$class']='stock';
                $share_data['$symbol']=$instrument->instrument_code;
                $share_data['$price']=$instrumentTradeData[$instrument_id]->close_price;
                $share_data['$sector']=$sector_name;
                $share_data['$volume']=$instrumentTradeData[$instrument_id]->total_volume;
                $share_data['$no_of_trade']=$instrumentTradeData[$instrument_id]->total_trades;
                $share_data['$turn_over']=$instrumentTradeData[$instrument_id]->total_value;
                $share_data['$price_change']=$instrumentTradeData[$instrument_id]->price_change;
                $share_data['$price_change_per']=$instrumentTradeData[$instrument_id]->price_change_per;
                $share_data['$image']='#';
                $share_data['$area']=$instrumentTradeData[$instrument_id]->$base;

                $share_node['children']=array();
                $share_node['data']=$share_data;
                $share_node['id']="dse_".$sector_id.$instrument->instrument_code;
                $share_node['name']=$instrument->instrument_code;

                $sector_node['children'][]=$share_node;
            }
            $sector_data=array();
            $sector_data['playcount']=208; // fixed
            $sector_data['$class']='sector';
            $sector_data['$area']=$sector_area_total;// sum of base for all shares of this sector(value/trades/volume etc)

            $market_turnover+=$sector_area_total;


            $sector_node['data']=$sector_data;
            $sector_node['id']="$sector_id";
            $sector_node['name']="$sector_name";

            $mainnode['children'][]=$sector_node;
        }

      $view->with('frameData', collect($mainnode)->toJson())
          ->with('market_turnover',$market_turnover);
    //          ->with('frame_id',$base."_frame");  // its not working because css is written for infovis
    }
}