<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
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

        $sector_list_id=1;
        if(isset($viewdata['sector_list_id']))
        $sector_list_id=$viewdata['sector_list_id'];

        $height=400;
        if(isset($viewdata['height']))
            $height=$viewdata['height'];


        $data=SectorIntradayRepository::getWholeDayData()->where('sector_list_id',$sector_list_id);
        $data=$data->reverse();
        $category=$data->pluck('index_time');
        $volumeData=$data->pluck('volume_difference');
        $indexData=$data->pluck('index_change');

        $view->with('indexData', collect($indexData)->toJson(JSON_NUMERIC_CHECK))
            ->with('volumeData', collect($volumeData)->toJson(JSON_NUMERIC_CHECK))
            ->with('category', collect($category)->toJson())
            ->with('height', $height)
            ->with('renderTo', 'secotr_intraday_div');
    }


}