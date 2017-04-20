<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\IndexRepository;
use App\Repositories\DataBanksIntradayRepository;

class MarketSummary
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $indexData=IndexRepository::IndexChartData();

        // hard coding index to save time for now. We have to make it generalize for all exchange later
        $dsexData=$indexData['index']['10001']['data']->first();
        $tradeData=$indexData['trade']->first();
        $tradeDataPrev=$indexData['trade_prev_day']->first();
        $perOfPrevDayTrade=($tradeData->TRD_TOTAL_VALUE/$tradeDataPrev->TRD_TOTAL_VALUE)*100;
        $perOfPrevDayTrade=(float) number_format($perOfPrevDayTrade, 2, '.', '');

       // $upDownData=DataBanksIntradayRepository::significantValueLastMinute();
        $upDownData=DataBanksIntradayRepository::upDownStats();

        $viewData=array();
        $viewData['dsexData']=$dsexData;
        $viewData['tradeData']=$tradeData;
        $viewData['upDownData']=$upDownData;
        $viewData['perOfPrevDayTrade']=$perOfPrevDayTrade;
        //dd($viewData);
        $view->with('viewData', $viewData);
    }
}