<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use App\Repositories\SectorIntradayRepository;
use App\Repositories\SectorListRepository;
use Illuminate\View\View;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Market;

class SectorWiseSharePriceListDse
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $market=Market::getActiveDates();
        $market_id= $market[0]->id;
        $data_bank_intraday_batch= $market[0]->data_bank_intraday_batch;

   $sql="SELECT instruments.sector_list_id,
SUM(
    case when (close_price-yday_close_price)/yday_close_price*100>0 and (close_price-yday_close_price)/yday_close_price*100<=2 then 1 else 0 end
) as up_0_to_2,

SUM(
    case when (close_price-yday_close_price)/yday_close_price*100>2 then 1 else 0 end
) as up_over_2,


SUM(
    case when (close_price-yday_close_price)/yday_close_price*100<0 and (close_price-yday_close_price)/yday_close_price*100>=-2 then 1 else 0 end
) as down_0_to_2,

SUM(
    case when (close_price-yday_close_price)/yday_close_price*100<-2 then 1 else 0 end
) as down_over_2,



SUM(
    case when (close_price-yday_close_price)/yday_close_price=0 then 1 else 0 end
) as eq

FROM data_banks_intradays,instruments WHERE
data_banks_intradays.instrument_id=instruments.id and instruments.sector_list_id!=4 and instruments.sector_list_id!=5 and instruments.sector_list_id!=22 and instruments.sector_list_id!=23 and instruments.sector_list_id!=25 and  (data_banks_intradays.batch=$data_bank_intraday_batch) GROUP BY instruments.sector_list_id";


        $sector_up_down_details = \DB::select($sql);

        $sector_up_down_details=collect($sector_up_down_details)->keyBy('sector_list_id');

        //dump($sector_up_down_details);


        $sql="SELECT
    instrument_id,
    close_price,
    yday_close_price,
    high_price,
    low_price,
    total_volume,
    total_value,
    lm_date_time

FROM
(
    SELECT
         instrument_id,
    close_price,
    yday_close_price,
    high_price,
    low_price,
    total_volume,
    total_value,
    lm_date_time,
        @rn := IF(@prev = instrument_id, @rn + 1, 1) AS rn,
        @prev := instrument_id
    FROM data_banks_intradays
    JOIN (SELECT @prev := NULL, @rn := 0) AS vars
    WHERE market_id=$market_id /*and instrument_id!=10001 and instrument_id!=10002 and instrument_id!=10003 and instrument_id!=10001*/
    ORDER BY instrument_id, lm_date_time DESC

) AS T1
WHERE rn <= 15";

        $last_15_minutes_data=\DB::select($sql);
        $last_15_minutes_data=collect($last_15_minutes_data)->groupBy('instrument_id');

       // dump($last_15_minutes_data);

        $instrument_list = InstrumentRepository::getInstrumentsScripOnly()->keyBy('id');
        $instrument_list_grouped_by_sector= $instrument_list->groupBy('sector_list_id');

       // dump($instrument_list);
        $sector_list=SectorListRepository::getSectorList()->keyBy('id');
        //dd($sector_list);

        $view->with('sector_up_down_details', $sector_up_down_details)
            ->with('sector_list', $sector_list)
            ->with('instrument_list', $instrument_list)
            ->with('instrument_list_grouped_by_sector', $instrument_list_grouped_by_sector)
            ->with('last_15_minutes_data', $last_15_minutes_data);


    }
}