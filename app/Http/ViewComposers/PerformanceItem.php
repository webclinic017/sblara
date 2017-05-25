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
        $shares        = $transaction->no_of_shares;
        $buyPrice      = $transaction->buying_price;
        $totalBuyCost  = $shares * $buyPrice;
        $buyCommission = $transaction->commission?($transaction->commission/100) * $totalBuyCost:0;
        $amount        = $totalBuyCost;
        $totalPurchase = $totalBuyCost + $buyCommission;
        $commission_rate=$transaction->commission;

        if (!$isChild) {
            $transactions = \App\PortfolioScrip::where('instrument_id', $instrumentId)
                                                     ->where('share_status', 'buy')
                                                     ->where('portfolio_id', $transaction->portfolio_id)
                                                     ->get();
            if ($transactions->count() > 1) {
                $shares        = 0;
                $amount        = 0;
                $buyPrice      = 0;
                $buyCommission = 0;
                $totalPurchase = 0;
                $grandTotalBuyCost=0;


                foreach ($transactions as $transactionChild) {
                    $shares            +=$transactionChild->no_of_shares;
                    $buyPrice          +=$transactionChild->buying_price;
                    $totalBuyCost  = $transactionChild->no_of_shares * $transactionChild->buying_price;
                    $grandTotalBuyCost+=$totalBuyCost;
                    $buyCommissionChil = $transactionChild->commission?($transactionChild->commission/100) * $totalBuyCost:0;
                    $buyCommission     +=$buyCommissionChil;
                    $amount            +=$totalBuyCost;
                    $totalPurchase     +=$totalBuyCost + $buyCommissionChil;
                }

                $buyPrice = $grandTotalBuyCost / $shares;
//                $buyCommission = $buyCommission / $transactions->count();
            }
        }

       /* $amountSumOfPortfolio = \App\PortfolioScrip::where('portfolio_id', $transaction->portfolio_id)
                                                         ->where('transaction_type_id', 1)
                                                         ->sum('amount');*/
        $amountSumOfPortfolio=$amount;

        $dataBankIntraDays = \App\DataBanksIntraday::where('instrument_id', $transaction->instrument_id)
                                                   ->orderBy('id', 'desc')
                                                   ->first();

        $lastTradePrice = $change = $changePercent = $gainLossToday = $gainLossTotal = $changePercentTotal = $portfolioPercent = $sellValue = 0;

        if ($dataBankIntraDays) {

            $buyValue = $shares * $buyPrice;
            $buyCommission=($commission_rate/100)*$buyValue;
            $buyValueWithCommision=$buyValue+$buyCommission;


            $sellValue = $shares * $dataBankIntraDays->close_price;
            $sellCommission=($commission_rate/100)*$sellValue;
            $sellValueDeductingCommision=$sellValue-$sellCommission;

            $lastTradePrice     = $dataBankIntraDays->close_price;
            $lastTradeDate      = $dataBankIntraDays->lm_date_time->format('Y-m-d');
            $change             = $dataBankIntraDays->price_change;
            $changePercent      = $buyPrice ? $change / $buyPrice * 100 : 0;
            $gainLossToday      = $change * $shares;

            $gainLossTotal      = $sellValueDeductingCommision-$buyValueWithCommision;
            $changePercentTotal=$gainLossTotal/$buyValueWithCommision*100;

            $sellValue          = $sellValueDeductingCommision;
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
