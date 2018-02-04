<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use App\Repositories\DataBanksIntradayRepository;
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

        $metaKey=array("net_asset_val_per_share","paid_up_capital","last_agm_held","authorized_capital","year_end","reserve_and_surp","total_no_securities","earning_per_share","share_percentage_public");
        $last_trade_info=DataBanksIntradayRepository::getAvailableLTP([$instrument_id]);
        $epsData=FundamentalRepository::getAnnualizedEPS(array($instrument_id));
        $fundaData=FundamentalRepository::getFundamentalData($metaKey,array($instrument_id));

        $epsData=$epsData[$instrument_id];
        $fundaData=r_collect($fundaData);

        $cp=cpOrLtp($last_trade_info[0]);
        $audited_pe=round($cp/floatval($fundaData['earning_per_share'][$instrument_id]->meta_value),2);
        $unaudited_pe=round($cp/$epsData['annualized_eps'],2);
        $total_no_securities=floatval($fundaData['total_no_securities'][$instrument_id]->meta_value);
        $share_percentage_public=floatval($fundaData['share_percentage_public'][$instrument_id]->meta_value);
        $public_securities=(int)(($share_percentage_public/100)*$total_no_securities);
        $market_cap=round(($total_no_securities*$cp)/1000000,2);
        $public_cap=round(($public_securities*$cp)/1000000,2);

        $category=category($last_trade_info[0]);

        $fundaData['last_agm_held']->first()->meta_value=Carbon::parse($fundaData['last_agm_held']->first()->meta_value);
        $year_end=date('d-M',strtotime($fundaData['year_end']->first()->meta_value));
        $year_end=Carbon::parse($year_end);
        //$year_end=Carbon::parse("3-Feb");
        if($year_end->isPast())
            $year_end->addYear();
        $fundaData['year_end']->first()->meta_value=$year_end;

        $view->with('epsData', $epsData)
            ->with('audited_pe',$audited_pe)
            ->with('unaudited_pe',$unaudited_pe)
            ->with('public_securities',$public_securities)
            ->with('category',$category)
            ->with('market_cap',$market_cap)
            ->with('public_cap',$public_cap)
            ->with('fundaData',$fundaData);

    }
}