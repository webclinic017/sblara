<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\InstrumentRepository;

class TopByPriceChangePer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */

    //This is not complete. we have to find growth between 2 days. not 2 minutes
    public function compose(View $view)
    {
        //getting top 10 list by total_trades
        $topList=DataBanksIntradayRepository::getMinuteData();
        $topList=$topList->flatten();
        $topList=$topList->keyBy('instrument_id')->sortByDesc('price_change_per')->take(10);
//dd($topList->toArray());
        $minuteDataOfTopList=DataBanksIntradayRepository::getMinuteData($topList->keys(),15,'total_volume');

        // getting 15 minutes data for each share.
        // We have to discard last (15th) value of difference. So we are adding slice(0,14) in view
        $instrumentList=InstrumentRepository::getInstrumentList();
        $instrumentList=$instrumentList->keyBy('id');

        $viewData=array();
        $viewData['topList']=$topList;
        $viewData['minuteDataOfTopList']=$minuteDataOfTopList;
        $viewData['instrumentList']=$instrumentList;
        $viewData['inlinesparkline']='inlinesparkline_topbypricechage_per';

        $view->with('viewData', $viewData);
    }
}