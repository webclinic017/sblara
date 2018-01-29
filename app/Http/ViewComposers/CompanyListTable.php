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

class CompanyListTable
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */

    //This is not complete. we have to find growth between 2 days. not 2 minutes
    public function compose(View $view)
    {
        InstrumentRepository::getInstrumentsScripOnly();
        $all_data=DataBanksIntradayRepository::getAvailableLTP();
        $view->with('all_data', $all_data);
    }
}