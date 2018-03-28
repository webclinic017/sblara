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
            $instrument_id=(int)$viewdata['instrument_id'];

        $show_ads=0;
        if(isset($viewdata['show_ads']))
        {
            $show_ads=(int)$viewdata['show_ads'];
        }


        $height=400;
        if(isset($viewdata['height']))
            $height=$viewdata['height'];

        $sector_list_id=0;
        if(isset($viewdata['sector_list_id']))
            $sector_list_id=(int)$viewdata['sector_list_id'];

        if($sector_list_id)
        {

            $sectorList=SectorListRepository::getSectorList();
            $sectorList=$sectorList->keyBy('id');
            $sector_name=$sectorList[$sector_list_id]->name;
            $sector_name=str_replace('&','And',$sector_name);

        }else
        {
            $sectorList=SectorListRepository::getSectorDetailsByInstrumentId($instrument_id);
            $sector_list_id=$sectorList->first()->id;
            $sector_name=$sectorList->first()->name;
            $sector_name=str_replace('&','And',$sector_name);
        }


        $returnData=SectorIntradayRepository::getWholeDayData($limit = 0, $tradeDate = null, $exchangeId = 0,$sector_list_id);

        $data = calculateDifference($returnData, 'volume');

        $data=$data->reverse();
        $category=$data->pluck('index_time');
        $volumeData=$data->pluck('volume_difference');

        $indexData=$data->pluck('index_change');
        $render="secotr_intraday_div_$instrument_id".rand(10,1000);
        //dump($category);
        $view->with('indexData', collect($indexData)->toJson(JSON_NUMERIC_CHECK))
            ->with('volumeData', collect($volumeData)->toJson(JSON_NUMERIC_CHECK))
            ->with('category', collect($category)->toJson())
            ->with('height', $height)
            ->with('show_ads', $show_ads)
            ->with('sector_name', $sector_name)
            ->with('renderTo', $render);
    }


}