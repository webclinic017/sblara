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
//        Configure::write('debug', 2);

        //  echo "<pre>";
        App::uses('CakeTime', 'Utility');

        $data=Hash::combine($data, '{n}.DataBanksIntraday.lm_date_time', '{n}.DataBanksIntraday','{n}.DataBanksIntraday.trade_date');


        $return=array();


        $StockBangladesh = $this->Components->load('StockBangladesh');


        foreach($data as $trade_date=>$day)
        {

            $bullVolume=0;
            $bearVolume=0;
            $neutralVolume=0;
            $totalBullStrength=0;
            $totalBearStrength=0;

            $total_volume= Hash::extract($day, "{s}.total_volume");
            $reverse_close_price= Hash::extract($day, "{s}.pub_last_traded_price");
            $yday_close_price=array_values($day)[0]['yday_close_price'];

            array_unshift($reverse_close_price, $yday_close_price); // adding yclose to compare starting volume
            $total_volume_diff = $StockBangladesh->calculate_difference(array_reverse($total_volume));
            $reverse_total_volume_diff=array_reverse($total_volume_diff); // 10:30 minute data first ($close_price[0)

            //   print_r($reverse_total_volume_diff);
            //    print_r($reverse_close_price);

            //    exit;
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

                    $price_change=$reverse_close_price[$i]-$temp;
                    $bearStrength=$price_change/$reverse_total_volume_diff[$i];;
                    $totalBearStrength+=$bearStrength;

                }
                if($temp>$reverse_close_price[$i]) // if price increases
                {
                    $bullVolume=$bullVolume+$reverse_total_volume_diff[$i];

                    $price_change=$temp-$reverse_close_price[$i];
                    $bullStrength=$price_change/$reverse_total_volume_diff[$i];;
                    $totalBullStrength+=$bullStrength;
                }
                if($temp==$reverse_close_price[$i]) // if price equal
                {
                    $neutralVolume=$neutralVolume+$reverse_total_volume_diff[$i];
                }


            }
            $temp=array();
            $temp['totalBullStrength']=number_format($bullVolume, 7, '.', '');
            $temp['totalBearStrength']=number_format($bearVolume, 7, '.', '');
            $temp['totalNeutralStrength']=$neutralVolume;

            /*$temp['totalBullStrength']=$bullVolume;
            $temp['totalBearStrength']=$bearVolume;
            $temp['totalNeutralStrength']=$neutralVolume;*/


            $temp['trade_date']=$trade_date;


            $return[]=$temp;

        }

        //  print_r($return);
        //   print_r($data);
        //   exit;
        return $return;



    }

    public function compose(View $view)
    {
        $instrumentsIdArr=array(12);
        $activeDate = Market::getActiveDates(5);
        $marketId=$activeDate->pluck('id');
        unset($marketId[0]);
        dd($marketId->toArray());
        $d=DataBanksIntradayRepository::getMinuteDataByMarketId($marketId,$instrumentsIdArr);
        dd($d->toArray());

        date_default_timezone_set('UTC');
        $this->test();

        $intradayData=DataBanksIntradayRepository::getMinuteData($instrumentsIdArr,0)->first();

        $close_price=$intradayData->pluck('close_price')->toArray();
        $dateTime=$intradayData->pluck('lm_date_time')->toArray();
        $total_volume_diff=$intradayData->pluck('total_volume_difference')->toArray();
        $trade_time=$intradayData->pluck('trade_time')->toArray();
        //dd($trade_time);

        $total_volume_data=array();
        $close_data=array();
        $date_data=array();

        $no_of_bar=count($close_price)-2;

        for($i=$no_of_bar;$i>=0;--$i)
        {
            if(!isset($close_price[$i]))
                continue;

            $temp=array();



            if($close_price[$i+1]>$close_price[$i]) // if price fall
            {
                $temp['color']='#EF4836';
            }
            if($close_price[$i+1]<$close_price[$i]) // if price increases
            {
                $temp['color']='#1BA39C';
            }
            if($close_price[$i+1]==$close_price[$i]) // if price equal
            {
                $temp['color']='#ACB5C3';
            }

            $temp['y']=$total_volume_diff[$i];
            $total_volume_data[]=$temp;

            $temp['y']=$close_price[$i]+0;
            $close_data[]=$temp;

            $date_data[]=$dateTime[$i]->timestamp*1000;

        }


        $bullVolume=0;
        $bearVolume=0;
        $neutralVolume=0;
        $totalBullStrength=0;
        $totalBearStrength=0;
        $yday_close_price=$intradayData->first()->yday_close_price;
        $cp=$intradayData->first()->close_price;
        $day_total_volume=$intradayData->last()->total_volume;

        // we are taking data as usual. from 0
        $reverse_close_price=array_reverse($close_price); // 10:30 minute data first ($close_price[0)
        array_unshift($reverse_close_price, $yday_close_price); // adding yclose to compare starting volume
        $reverse_total_volume_diff=array_reverse($total_volume_diff); // 10:30 minute data first ($close_price[0)


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

                $price_change=$reverse_close_price[$i]-$temp;
                $bearStrength=$price_change/$reverse_total_volume_diff[$i];;
                $totalBearStrength+=$bearStrength;

            }
            if($temp>$reverse_close_price[$i]) // if price increases
            {
                $bullVolume=$bullVolume+$reverse_total_volume_diff[$i];

                $price_change=$temp-$reverse_close_price[$i];
                $bullStrength=$price_change/$reverse_total_volume_diff[$i];;
                $totalBullStrength+=$bullStrength;
            }
            if($temp==$reverse_close_price[$i]) // if price equal
            {
                $neutralVolume=$neutralVolume+$reverse_total_volume_diff[$i];
            }


        }

        //$instrumentInfo=$StockBangladesh->instrumentInfo($instrumentId);

        $chartData=array();
        $chartData['div'] ='mm_div_'.rand(1111,1111111); // required
        $chartData['height'] = 300; // required
        $chartData['title'] = 'name';
        $chartData['instrument_code'] = 'code';
        $chartData['xcat'] = $date_data;
        $chartData['ydata'] = json_encode($total_volume_data);
        $chartData['xdata'] = json_encode($close_data);
        $chartData['volume_high'] = max(array_slice($total_volume_diff,0, $no_of_bar,true));
        $chartData['volume_low'] = min(array_slice($total_volume_diff,0, $no_of_bar,true));

        if(!empty($close_price)) {
            $chartData['price_high'] = max(array_slice($close_price, 0, $no_of_bar, true));
            $chartData['price_low'] = min(array_slice($close_price, 0, $no_of_bar, true));
        }else
        {
            $chartData['price_high'] = 0;
            $chartData['price_low'] = 0;
        }
        $chartData['price_chart_color'] = $yday_close_price<$cp?'#26C281':'#D91E18';
        $chartData['trade_date'] = '10-12-8656';
        $chartData['bullVolume'] = $bullVolume;
        $chartData['bearVolume'] = $bearVolume;
        $chartData['neutralVolume'] = $neutralVolume;
        $chartData['totalBullStrength'] = number_format($totalBullStrength, 7, '.', '');
        $chartData['totalBearStrength'] = number_format($totalBearStrength, 7, '.', '');
        $chartData['day_total_volume'] = $day_total_volume;
        $chartData['last5daysBullBearStrength'] = $last5daysBullBearStrength;





        /* $c=0;
         foreach($indexData['index'] as $indexId=>$alldata)
         {


             for($i=0;$i<count($xdata);++$i)
             {
                 $temp=array();
                 $temp[]=$x_time[$i]->timestamp*1000;
                 $temp[]=$xdata[$i];
                 $xArr[$indexId][]=$temp;
             }

             $indexData['index'][$indexId]['data']=collect($xArr[$indexId])->toJson();
             $indexData['index'][$indexId]['details']['height']=300;

             // setting active tab. 1st tab is active
             if($c==0)
                  $indexData['index'][$indexId]['details']['active']='active';
             else
                 $indexData['index'][$indexId]['details']['active']='';

             $c++;
         }



         $xVolArr=array();
         $xdata=$indexData['trade']->get('trade_value_diff');
         $x_time=$indexData['trade']->pluck('TRD_LM_DATE_TIME')->toArray();

         for($i=0;$i<count($xdata);++$i)
         {

             $temp=array();
             $temp[]=$x_time[$i]->timestamp*1000;
             $temp[]=$xdata[$i];

             $xVolArr[]=$temp;
         }

         //dd($x_time);

         $xVolArr=collect($xVolArr)->toJson();
         $indexData['trade']=$xVolArr;*/


        // reverse to the default timezone so that it dont cause any problem later
        date_default_timezone_set('asia/dhaka');
        $view->with('indexData', '');
    }


}