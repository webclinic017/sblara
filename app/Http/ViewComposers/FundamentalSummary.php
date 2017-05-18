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

class FundamentalSummary
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
        if(isset($viewdata['instrument_id']))
        {
            $instrument_id=$viewdata['instrument_id'];
        }

        $metaKey=array("net_asset_val_per_share","paid_up_capital","agm_date");
        $epsData=FundamentalRepository::getAnnualizedEPS(array($instrument_id));
        $fundaData=FundamentalRepository::getFundamentalData($metaKey,array($instrument_id));
        $epsData=$epsData[$instrument_id];
        $fundaData=r_collect($fundaData);

        $fundaData['agm_date']->first()->meta_value=Carbon::parse($fundaData['agm_date']->first()->meta_value);

        $view->with('epsData', $epsData)
            ->with('fundaData',$fundaData);

    }
}