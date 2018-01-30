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

class TradeSummary
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
       /*   //getting top 10 list by total_trades
        $totalTradeList=DataBanksIntradayRepository::significantValueLastMinute('total_trades',10);
        $totalTradeData=DataBanksIntradayRepository::getMinuteData($totalTradeList->keys(),15,'total_trades');

        // getting 15 minutes data for each share.
        // We have to discard last (15th) value of difference. So we are adding slice(0,14) in view
        $instrumentList=InstrumentRepository::getInstrumentList();
        $instrumentList=$instrumentList->keyBy('id');

        $viewData=array();
        $viewData['totalTradeList']=$totalTradeList;
        $viewData['totalTradeData']=$totalTradeData;
        $viewData['instrumentList']=$instrumentList;*/

        $view->with('viewData', '1');
    }
}