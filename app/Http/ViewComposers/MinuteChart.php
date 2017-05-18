<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\InstrumentRepository;
Use App\Market;


class MinuteChart
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */

    public function lastNdaysBullBear($data=array())
    {
        $return=array();

        foreach($data as $market_id=>$dataCollection)
        {

            $bullVolume=0;
            $bearVolume=0;
            $neutralVolume=0;

            $reverse_close_price= $dataCollection->reverse()->pluck('close_price')->toArray();  // 10.30 am fast
            $yday_close_price=$dataCollection->first()->yday_close_price;
            $trade_date=$dataCollection->first()->trade_date->format('Y-m-d');

            array_unshift($reverse_close_price, $yday_close_price); // adding yclose to compare starting volume at 10.30 am

            $reverse_total_volume_diff=$dataCollection->reverse()->pluck('total_volume_difference')->toArray(); // 10:30 minute data first ($close_price[0)

            for($i=0;$i<count($reverse_close_price)-1;$i++)
            {

                if(!isset($reverse_close_price[$i]))
                    continue;

                if(isset($reverse_close_price[$i+1]))
                    $temp=$reverse_close_price[$i+1];
                else
                    $temp=$yday_close_price;

                if($temp<$reverse_close_price[$i]) // if price fall
                {
                    $bearVolume=$bearVolume+$reverse_total_volume_diff[$i];
                }
                if($temp>$reverse_close_price[$i]) // if price increases
                {
                    $bullVolume=$bullVolume+$reverse_total_volume_diff[$i];
                }
                if($temp==$reverse_close_price[$i]) // if price equal
                {
                    $neutralVolume=$neutralVolume+$reverse_total_volume_diff[$i];
                }


            }
            $temp=array();
            $temp['totalBull']=number_format($bullVolume, 0, '.', '');
            $temp['totalBear']=number_format($bearVolume, 0, '.', '');
            $temp['totalNeutral']=number_format($neutralVolume, 0, '.', '');;
            $temp['trade_date']=$trade_date;
            $return[]=$temp;

        }

        return $return;



    }

    public function compose(View $view)
    {

       // date_default_timezone_set('UTC');
        $viewdata= $view->getData();

        $inst_id=(int)$viewdata['instrument_id'];
        $minuteChartData = DataBanksIntradayRepository::getDataForMinuteChart($inst_id,5);
        $instrumentInfo=InstrumentRepository::getInstrumentsById(array($inst_id))->first();

        $chartData=array();
        $chartData['div'] ='mm_div_'.rand(1111,1111111); // required
        $chartData['height'] = 300; // required
        $chartData['title'] = 'name';
        $chartData['instrumentInfo'] = $instrumentInfo;
        $chartData['xcat'] = collect($minuteChartData['date_data'])->toJson();
        //dd(collect($total_volume_data)->toJson());
        $chartData['ydata'] = collect($minuteChartData['volume_data'])->toJson();
        $chartData['xdata'] = collect($minuteChartData['close_data'])->toJson();

        $chartData['price_chart_color'] = $minuteChartData['yday_close_price']<$minuteChartData['cp']?'#26C281':'#D91E18';
        $chartData['trade_date'] = '10-12-8656';
        $chartData['bullBear'] = array_reverse($minuteChartData['bullBear']);
        $chartData['day_total_volume'] = $minuteChartData['day_total_volume'];
        $view->with('chartData', $chartData);
    }


}