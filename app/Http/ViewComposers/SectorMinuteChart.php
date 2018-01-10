<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\SectorListRepository;
use App\Repositories\SectorIntradayRepository;

class SectorMinuteChart
{
    /**
     * The index repository implementation.
     *
     * @var IndexRepository
     */

    /**
     * Create a new market_summary composer.
     *
     * @param  IndexRepository  $indexes
     * @return void
     */


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $viewdata= $view->getData();

        $instrument_id=12;
        if(isset($viewdata['instrument_id']))
            $instrument_id=$viewdata['instrument_id'];

        $height=400;
        if(isset($viewdata['height']))
            $height=$viewdata['height'];

        $sectorList=SectorListRepository::getSectorDetailsByInstrumentId($instrument_id);
        $sector_list_id=$sectorList->first()->id;
        $sector_name=$sectorList->first()->name;

        $returnData=SectorIntradayRepository::getWholeDayData($limit = 0, $tradeDate = null, $exchangeId = 0,$sector_list_id);

        $data = calculateDifference($returnData, 'volume');

        $data=$data->reverse();
        $category=$data->pluck('index_time');
        $volumeData=$data->pluck('volume_difference');

        $indexData=$data->pluck('index_change');
        dump($category);
        $view->with('indexData', collect($indexData)->toJson(JSON_NUMERIC_CHECK))
            ->with('volumeData', collect($volumeData)->toJson(JSON_NUMERIC_CHECK))
            ->with('category', collect($category)->toJson())
            ->with('height', $height)
            ->with('sector_name', $sector_name)
            ->with('renderTo', 'secotr_intraday_div');
    }


}