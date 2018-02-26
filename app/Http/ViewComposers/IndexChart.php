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
use DB;

class IndexChart
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
        date_default_timezone_set('UTC');

        $indexData=IndexRepository::IndexChartData();

        $xArr=array();


        $c=0;
        if(isset($indexData['index']))
        {

            foreach ($indexData['index'] as $indexId => $alldata) {

                $xdata = $alldata['data']->pluck('capital_value')->toArray();
                $x_time = $alldata['data']->pluck('date_time')->toArray();

                for ($i = 0; $i < count($xdata); ++$i) {
                    $temp = array();
                    $temp[] = $x_time[$i]->timestamp * 1000;
                    $temp[] = $xdata[$i];
                    $xArr[$indexId][] = $temp;
                }
                // isset condition. at 10:30 am
                $indexData['index'][$indexId]['last'] = isset($indexData['index'][$indexId]['data'][0]) ? $indexData['index'][$indexId]['data'][0] : 0;
                $indexData['index'][$indexId]['data'] = collect(isset($xArr[$indexId]) ? ($xArr[$indexId]) : [])->toJson();
                $indexData['index'][$indexId]['details']['height'] = 272;


                // setting active tab. 1st tab is active
                if ($c == 2)
                    $indexData['index'][$indexId]['details']['active'] = 'active';
                else
                    $indexData['index'][$indexId]['details']['active'] = '';

                $c++;
            }


            $xVolArr = array();

            if (isset($indexData['trade']))
            {
                $trade_data = $indexData['trade'][0];
                $xdata = $indexData['trade']->get('trade_value_diff');
                $x_time = $indexData['trade']->pluck('TRD_LM_DATE_TIME')->toArray();

                for ($i = 0; $i < count($xdata); ++$i) {
                    //skipping 0 vol
                    if (!$xdata[$i])
                        continue;

                    $temp = array();
                    $temp[] = $x_time[$i]->timestamp * 1000;
                    $temp[] = $xdata[$i];

                    $xVolArr[] = $temp;
                }

                //dd($x_time);

            }



            $xVolArr = collect($xVolArr)->toJson();
            $indexData['trade'] = $xVolArr;


        }else
        {
            // setting empty array for view
            $indexData['index']=array();
        }


        // reverse to the default timezone so that it dont cause any problem later
        date_default_timezone_set('asia/dhaka');



        $view->with('indexData', $indexData);
    }


}