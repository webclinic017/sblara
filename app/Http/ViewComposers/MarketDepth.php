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
Use App\Market;


class MarketDepth
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */


    public function compose(View $view)
    {
        $viewdata= $view->getData();

        $instrument_id=13;
        if(isset($viewdata['instrument_id']))
            $instrument_id=$viewdata['instrument_id'];

        $view->with('instrument_code', $instrument_id);

    }


}