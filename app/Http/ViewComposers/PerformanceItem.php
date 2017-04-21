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

class PerformanceItem {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {
        $instruments = InstrumentRepository::getInstrumentList();
        $transactionTypes = \App\TransactionType::all();
        $viewData = [
            'instruments' => $instruments,
            'transactionTypes' => $transactionTypes,
        ];
        $transaction = $view->getData()['transaction'];
        $amountSumOfPortfolio = \App\PortfolioTransaction::where('portfolio_id', $transaction->portfolio_id)->sum('amount');
        $dataBankIntraDays = \App\DataBanksIntraday::where('instrument_id', $transaction->instrument_id)->orderBy('id', 'desc')->first();
        $lastTradePrice = $change = $changePercent = $gainLossToday = $gainLossTotal = $changePercentTotal = $portfolioPercent = $sellValue = 0;
        if ($dataBankIntraDays) {
            $lastTradePrice = $dataBankIntraDays->close_price;
            $lastTradeDate = $dataBankIntraDays->lm_date_time->format('Y-m-d');
            $change = $dataBankIntraDays->price_change;
            $changePercent = $transaction->rate ? $change / $transaction->rate * 100 : 0;
            $gainLossToday = $change * $transaction->shares;
            $changeTotal = $lastTradePrice - $transaction->rate;
            $changePercentTotal = $transaction->rate ? $changeTotal / $transaction->rate * 100 : 0;
            $gainLossTotal = $changeTotal * $transaction->shares;
            $sellValue = $lastTradePrice * $transaction->shares;
            $portfolioPercent = $transaction->rate * $transaction->shares / $amountSumOfPortfolio * 100;
        }
        $view->with('lastTradeDate', $lastTradeDate);
        $view->with('lastTradePrice', $lastTradePrice);
        $view->with('changeToday', round($change, 2));
        $view->with('changeTodayPercent', round($changePercent, 2));
        $view->with('gainLossToday', round($gainLossToday, 2));
        $view->with('gainLossTotal', round($gainLossTotal, 2));
        $view->with('percentChange', round($changePercentTotal, 2));
        $view->with('percentPortfolio', round($portfolioPercent, 2));
        $view->with('sellValue', round($sellValue, 2));
        $view->with('purchaseTotal', round($transaction->rate * $transaction->shares + $transaction->commission, 2));
        $view->with('exchanges', \App\Exchange::all());
        $view->with('instruments', $instruments);
        $view->with('types', \App\TransactionType::all());
        $view->with('viewData', $viewData);
    }

}
