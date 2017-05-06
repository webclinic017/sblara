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

class HomePageIndexChart
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
        //date_default_timezone_set('UTC');

        $indexData=IndexRepository::IndexChartData();
        $xArr=array();
        $dsex=$indexData['index'][10001]['data']->pluck('capital_value');
        $timeObj=$indexData['index'][10001]['data']->pluck('date_time');
        $time=array();
        foreach($timeObj as $obj)
        {
            $time[]=$obj->format('h:i');
        }

       // dd($indexData['index'][10001]['data']);
        $tradeData=$indexData['trade']->get('trade_value_diff');
//dd($time);
        $view->with('dsex', collect($dsex)->toJson(JSON_NUMERIC_CHECK))
            ->with('time', collect($time)->toJson())
            ->with('tradeData', collect($tradeData)->toJson(JSON_NUMERIC_CHECK));
    }


}