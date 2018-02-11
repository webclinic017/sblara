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
class TopSectors
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
        $batch_id=$market_info[0]->data_bank_intraday_batch;
        $batch_id_prev=$market_info[1]->data_bank_intraday_batch;
        $market_id_prev=$market_info[1]->id;



        $sql="SELECT instruments.sector_list_id, sum(data_banks_eods.tradevalues)as sector_total
FROM data_banks_eods,instruments
WHERE data_banks_eods.instrument_id=instruments.id and
data_banks_eods.market_id=$market_id and
instruments.sector_list_id!=4 and
instruments.sector_list_id!=5 and
instruments.sector_list_id!=22 and
instruments.sector_list_id!=23 and
instruments.sector_list_id!=25
GROUP BY instruments.sector_list_id ORDER BY sector_total DESC limit 5";

        $top_sectors_data=DB::select($sql);
        $top_sectors_list=array();
foreach($top_sectors_data as $sector)
{
    $top_sectors_list[]=$sector->sector_list_id;
}


        $view->with('top_sectors_list', $top_sectors_list);
    }
}