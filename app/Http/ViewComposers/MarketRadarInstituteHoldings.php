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
use Illuminate\Support\Facades\Cache;

class MarketRadarInstituteHoldings
{

    /**
     * Bind data-the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {


        $cacheVar = "MarketRadarInstituteHoldingsData";
        //Cache::forget("$cacheVar");
        $returnData = Cache::remember("$cacheVar", 1, function (){
            $returnData=array();


            $market_info = Market::getActiveDates();
            $batch_id = $market_info[0]->data_bank_intraday_batch;
            $market_id = $market_info[0]->id;

            ///////////////////////// Paidup up within range START  \\\\\\\\\\\\\\\\\\\\\\\

            $sql = "SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT '0-10' AS PriceRange
    UNION SELECT '10-15'
    UNION SELECT '15-20'
  UNION SELECT '20-30'
  UNION SELECT '30-40'
  UNION SELECT 'over 40' ) x
LEFT JOIN (
   SELECT
      CASE when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 0 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 10 then '0-10'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) >10  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 15 then '10-15'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) >15  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 20 then '15-20'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) >20  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 30 then '20-30'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 30 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 40 then '30-40'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 40 then 'over 40'
      END AS PriceRange,
      COUNT(*) as TotalWithinRange

     FROM
 data_banks_intradays,fundamentals,metas
 WHERE
 data_banks_intradays.instrument_id=fundamentals.instrument_id   and data_banks_intradays.market_id=$market_id and data_banks_intradays.batch=$batch_id and fundamentals.meta_id=metas.id and fundamentals.is_latest=1 and (metas.meta_key like 'share_percentage_institute') and data_banks_intradays.close_price -data_banks_intradays.yday_close_price>0
 and data_banks_intradays.instrument_id !=10001 AND data_banks_intradays.instrument_id !=10002 AND data_banks_intradays.instrument_id !=10003

   GROUP BY 1 ) y ON x.PriceRange = y.PriceRange";

            $paidup_data_up = DB::select($sql);
            $paidup_data_up = collect($paidup_data_up)->keyBy('PriceRange');

            ///////////////////////// Paidup up within range END  \\\\\\\\\\\\\\\\\\\\\\\


            ///////////////////////// Paidup total within range START  \\\\\\\\\\\\\\\\\\\\\\\

            $sql = "SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT '0-10' AS PriceRange
    UNION SELECT '10-15'
    UNION SELECT '15-20'
  UNION SELECT '20-30'
  UNION SELECT '30-40'
  UNION SELECT 'over 40' ) x
LEFT JOIN (
   SELECT
      CASE when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 0 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 10 then '0-10'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) >10  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 15 then '10-15'
    when cast(fundamentals.meta_value AS DECIMAL(10,2)) >15  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 20 then '15-20'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) >20  and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 30 then '20-30'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 30 and cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 40 then '30-40'
           when cast(fundamentals.meta_value AS DECIMAL(10,2)) > 40 then 'over 40'
      END AS PriceRange,
      COUNT(*) as TotalWithinRange

     FROM
 data_banks_intradays,fundamentals,metas
 WHERE
 data_banks_intradays.instrument_id=fundamentals.instrument_id   and data_banks_intradays.market_id=$market_id and data_banks_intradays.batch=$batch_id and fundamentals.meta_id=metas.id and fundamentals.is_latest=1 and (metas.meta_key like 'share_percentage_institute')
 and data_banks_intradays.instrument_id !=10001 AND data_banks_intradays.instrument_id !=10002 AND data_banks_intradays.instrument_id !=10003

   GROUP BY 1 ) y ON x.PriceRange = y.PriceRange";

            $paidup_data_total = DB::select($sql);
            $category = array();
            $total = array();

            $sort = array();

            foreach ($paidup_data_total as $row) {
                $category[] = $row->PriceRange . '';
                $total[] = $row->TotalWithinRange;
                $up[] = isset($paidup_data_up[$row->PriceRange]) ? $paidup_data_up[$row->PriceRange]->TotalWithinRange : 0;

                $per = isset($paidup_data_up[$row->PriceRange]) ? round($paidup_data_up[$row->PriceRange]->TotalWithinRange / $row->TotalWithinRange * 100, 2) : 0;
                $sort[$row->PriceRange] = $per;

            }
            arsort($sort);

            $interested_on = array_keys($sort)[0];
            $interested_per = array_values($sort)[0];


            $returnData['category'] = $category;
            $returnData['interested_on'] = $interested_on;
            $returnData['interested_per'] = $interested_per;
            $returnData['total'] = $total;
            $returnData['up'] = $up;


            return $returnData;

        });


        $view->with('category', collect($returnData['category'])->toJson())
            ->with('interested_on', $returnData['interested_on'])
            ->with('interested_per', $returnData['interested_per'])
            ->with('total', collect($returnData['total'])->toJson(JSON_NUMERIC_CHECK))
            ->with('up', collect($returnData['up'])->toJson(JSON_NUMERIC_CHECK));

    }
}