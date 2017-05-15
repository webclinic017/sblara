<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBanksIntradayRepository;

class DataMatrix
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $instrumentList=InstrumentRepository::getInstrumentsScripOnly();

        $instrumentList=$instrumentList->groupBy('sector_list_id');

        $latestData=DataBanksIntradayRepository::getLatestTradeDataAll();


        //$view->with('category', $category)->with('upArr',$upArr)->with('downArr',$downArr)->with('eqArr',$eqArr);



    }
}