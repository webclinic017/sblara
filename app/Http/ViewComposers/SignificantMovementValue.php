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

class SignificantMovementValue
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

        // getting 15 minutes data for each share.
        // We have to discard last (15th) value of difference. So we are adding slice(0,14) in view
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