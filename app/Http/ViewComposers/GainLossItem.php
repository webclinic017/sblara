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
        if ($parentTransaction) {
            $profit = $transaction->rate - $parentTransaction->rate;
            $shares = $transaction->shares + $parentTransaction->shares;
            $view->with('shares', $shares);
        }
        $view->with('profit', $profit);
        $view->with('exchanges', \App\Exchange::all());
        $view->with('instruments', $instruments);
        $view->with('types', \App\TransactionType::all());
        $view->with('viewData', $viewData);
    }

}
