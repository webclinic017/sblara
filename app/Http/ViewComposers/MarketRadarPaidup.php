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

class MarketRadarPaidup
{

    /**
     * Bind data to the view.
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
  SELECT '0 to 100' AS PriceRange
  UNION SELECT '100 to 300'
  UNION SELECT '300 to 500'
  UNION SELECT '500 to 1000'
  UNION SELECT '1000 to 2000'
  UNION SELECT 'over 2000' ) x
LEFT JOIN (
   SELECT
      CASE when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 0 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 100 then '0 to 100'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 100 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 300 then '100 to 300'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) >300  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 500 then '300 to 500'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 500 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 1000 then '500 to 1000'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 1000 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 2000 then '1000 to 2000'
           else 'over 2000'
      END AS PriceRange,
      COUNT(*) as TotalWithinRange

     FROM
 data_banks_intradays,fundamentals,metas
 WHERE
 data_banks_intradays.instrument_id=fundamentals.instrument_id and data_banks_intradays.batch=$batch_id and fundamentals.meta_id=metas.id and fundamentals.is_latest=1 and (metas.meta_key like 'paid_up_capital') and data_banks_intradays.close_price -data_banks_intradays.yday_close_price>0

   GROUP BY 1 ) y ON x.PriceRange = y.PriceRange";

        $paidup_data_up = DB::select($sql);


        ///////////////////////// Paidup up within range END  \\\\\\\\\\\\\\\\\\\\\\\


        ///////////////////////// Paidup total within range START  \\\\\\\\\\\\\\\\\\\\\\\

        $sql="SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT '0 to 100' AS PriceRange
  UNION SELECT '100 to 300'
  UNION SELECT '300 to 500'
  UNION SELECT '500 to 1000'
  UNION SELECT '1000 to 2000'
  UNION SELECT 'over 2000' ) x
LEFT JOIN (
   SELECT
      CASE when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 0 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 100 then '0 to 100'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 100 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 300 then '100 to 300'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) >300  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 500 then '300 to 500'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 500 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 1000 then '500 to 1000'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 1000 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 2000 then '1000 to 2000'
           else 'over 2000'
      END AS PriceRange,
      COUNT(*) as TotalWithinRange

     FROM
 data_banks_intradays,fundamentals,metas
 WHERE
 data_banks_intradays.instrument_id=fundamentals.instrument_id and data_banks_intradays.batch=$batch_id and fundamentals.meta_id=metas.id and fundamentals.is_latest=1 and (metas.meta_key like 'paid_up_capital')

   GROUP BY 1 ) y ON x.PriceRange = y.PriceRange";

        $paidup_data_total = DB::select($sql);
        $category=array();
        $total=array();

        $sort=array();
        $i=0;
        foreach($paidup_data_total as $row)
        {
            $category[]= $row->PriceRange.'M';
            $total[]=$row->TotalWithinRange;
            $up[] = $paidup_data_up[$i]->TotalWithinRange;

            $per= round($paidup_data_up[$i]->TotalWithinRange / $row->TotalWithinRange * 100, 2);
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