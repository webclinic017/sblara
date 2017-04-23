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

class PerformanceTotalItem {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {
        $viewData = $view->getData();
        $portfolio = $viewData['portfolio'];
        $transactions = \App\PortfolioTransaction::where('transaction_type_id', 1)->where('portfolio_id', $portfolio->id)->get();
        $shares = 0;
        $amount = 0;
        $buyPrice = 0;
        $buyCommission = 0;
        $totalPurchase = 0;
        $gainLossTotal = 0;
        $sellValue = 0;
        $gainLossToday = 0;
        $changePercentTotal = 0;
        foreach ($transactions as $transaction) {
            $shares = $transaction->shares;
            $buyPrice = $transaction->rate;
            $totalBuyCost = $transaction->shares * $transaction->rate;
            $buyCommissionChil = $totalBuyCost * $transaction->commission / 100;
            $buyCommission = $totalBuyCost * $transaction->commission / 100;
            $amount = $transaction->amount;
            $totalPurchase += $transaction->rate * $transaction->shares + $buyCommissionChil;
            $dataBankIntraDays = \App\DataBanksIntraday::where('instrument_id', $transaction->instrument_id)->orderBy('id', 'desc')->first();
            $lastTradePrice = $change = $changePercent = $changePercentTotal = $portfolioPercent = 0;
            if ($dataBankIntraDays) {
                $lastTradePrice = $dataBankIntraDays->close_price;
                $lastTradeDate = $dataBankIntraDays->lm_date_time->format('Y-m-d');
                $change = $dataBankIntraDays->price_change;
                $changePercent = $buyPrice ? $change / $buyPrice * 100 : 0;
                $gainLossToday += $change * $shares;
                $changeTotal = $lastTradePrice - $buyPrice;
                $changePercentTotal = $buyPrice ? $changeTotal / $buyPrice * 100 : 0;
                $gainLossTotal += $changeTotal * $shares;
                $sellValue += $lastTradePrice * $shares;
            }
        }
        $change = $totalPurchase ? $gainLossTotal / $totalPurchase * 100 : 0;
        $view->with('change', round($change, 2));
        $view->with('totalPurchase', round($totalPurchase, 2));
        $view->with('gainLossToday', round($gainLossToday, 2));
        $view->with('gainLossTotal', round($gainLossTotal, 2));
        $view->with('percentChange', round($changePercentTotal, 2));
        $view->with('sellValue', round($sellValue, 2));
    }

}
