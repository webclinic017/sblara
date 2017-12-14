<?php

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\InstrumentRepository;
class Contest
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
     
        return $view->with(compact(''));
    }
}