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

class GainLossItem {

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
        $parentTransaction = $transaction->parent_portfolio_transaction;

        $view->with('parentTransaction', $parentTransaction);
        $profit = 0;
        $buyCommission = 0;
        if ($parentTransaction) {
            $profit = $transaction->amount * $transaction->commission / 100 - $parentTransaction->amount * $parentTransaction->commission / 100;
            $buyCommission = $parentTransaction->amount + $parentTransaction->commission / 100;
//            $view->with('shares', $shares);
        }
        $sellCommission = $transaction->amount * $transaction->commission / 100;
        $view->with('sellCommission', $sellCommission);
        $view->with('buyCommission', $buyCommission);
        $view->with('profit', $profit);
        $view->with('exchanges', \App\Exchange::all());
        $view->with('instruments', $instruments);
        $view->with('types', \App\TransactionType::all());
        $view->with('viewData', $viewData);
    }

}
