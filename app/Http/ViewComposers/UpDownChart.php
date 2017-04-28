<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\IndexRepository;
use App\Repositories\DataBanksIntradayRepository;

class UpDownChart
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $upDownData=DataBanksIntradayRepository::upDownStats();
        $viewData=array();
        $viewData['upDownData']=$upDownData;

        //dd($viewData);
        $view->with('viewData', $viewData);
    }
}