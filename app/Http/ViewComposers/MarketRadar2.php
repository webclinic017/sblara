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

class MarketRadar2
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


        ///////////////////////// Paidup total within range END  \\\\\\\\\\\\\\\\\\\\\\\




        ///////////////////////// P/E up within range START  \\\\\\\\\\\\\\\\\\\\\\\

        $sql="SELECT x.PriceRange, COALESCE(TotalWithinRange, 0) AS TotalWithinRange
FROM (
  SELECT '0 to 10' AS PriceRange
  UNION SELECT '10 to 20'
  UNION SELECT '20 to 40'
  UNION SELECT '40 to 60'
  UNION SELECT '60 to 100'
  UNION SELECT 'over 100' ) x
LEFT JOIN (
   SELECT
      CASE when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 0 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 10 then '0 to 10'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 10 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 20 then '10 to 20'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) >20  and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 40 then '20 to 40'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 40 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 60 then '40 to 60'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 60 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 100 then '60 to 100'
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
  UNION SELECT '40 to 60'
  UNION SELECT '60 to 100'
  UNION SELECT 'over 100' ) x
LEFT JOIN (
   SELECT
      CASE when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 0 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 10 then '0 to 10'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 10 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 20 then '10 to 20'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) >20  and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 40 then '20 to 40'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 40 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 60 then '40 to 60'
           when data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) > 60 and data_banks_intradays.close_price/cast(fundamentals.meta_value AS DECIMAL(10,2)) <= 100 then '60 to 100'
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



        ///////////////////////// Category up within range START  \\\\\\\\\\\\\\\\\\\\\\\

        $sql="SELECT data_banks_intradays.quote_bases as PriceRange, count(data_banks_intradays.instrument_id) as TotalWithinRange  FROM
 data_banks_intradays
 WHERE
 data_banks_intradays.batch=$batch_id and data_banks_intradays.close_price -data_banks_intradays.yday_close_price>0
 GROUP BY data_banks_intradays.quote_bases";

        $category_data_up = DB::select($sql);

        ///////////////////////// Category up within range END  \\\\\\\\\\\\\\\\\\\\\\\


        ///////////////////////// Category total within range START  \\\\\\\\\\\\\\\\\\\\\\\

        $sql="SELECT data_banks_intradays.quote_bases as PriceRange, count(data_banks_intradays.instrument_id) as TotalWithinRange  FROM
 data_banks_intradays
 WHERE
 data_banks_intradays.batch=$batch_id
 GROUP BY data_banks_intradays.quote_bases";

        $category_data_total = DB::select($sql);

        ///////////////////////// Category total within range END  \\\\\\\\\\\\\\\\\\\\\\\


        dump($paidup_data_up);
        dump($paidup_data_total);
        dump($pe_data_up);
        dump($pe_data_total);
        dump($category_data_up);
        dump($category_data_total);





        /*
          $view->with('epsData', $epsData)
              ->with('fundaData',$fundaData);*/

    }
}