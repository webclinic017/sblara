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

class MarketRadarCategory
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $cacheVar = "MarketRadarCategoryData";
        //Cache::forget("$cacheVar");
        $returnData = Cache::remember("$cacheVar", 1, function () {

            $returnData=array();

            $market_info = Market::getActiveDates();
            $batch_id = $market_info[0]->data_bank_intraday_batch;
            $market_id = $market_info[0]->id;


            ///////////////////////// Category up within range START  \\\\\\\\\\\\\\\\\\\\\\\

            $sql = "SELECT data_banks_intradays.quote_bases as PriceRange, count(data_banks_intradays.instrument_id) as TotalWithinRange  FROM
 data_banks_intradays
 WHERE
 data_banks_intradays.batch=$batch_id  and data_banks_intradays.market_id=$market_id and data_banks_intradays.close_price -data_banks_intradays.yday_close_price>0 and
 data_banks_intradays.quote_bases NOT LIKE '%A-CB%' AND
 data_banks_intradays.quote_bases NOT LIKE '%N-EQ%'
 GROUP BY data_banks_intradays.quote_bases";

            $category_data_up = DB::select($sql);

            ///////////////////////// Category up within range END  \\\\\\\\\\\\\\\\\\\\\\\


            ///////////////////////// Category total within range START  \\\\\\\\\\\\\\\\\\\\\\\

            $sql = "SELECT data_banks_intradays.quote_bases as PriceRange, count(data_banks_intradays.instrument_id) as TotalWithinRange  FROM
 data_banks_intradays
 WHERE
 data_banks_intradays.batch=$batch_id  and data_banks_intradays.market_id=$market_id and
 data_banks_intradays.quote_bases NOT LIKE '%A-CB%' and
 data_banks_intradays.quote_bases NOT LIKE '%N-EQ%'
 GROUP BY data_banks_intradays.quote_bases";

            $category_data_total = DB::select($sql);


            $category = array();
            $total = array();

            $sort = array();
            $i = 0;

            foreach ($category_data_total as $row) {
                $category[] = 'Cat: ' . $row->PriceRange;
                $total[] = $row->TotalWithinRange;
                $up[] = isset($category_data_up[$i]) ? $category_data_up[$i]->TotalWithinRange : 0;

                $per = isset($category_data_up[$i]) ? round($category_data_up[$i]->TotalWithinRange / $row->TotalWithinRange * 100, 2) : 0;
                $sort[$row->PriceRange] = $per;
                $i++;
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