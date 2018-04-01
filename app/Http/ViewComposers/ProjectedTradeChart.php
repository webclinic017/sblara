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
use App\Market;
use DB;
use Carbon\Carbon;
class ProjectedTradeChart
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $market_info=Market::getActiveDates(2);
        $market_id=$market_info[0]->id;
        $today=$market_info[0]->trade_date->format('d M,Y');
        $market_id_prev=$market_info[1]->id;
        $prevday = $market_info[1]->trade_date->format('d M,Y');


        $sql="select * from trades where market_id=$market_id ORDER by TRD_LM_DATE_TIME desc limit 1";
        $trade_data_today=DB::select($sql);

        $sql="select * from trades where market_id=$market_id_prev ORDER by TRD_LM_DATE_TIME desc limit 1";
        $trade_data_prev=DB::select($sql);

        $last_trade_time=Carbon::parse($trade_data_today[0]->TRD_LM_DATE_TIME);

        $market_started=$market_info[0]->trade_date->format('Y-m-d').' '.$market_info[0]->market_started->format('H:i:s');
        $market_closed=$market_info[0]->trade_date->format('Y-m-d').' '.$market_info[0]->market_closed->format('H:i:s');

        $market_started=Carbon::parse($market_started)->timestamp;
        $market_closed=Carbon::parse($market_closed)->timestamp;

        $total_market_time=$market_closed-$market_started;

        $total_traded_time_so_far = $market_closed<$last_trade_time->timestamp?$market_closed-$market_started:$last_trade_time->timestamp-$market_started;

        $avg_trade_value_per_second = $trade_data_today[0]->TRD_TOTAL_VALUE / $total_traded_time_so_far;
        $projected_trade_value=round($avg_trade_value_per_second*$total_market_time,2);

      /*  dump($market_info[0]);
        dump($last_trade_time);
        dump($total_market_time);
        dump($total_traded_time_so_far);
        dump($avg_trade_value_per_second);
        dd($trade_data_today);*/
        $view ->with('today', $today)
            ->with('prevday', $prevday)
            ->with('trade_data_today', $trade_data_today[0])
            ->with('trade_data_prev', $trade_data_prev[0])
            ->with('projected_trade_value', $projected_trade_value);
    }
}