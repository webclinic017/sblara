<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use App\Market;
use Illuminate\View\View;
use App\Repositories\IndexRepository;
use App\IndexValue;
use App\Trade;
use DB;

class DsexChart
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

        $viewdata = $view->getData();

        $render_to="dsex_single_chart";
        if (isset($viewdata['render_to'])) {
            $render_to = $viewdata['render_to'];
        }


        $height = 272;
        if (isset($viewdata['height']))
            $height = (int)$viewdata['height'];


        date_default_timezone_set('UTC');
        $indexValues = IndexValue::getWholeDayData($limit = 0, $tradeDate = null, $exchangeId = 0, $instrument_id = 10001);
        // all trade value of last day

        $index_data=array();
        foreach($indexValues as $data)
        {
            $temp = array();
            $temp[] = $data->date_time->timestamp * 1000;
            $temp[] = $data->capital_value;

            $index_data[]=$temp;
        }
        $index_data = collect($index_data)->toJson();


        $tradeDataAll = Trade::getWholeDayData();

        $trade_data = array();
        $xdata = $tradeDataAll->get('trade_value_diff');
        $x_time = $tradeDataAll->pluck('TRD_LM_DATE_TIME')->toArray();

        for ($i = 0; $i < count($xdata); ++$i) {
            //skipping 0 vol
            if (!$xdata[$i])
                continue;

            $temp = array();
            $temp[] = $x_time[$i]->timestamp * 1000;
            $temp[] = $xdata[$i];

            $trade_data[] = $temp;
        }

        $trade_data = collect($trade_data)->toJson();



        // reverse to the default timezone so that it dont cause any problem later
        date_default_timezone_set('asia/dhaka');



        $view->with('index_data', $index_data)
            ->with('trade_data', $trade_data)
            ->with('trade_data', $trade_data)
            ->with('last_index', $indexValues[0]->capital_value)
            ->with('last_index_change', $indexValues[0]->deviation)
            ->with('last_index_change_per', round($indexValues[0]->percentage_deviation,2))
            ->with('render_to', $render_to)
            ->with('height', $height);
    }


}