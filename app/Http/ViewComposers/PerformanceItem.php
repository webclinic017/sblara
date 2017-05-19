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
        $instruments      = InstrumentRepository::getInstrumentList();
        $transactionTypes = \App\TransactionType::all();
//        $viewData = [
//            'instruments' => $instruments,
//            'transactionTypes' => $transactionTypes,
//        ];
        $viewData      = $view->getData();
        $isChild       = isset($viewData['isChild']) ? $viewData['isChild'] : false;
        $transaction   = $viewData['transaction'];
        $instrumentId  = $transaction->instrument_id;
        $shares        = $transaction->shares;
        $buyPrice      = $transaction->rate;
        $totalBuyCost  = $shares * $buyPrice;
        $buyCommission = $transaction->commission * $totalBuyCost / 100;
        $amount        = $transaction->amount;
        $totalPurchase = $buyPrice * $shares + $buyCommission;

        if (!$isChild) {
            $transactions = \App\PortfolioTransaction::where('instrument_id', $instrumentId)
                                                     ->where('transaction_type_id', 1)
                                                     ->where('portfolio_id', $transaction->portfolio_id)
                                                     ->get();
            if ($transactions->count() > 1) {
                $shares        = 0;
                $amount        = 0;
                $buyPrice      = 0;
                $buyCommission = 0;
                $totalPurchase = 0;

                foreach ($transactions as $transactionChild) {
                    $shares            +=$transactionChild->shares;
                    $buyPrice          +=$transactionChild->rate;
                    $totalBuyCost      = $transactionChild->shares * $transactionChild->rate;
                    $buyCommissionChil = $totalBuyCost * $transactionChild->commission / 100;
                    $buyCommission     +=$totalBuyCost * $transactionChild->commission / 100;
                    $amount            +=$transactionChild->amount;
                    $totalPurchase     +=$transactionChild->rate * $transactionChild->shares + $buyCommissionChil;
                }

                $buyPrice = $buyPrice / $transactions->count();
//                $buyCommission = $buyCommission / $transactions->count();
            }
        }

        $amountSumOfPortfolio = \App\PortfolioTransaction::where('portfolio_id', $transaction->portfolio_id)
                                                         ->where('transaction_type_id', 1)
                                                         ->sum('amount');

        $dataBankIntraDays = \App\DataBanksIntraday::where('instrument_id', $transaction->instrument_id)
                                                   ->orderBy('id', 'desc')
                                                   ->first();

        $lastTradePrice = $change = $changePercent = $gainLossToday = $gainLossTotal = $changePercentTotal = $portfolioPercent = $sellValue = 0;

        if ($dataBankIntraDays) {
            $lastTradePrice     = $dataBankIntraDays->close_price;
            $lastTradeDate      = $dataBankIntraDays->lm_date_time->format('Y-m-d');
            $change             = $dataBankIntraDays->price_change;
            $changePercent      = $buyPrice ? $change / $buyPrice * 100 : 0;
            $gainLossToday      = $change * $shares;
            $changeTotal        = $lastTradePrice - $buyPrice;
            $changePercentTotal = $buyPrice ? $changeTotal / $buyPrice * 100 : 0;
            $gainLossTotal      = $changeTotal * $shares;
            $sellValue          = $lastTradePrice * $shares;
            $portfolioPercent   = $amount / $amountSumOfPortfolio * 100;
        }

        $isParent = false;

        if (!$isChild && $transactions->count() > 1) {
            $isParent = true;
            $view->with('childTransactions', $transactions);
        } else {
            $view->with('childTransactions', []);
        }

        $view->with('shares', $shares);
        $view->with('rate', round($buyPrice, 2));
        $view->with('commission', round($buyCommission, 2));
        $view->with('isParent', $isParent);
        $view->with('isChild', $isChild);
        $view->with('lastTradeDate', $lastTradeDate);
        $view->with('lastTradePrice', $lastTradePrice);
        $view->with('changeToday', round($change, 2));
        $view->with('changeTodayPercent', round($changePercent, 2));
        $view->with('gainLossToday', round($gainLossToday, 2));
        $view->with('gainLossTotal', round($gainLossTotal, 2));
        $view->with('percentChange', round($changePercentTotal, 2));
        $view->with('percentPortfolio', round($portfolioPercent, 2));
        $view->with('sellValue', round($sellValue, 2));
        $view->with('purchaseTotal', round($totalPurchase, 2));
        $view->with('exchanges', \App\Exchange::all());
        $view->with('instruments', $instruments);
        $view->with('types', \App\TransactionType::all());
        $view->with('viewData', $viewData);
    }

}
