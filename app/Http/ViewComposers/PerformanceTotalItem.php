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
        $transactions = \App\PortfolioScrip::where('share_status', 'buy')->where('portfolio_id', $portfolio->id)->get();
        $lastTradeData=DataBanksIntradayRepository::getLatestTradeDataAll();

        $shares = 0;
        $amount = 0;
        $buyPrice = 0;
        $buyCommission = 0;
        $totalPurchase = 0;
        $gainLossTotal = 0;
        $sellValue = 0;
        $gainLossToday = 0;

        $changePercentTotal = 0;
        $totalPurchaseWithCommission=0;
        $totalSellDeductingCommission=0;
        $totalProfitSincePurchase=0;

        foreach ($transactions as $transaction) {
            $priceInfo=$lastTradeData->where('instrument_id',$transaction->instrument_id)->first();

            //if not traded yet
            if(!count($priceInfo)) {
                $priceInfo = \App\DataBanksIntraday::where('instrument_id', $transaction->instrument_id)->orderBy('lm_date_time', 'desc')->skip(0)->take(1)->get()->first();
            }


            // buy value for this instrument
            $buyValue = $transaction->no_of_shares * $transaction->buying_price;
            $buyCommission=($transaction->commission/100)*$buyValue;
            $buyValueWithCommision=$buyValue+$buyCommission;

            // portfolio total buy value
            $totalPurchaseWithCommission+=$buyValueWithCommision;

            // sell value for this instrument if today sold
            $sellValue = $transaction->no_of_shares * $priceInfo->close_price;
            $sellCommission=($transaction->commission/100)*$sellValue;
            $sellValueDeductingCommision=$sellValue-$sellCommission;

            // portfolio total sell value if today sold
            $totalSellDeductingCommission+=$sellValueDeductingCommision;

            // profit for this instrument since if today sold
            $profit=$sellValueDeductingCommision-$buyValueWithCommision;

            // portfolio total profit if today sold
            $totalProfitSincePurchase+=$profit;

            // today change for all shares of this item
            $totalChangeForThisInstrument=$priceInfo->price_change*$transaction->no_of_shares;
            $gainLossToday+=$totalChangeForThisInstrument;


        }

        $total_portfolio_value= $totalPurchaseWithCommission + $portfolio->cash_amount;

        $totalChangeSincePurchase = $total_portfolio_value?($totalProfitSincePurchase/$total_portfolio_value)*100:0;
        $cash_amount_per = $total_portfolio_value? ($portfolio->cash_amount / $total_portfolio_value) * 100:0;

        $view->with('totalPurchaseWithCommission', round($totalPurchaseWithCommission, 2));
        $view->with('totalProfitSincePurchase', round($totalProfitSincePurchase, 2));
        $view->with('totalChangeSincePurchase', round($totalChangeSincePurchase, 2));
        $view->with('totalSellDeductingCommission', round($totalSellDeductingCommission, 2));
        $view->with('gainLossToday', round($gainLossToday, 2));
        $view->with('cash_amount', round($portfolio->cash_amount, 2));
        $view->with('cash_amount_per', round($cash_amount_per, 2));
    }

}
