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
use App\Market;
use DB;


class TopByNoOfTrades
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */

    //This is not complete. we have to find growth between 2 days. not 2 minutes
    public function compose(View $view)
    {
        //getting top 10 list by total_trades
        $market_info=Market::getActiveDates();
        $batch_id=$market_info[0]->data_bank_intraday_batch;

        $sql="SELECT instruments.instrument_code,
sector_lists.name as sector,
data_banks_intradays.pub_last_traded_price,
data_banks_intradays.close_price,
data_banks_intradays.spot_last_traded_price,
data_banks_intradays.yday_close_price,
data_banks_intradays.total_value,
data_banks_intradays.total_trades,
instrument_id,
(
    (case when close_price>0 then close_price else
     (case when spot_last_traded_price>0 then spot_last_traded_price else pub_last_traded_price end
     )
     end
) - yday_close_price)/yday_close_price*100 as pchange_per
 FROM data_banks_intradays,instruments,sector_lists
 WHERE
 data_banks_intradays.batch=$batch_id and
 data_banks_intradays.instrument_id=instruments.id and  instruments.sector_list_id=sector_lists.id
 ORDER BY total_trades desc LIMIT 10";

        $top_list=DB::select($sql);



        $view->with('top_list', $top_list);
    }
}