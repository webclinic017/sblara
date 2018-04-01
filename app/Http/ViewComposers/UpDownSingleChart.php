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
class UpDownSingleChart
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
        $batch_id=$market_info[0]->data_bank_intraday_batch;
        $batch_id_prev=$market_info[1]->data_bank_intraday_batch;
        $market_id_prev=$market_info[1]->id;
        $prevday = $market_info[1]->trade_date->format('d M,Y');



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

        //excluding bond data_banks_intradays.instrument_id!=15 and data_banks_intradays.instrument_id!=51 and data_banks_intradays.instrument_id!=115 and

        $sql="SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT 'change_per<-2' AS PriceRange
  UNION SELECT '0>change_per>=-2'
  ) x
LEFT JOIN (
   SELECT
      CASE when (data_banks_intradays.close_price -data_banks_intradays.yday_close_price)/data_banks_intradays.yday_close_price*100 <-2 then 'change_per<-2'
           when (data_banks_intradays.close_price -data_banks_intradays.yday_close_price)/data_banks_intradays.yday_close_price*100 >=-2 and (data_banks_intradays.close_price -data_banks_intradays.yday_close_price)/data_banks_intradays.yday_close_price*100 <0 then '0>change_per>=-2'
      END AS PriceRange,
      COUNT(*) as TotalWithinRange
     FROM
 data_banks_intradays
 WHERE
 data_banks_intradays.instrument_id!=15 and data_banks_intradays.instrument_id!=51 and data_banks_intradays.instrument_id!=115 and data_banks_intradays.batch=$batch_id and  data_banks_intradays.close_price -data_banks_intradays.yday_close_price<0
   GROUP BY 1 ) y ON x.PriceRange = y.PriceRange
";

        $down_stats=DB::select($sql);
        $range_0_to_minus_2=$down_stats[1]->TotalWithinRange;
        $range_minus_2=$down_stats[0]->TotalWithinRange;



        $sql="SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT 'change_per>2' AS PriceRange
  UNION SELECT '0<change_per<=2'
  ) x
LEFT JOIN (
   SELECT
      CASE when (data_banks_intradays.close_price -data_banks_intradays.yday_close_price)/data_banks_intradays.yday_close_price*100 >2 then 'change_per>2'
           when (data_banks_intradays.close_price -data_banks_intradays.yday_close_price)/data_banks_intradays.yday_close_price*100 <= 2 and (data_banks_intradays.close_price -data_banks_intradays.yday_close_price)/data_banks_intradays.yday_close_price*100 >0 then '0<change_per<=2'
      END AS PriceRange,
      COUNT(*) as TotalWithinRange
     FROM
 data_banks_intradays
 WHERE
 data_banks_intradays.instrument_id!=15 and data_banks_intradays.instrument_id!=51 and data_banks_intradays.instrument_id!=115 and data_banks_intradays.batch=$batch_id and  data_banks_intradays.close_price -data_banks_intradays.yday_close_price>0
   GROUP BY 1 ) y ON x.PriceRange = y.PriceRange
   ";

        $up_stats=DB::select($sql);
        $range_plus_2=$up_stats[0]->TotalWithinRange;
        $range_0_to_plus_2=$up_stats[1]->TotalWithinRange;


        $view->with('up_down_data_today', $up_down_data[1])
            ->with('up_down_data_prev', $up_down_data[0])
            ->with('today', $today)
            ->with('prevday', $prevday)
            ->with('range_plus_2', $range_plus_2)
            ->with('range_0_to_plus_2', $range_0_to_plus_2)
            ->with('range_0_to_minus_2', $range_0_to_minus_2)
            ->with('range_minus_2', $range_minus_2);
    }
}