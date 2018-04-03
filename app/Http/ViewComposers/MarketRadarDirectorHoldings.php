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

class MarketRadarDirectorHoldings
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

        ///////////////////////// Paidup up within range START  \\\\\\\\\\\\\\\\\\\\\\\

        $sql="SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT '0-20' AS PriceRange
    UNION SELECT '20-30'
    UNION SELECT '30-35'
  UNION SELECT '35-40'
  UNION SELECT '40-50'
    UNION SELECT '50-60'
  UNION SELECT 'over 60' ) x
LEFT JOIN (
   SELECT
      CASE when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 0 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 20 then '0-20'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) >20  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 30 then '20-30'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) >30  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 35 then '30-35'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) >35  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 40 then '35-40'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 40 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 50 then '40-50'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 50 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 60 then '50-60'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 60 then 'over 60'

      END AS PriceRange,
      COUNT(*) as TotalWithinRange

     FROM
 data_banks_intradays,fundamentals,metas
 WHERE
 data_banks_intradays.instrument_id=fundamentals.instrument_id and data_banks_intradays.batch=131709 and fundamentals.meta_id=metas.id and fundamentals.is_latest=1 and (metas.meta_key like 'share_percentage_director')
    and data_banks_intradays.close_price -data_banks_intradays.yday_close_price>0

   GROUP BY 1 ) y ON x.PriceRange = y.PriceRange";

        $paidup_data_up = DB::select($sql);


        ///////////////////////// Paidup up within range END  \\\\\\\\\\\\\\\\\\\\\\\


        ///////////////////////// Paidup total within range START  \\\\\\\\\\\\\\\\\\\\\\\

        $sql="SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT '0-20' AS PriceRange
    UNION SELECT '20-30'
    UNION SELECT '30-35'
  UNION SELECT '35-40'
  UNION SELECT '40-50'
    UNION SELECT '50-60'
  UNION SELECT 'over 60' ) x
LEFT JOIN (
   SELECT
      CASE when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 0 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 20 then '0-20'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) >20  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 30 then '20-30'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) >30  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 35 then '30-35'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) >35  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 40 then '35-40'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 40 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 50 then '40-50'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 50 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 60 then '50-60'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 60 then 'over 60'

      END AS PriceRange,
      COUNT(*) as TotalWithinRange

     FROM
 data_banks_intradays,fundamentals,metas
 WHERE
 data_banks_intradays.instrument_id=fundamentals.instrument_id and data_banks_intradays.batch=$batch_id and fundamentals.meta_id=metas.id and fundamentals.is_latest=1 and (metas.meta_key like 'share_percentage_director')

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