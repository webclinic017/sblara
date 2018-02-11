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
class UpDownChart
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
        $batch_id=$market_info[0]->data_bank_intraday_batch;
        $batch_id_prev=$market_info[1]->data_bank_intraday_batch;
        $market_id_prev=$market_info[1]->id;



        $sql="SELECT data_banks_intradays.batch,
SUM(
    case when (case when close_price>0 then close_price else (case when spot_last_traded_price>0 then spot_last_traded_price else pub_last_traded_price end) end)-yday_close_price>0 then 1 else 0 end
) as up,

SUM(
    case when (case when close_price>0 then close_price else (case when spot_last_traded_price>0 then spot_last_traded_price else pub_last_traded_price end) end)-yday_close_price<0 then 1 else 0 end
) as down,


SUM(
    case when (case when close_price>0 then close_price else (case when spot_last_traded_price>0 then spot_last_traded_price else pub_last_traded_price end) end)-yday_close_price=0 then 1 else 0 end
) as eq


FROM data_banks_intradays,instruments WHERE
data_banks_intradays.instrument_id=instruments.id and instruments.sector_list_id!=4 and instruments.sector_list_id!=5 and instruments.sector_list_id!=22 and instruments.sector_list_id!=23 and instruments.sector_list_id!=25 and  (data_banks_intradays.batch=$batch_id or data_banks_intradays.batch=$batch_id_prev) GROUP BY data_banks_intradays.batch
ORDER BY data_banks_intradays.batch ASC";

        $up_down_data=DB::select($sql);


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

        $total_traded_time_so_far = $last_trade_time->timestamp-$market_started;

        $avg_trade_value_per_second = $trade_data_today[0]->TRD_TOTAL_VALUE / $total_traded_time_so_far;
        $projected_trade_value=round($avg_trade_value_per_second*$total_market_time,2);

      /*  dump($market_info[0]);
        dump($last_trade_time);
        dump($total_market_time);
        dump($total_traded_time_so_far);
        dump($avg_trade_value_per_second);
        dd($trade_data_today);*/
        $view->with('up_down_data_today', $up_down_data[1])->with('up_down_data_prev', $up_down_data[0])->with('trade_data_today', $trade_data_today[0])->with('trade_data_prev', $trade_data_prev[0])->with('projected_trade_value', $projected_trade_value);
    }
}