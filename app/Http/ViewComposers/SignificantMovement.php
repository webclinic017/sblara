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

class SignificantMovement
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        //getting top 10 list by total_value
        $totalValueList=DataBanksIntradayRepository::significantValueLastMinute('total_value',10);


        // getting last 15 minutes data for each share of top 10 list.
        //setting 3rd param as total_value so that it return difference of total_value between 2 minutes (consecutive)
        $totalValueData=DataBanksIntradayRepository::getMinuteData($totalValueList->keys(),15,'total_value');

        $instrumentList=InstrumentRepository::getInstrumentList();
        $instrumentList=$instrumentList->keyBy('id');

        $viewData=array();
        $viewData['totalValueList']=$totalValueList;
        $viewData['totalValueData']=$totalValueData;
        $viewData['instrumentList']=$instrumentList;

        $view->with('viewData', $viewData);
    }
}