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
use App\Repositories\InstrumentRepository;
use App\Repositories\CorporateActionRepository;
use App\Instrument;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\MarketStatRepository;
use App\Repositories\IndexRepository;
use Illuminate\Support\Facades\Cache;


class DividendYieldAndPayoutRatio
{
    /**
     * The index repository implementation.
     *
     * @var IndexRepository
     */

    /**
     * Create a new market_summary composer.
     *
     * @param  IndexRepository  $indexes
     * @return void
     */


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {


        Cache::forget("dividend_payout");

        $return_arr = Cache::remember("dividend_payout", 1, function () {

            $instrument_list = InstrumentRepository::getInstrumentsScripOnly()->keyBy('id');
            $last_trade_data_all=DataBanksIntradayRepository::getAvailableLTP();
            $fundamental_data = FundamentalRepository::getFundamentalDataAll(array('cash_dividend', 'earning_per_share'));

            $dividend_yield_arr=array();
            $payout_ration_arr=array();

            $return_arr=array();
            foreach($last_trade_data_all as $instrument_id=>$data)
            {

                //let us check if it is valid instrument till now
                if(isset($instrument_list[$instrument_id]))
                {

                    // now let us check if any cash dividend found for this instrument
                    if(isset($fundamental_data['cash_dividend'][$instrument_id]))
                    {

                        // now we will take the last annual eps
                        if(isset($fundamental_data['earning_per_share'][$instrument_id]))
                        {
                            $temp=array();
                            $ltp = cpOrLtp($data);

                            $temp['instrument_code']= $instrument_list[$instrument_id]->instrument_code;
                            $temp['ltp']= $ltp;
                            // face value=10

                            $dividend_per_taka= floatval($fundamental_data['cash_dividend'][$instrument_id]['meta_value'])/10;
                            $temp['dividend_yield']= $ltp ? round($dividend_per_taka/ $ltp*100,2):'N/A';


                            $eps= floatval($fundamental_data['earning_per_share'][$instrument_id]['meta_value']);
                            $temp['payout_ratio']= $eps? round($dividend_per_taka/ $eps*100,2):'N/A';

                            $temp['declaration']= floatval($fundamental_data['cash_dividend'][$instrument_id]['meta_value']);
                            $temp['declaration_date']= $fundamental_data['cash_dividend'][$instrument_id]['meta_date']->format('d M,Y');

                            $return_arr[$instrument_id]= $temp;
                        }

                    }


                }
            }


            return $return_arr;

        });


        $view->with('return_arr', $return_arr);


    }


}