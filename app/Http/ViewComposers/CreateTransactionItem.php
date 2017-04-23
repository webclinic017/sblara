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

class CreateTransactionItem {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {

        //getting top 10 list by total_value
        $instruments = InstrumentRepository::getInstrumentList();
        $transactionTypes = \App\TransactionType::all();
        $viewData = [
            'instruments' => $instruments,
            'transactionTypes' => $transactionTypes,
        ];

        $view->with('instruments', $instruments);
        $view->with('exchanges', \App\Exchange::all());
        $view->with('viewData', $viewData);
    }

}
