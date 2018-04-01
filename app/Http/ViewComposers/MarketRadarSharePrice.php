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
use DB;
use App\Market;

class MarketRadarSharePrice
{

    /**
     * Bind data-the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $market_info = Market::getActiveDates();
        $batch_id = $market_info[0]->data_bank_intraday_batch;

        ///////////////////////// Share price up within range START  \\\\\\\\\\\\\\\\\\\\\\\

        $sql="SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT '0-10' AS PriceRange
  UNION SELECT '10-20'
    UNION SELECT '20-30'
  UNION SELECT '30-50'
  UNION SELECT '50-100'
  UNION SELECT '100-200'
  UNION SELECT 'over 200' ) x
LEFT JOIN (
   SELECT
      CASE when data_banks_intradays.close_price > 0 and data_banks_intradays.close_price <= 10 then '0-10'
    when data_banks_intradays.close_price > 10 and data_banks_intradays.close_price <= 20 then '10-20'
           when data_banks_intradays.close_price > 20 and data_banks_intradays.close_price <= 30 then '20-30'
           when data_banks_intradays.close_price >30  and data_banks_intradays.close_price <= 50 then '30-50'
           when data_banks_intradays.close_price > 50 and data_banks_intradays.close_price <= 100 then '50-100'
           when data_banks_intradays.close_price > 100 and data_banks_intradays.close_price <= 200 then '100-200'
           else 'over 200'
      END AS PriceRange,
      COUNT(*) as TotalWithinRange

     FROM
 data_banks_intradays
 WHERE
 data_banks_intradays.batch=$batch_id and data_banks_intradays.close_price -data_banks_intradays.yday_close_price>0
   GROUP BY 1 ) y ON x.PriceRange = y.PriceRange";

        $paidup_data_up = DB::select($sql);


        ///////////////////////// share price up within range END  \\\\\\\\\\\\\\\\\\\\\\\


        ///////////////////////// share price total within range START  \\\\\\\\\\\\\\\\\\\\\\\

        $sql="SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT '0-10' AS PriceRange
  UNION SELECT '10-20'
    UNION SELECT '20-30'
  UNION SELECT '30-50'
  UNION SELECT '50-100'
  UNION SELECT '100-200'
  UNION SELECT 'over 200' ) x
LEFT JOIN (
   SELECT
      CASE when data_banks_intradays.close_price > 0 and data_banks_intradays.close_price <= 10 then '0-10'
    when data_banks_intradays.close_price > 10 and data_banks_intradays.close_price <= 20 then '10-20'
           when data_banks_intradays.close_price > 20 and data_banks_intradays.close_price <= 30 then '20-30'
           when data_banks_intradays.close_price >30  and data_banks_intradays.close_price <= 50 then '30-50'
           when data_banks_intradays.close_price > 50 and data_banks_intradays.close_price <= 100 then '50-100'
           when data_banks_intradays.close_price > 100 and data_banks_intradays.close_price <= 200 then '100-200'
           else 'over 200'
      END AS PriceRange,
      COUNT(*) as TotalWithinRange

     FROM
 data_banks_intradays
 WHERE
 data_banks_intradays.batch=$batch_id
   GROUP BY 1 ) y ON x.PriceRange = y.PriceRange";

        $paidup_data_total = DB::select($sql);
        $category=array();
        $total=array();

        $sort=array();
        $i=0;
        foreach($paidup_data_total as $row)
        {
            $category[]= $row->PriceRange.'';
            $total[]=$row->TotalWithinRange;
            $up[] = isset($paidup_data_up[$i])?$paidup_data_up[$i]->TotalWithinRange:0;

            $per= isset($paidup_data_up[$i]) ?round($paidup_data_up[$i]->TotalWithinRange / $row->TotalWithinRange * 100, 2):0;
            $sort[$row->PriceRange]= $per;
            $i++;
        }
        arsort($sort);

        $interested_on=array_keys($sort)[0];
        $interested_per=array_values($sort)[0];

        /*foreach($paidup_data_up as $row)
        {
            $up[] = $row->TotalWithinRange;
        }*/


        ///////////////////////// Paidup total within range END  \\\\\\\\\\\\\\\\\\\\\\\


        $view ->with('category', collect($category)->toJson())
            ->with('interested_on', $interested_on)
            ->with('interested_per', $interested_per)
            ->with('total', collect($total)->toJson(JSON_NUMERIC_CHECK))
            ->with('total', collect($total)->toJson(JSON_NUMERIC_CHECK))
            ->with('up', collect($up)->toJson(JSON_NUMERIC_CHECK));

    }
}