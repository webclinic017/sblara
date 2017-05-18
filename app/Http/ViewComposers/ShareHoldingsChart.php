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

class ShareHoldingsChart
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
        $render_to='share_holdings_chart';
        if(isset($viewdata['instrument_id']))
        {
            $instrument_id=$viewdata['instrument_id'];
        }
        if(isset($viewdata['render_to']))
        {
            $render_to=$viewdata['render_to'];
        }

        $metaKey=array("share_percentage_director","share_percentage_govt","share_percentage_institute","share_percentage_foreign","share_percentage_public");
        $fundaData=FundamentalRepository::getFundamentalData($metaKey,array($instrument_id));
        $fundaData=r_collect($fundaData);
       // dd($fundaData['share_percentage_director']->first()->meta_value);



        $view->with('render_to', $render_to)
            ->with('fundaData',$fundaData);


    }
}