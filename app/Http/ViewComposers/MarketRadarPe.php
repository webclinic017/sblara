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

class MarketRadarPe
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


        ///////////////////////// P/E up within range START  \\\\\\\\\\\\\\\\\\\\\\\

        $sql = "SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT '0 to 10' AS PriceRange
  UNION SELECT '10 to 20'
  UNION SELECT '20 to 40'
  UNION SELECT '40 to 100'
  UNION SELECT 'over 100' ) x
LEFT JOIN (
   SELECT
      CASE when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 0 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 10 then '0 to 10'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 10 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 20 then '10 to 20'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) >20  and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 40 then '20 to 40'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 40 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 100 then '40 to 100'
           else 'over 100'
      END AS PriceRange,
      COUNT(*) as TotalWithinRange

     FROM
 data_banks_intradays,fundamentals,metas
 WHERE
 data_banks_intradays.instrument_id=fundamentals.instrument_id and data_banks_intradays.batch=$batch_id and fundamentals.meta_id=metas.id and fundamentals.is_latest=1 and (metas.meta_key like 'earning_per_share') and data_banks_intradays.close_price -data_banks_intradays.yday_close_price>0

   GROUP BY 1 ) y ON x.PriceRange = y.PriceRange";

        $pe_data_up = DB::select($sql);

        ///////////////////////// P/E up within range END  \\\\\\\\\\\\\\\\\\\\\\\

        ///////////////////////// P/E total within range START  \\\\\\\\\\\\\\\\\\\\\\\

        $sql = "SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT '0 to 10' AS PriceRange
  UNION SELECT '10 to 20'
  UNION SELECT '20 to 40'
  UNION SELECT '40 to 100'
  UNION SELECT 'over 100' ) x
LEFT JOIN (
   SELECT
      CASE when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 0 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 10 then '0 to 10'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 10 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 20 then '10 to 20'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) >20  and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 40 then '20 to 40'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 40 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 100 then '40 to 100'
           else 'over 100'
      END AS PriceRange,
      COUNT(*) as TotalWithinRange

     FROM
 data_banks_intradays,fundamentals,metas
 WHERE
 data_banks_intradays.instrument_id=fundamentals.instrument_id and data_banks_intradays.batch=$batch_id and fundamentals.meta_id=metas.id and fundamentals.is_latest=1 and (metas.meta_key like 'earning_per_share')

   GROUP BY 1 ) y ON x.PriceRange = y.PriceRange";

        $pe_data_total = DB::select($sql);

        ///////////////////////// P/E down within range END  \\\\\\\\\\\\\\\\\\\\\\\



        $category=array();
        $total=array();

        $sort=array();
        $i=0;
        foreach($pe_data_total as $row)
        {
            $category[]= ''.$row->PriceRange;
            $total[]=$row->TotalWithinRange;
            $up[] = $pe_data_up[$i]->TotalWithinRange;

            $per= round($pe_data_up[$i]->TotalWithinRange / $row->TotalWithinRange * 100, 2);
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