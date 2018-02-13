<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\InstrumentRepository;
use Illuminate\View\View;
use App\Repositories\FundamentalRepository;
use Carbon\Carbon;

class MarketRadar
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


        $instrument_list=InstrumentRepository::getInstrumentsScripOnly();
        $last_minute_data = DataBanksIntradayRepository::upDownStats();

        $instrument_id_arr= $instrument_list->pluck('id');

        $metaKey=array("paid_up_capital");
        $fundaData=FundamentalRepository::getFundamentalData($metaKey, $instrument_id_arr);

        $today_paid_up_capital_0_to_20_up=0;
        $today_paid_up_capital_0_to_20_down=0;

        $today_paid_up_capital_20_to_50_up=0;
        $today_paid_up_capital_20_to_50_down=0;

        $today_paid_up_capital_50_to_100_up=0;
        $today_paid_up_capital_50_to_100_down=0;

        $today_paid_up_capital_100_to_300_up=0;
        $today_paid_up_capital_100_to_300_down=0;

        $today_paid_up_capital_above_300_up=0;
        $today_paid_up_capital_above_300_down=0;

        foreach($fundaData['paid_up_capital'] as $instrument_id=>$paid_up_capital_meta)
        {
            $paid_up_capital=0;
            if(isset($paid_up_capital_meta['meta_value']))
            {
                $paid_up_capital = floatval($paid_up_capital_meta['meta_value']);
            }

            if($paid_up_capital>0 && $paid_up_capital<=20)
            {
                isset($last_minute_data['up'][$instrument_id])? $today_paid_up_capital_0_to_20_up++:0;
                isset($last_minute_data['down'][$instrument_id])? $today_paid_up_capital_0_to_20_down++:0;

            }
            if($paid_up_capital>20 && $paid_up_capital<=50)
            {
                isset($last_minute_data['up'][$instrument_id])? $today_paid_up_capital_20_to_50_up++:0;
                isset($last_minute_data['down'][$instrument_id])? $today_paid_up_capital_20_to_50_down++:0;

            }
            if($paid_up_capital>50 && $paid_up_capital<=100)
            {
                isset($last_minute_data['up'][$instrument_id])? $today_paid_up_capital_50_to_100_up++:0;
                isset($last_minute_data['down'][$instrument_id])? $today_paid_up_capital_50_to_100_down++:0;

            }
            if($paid_up_capital>100 && $paid_up_capital<=300)
            {
                isset($last_minute_data['up'][$instrument_id])? $today_paid_up_capital_100_to_300_up++:0;
                isset($last_minute_data['down'][$instrument_id])? $today_paid_up_capital_100_to_300_down++:0;

            }
            if($paid_up_capital>300)
            {
                isset($last_minute_data['up'][$instrument_id])? $today_paid_up_capital_above_300_up++:0;
                isset($last_minute_data['down'][$instrument_id])? $today_paid_up_capital_above_300_down++:0;

            }
        }
        $paid_up_radar=array();
        $paid_up_radar['paid up less than 20 million']=$today_paid_up_capital_0_to_20_up;
        $paid_up_radar['paid up from 20 to 50 million']=$today_paid_up_capital_20_to_50_up;
        $paid_up_radar['paid up from 50 to 100 million']=$today_paid_up_capital_50_to_100_up;
        $paid_up_radar['paid up from 100 to 300 million']= $today_paid_up_capital_100_to_300_up;
        $paid_up_radar['paid up above 300 million']=$today_paid_up_capital_above_300_up;

        dump($paid_up_radar);


        /*
          $view->with('epsData', $epsData)
              ->with('fundaData',$fundaData);*/

    }
}