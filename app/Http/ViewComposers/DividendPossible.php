<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\FundamentalRepository;
use Carbon\Carbon;

class DividendPossible
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
        $instrument_id=12;
        $render_to='dividend_possible';
        if(isset($viewdata['instrument_id']))
        {
            $instrument_id=$viewdata['instrument_id'];
        }
        if(isset($viewdata['render_to']))
        {
            $render_to=$viewdata['render_to'];
        }

        $metaKey=array("authorized_capital","paid_up_capital");
        $fundaData=FundamentalRepository::getFundamentalData($metaKey,array($instrument_id));
        $fundaData=r_collect($fundaData);


        $gap=$fundaData['authorized_capital']->first()->meta_value-$fundaData['paid_up_capital']->first()->meta_value;

        $view->with('render_to', $render_to)
            ->with('gap',$gap)
            ->with('paid_up_capital',$fundaData['paid_up_capital']->first()->meta_value);


    }
}