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

        $buyValue = $transaction->no_of_shares * $transaction->buying_price;
        $buyCommission=($transaction->commission/100)*$buyValue;
        $buyValueWithCommision=$buyValue+$buyCommission;

        $sellValue = $transaction->no_of_shares * $transaction->sell_price;
        $sellCommission=($transaction->commission/100)*$sellValue;
        $sellValueDeductingCommision=$sellValue-$sellCommission;

        $profit=$sellValueDeductingCommision-$buyValueWithCommision;

        $view->with('sellCommission', $sellCommission);
        $view->with('buyCommission', $buyCommission);
        $view->with('buyValue', $buyValue);
        $view->with('sellValue', $sellValue);
        $view->with('profit', $profit);
        $view->with('exchanges', \App\Exchange::all());
        $view->with('instruments', $instruments);
        $view->with('types', \App\TransactionType::all());
        $view->with('viewData', $viewData);
    }

}
