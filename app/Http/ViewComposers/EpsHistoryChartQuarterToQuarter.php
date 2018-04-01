<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\FundamentalRepository;
use Carbon\Carbon;

class EpsHistoryChartQuarterToQuarter
{

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
        $render_to='eps_history_per_quarter';
        if(isset($viewdata['instrument_id']))
        {
            $instrument_id= (int) $viewdata['instrument_id'];
        }
        if(isset($viewdata['render_to']))
        {
            $render_to=$viewdata['render_to'];
        }
   
        //$metaKey=array('year_end', "q1_eps_cont_op","q2_eps_cont_op","q3_eps_cont_op","q3_nine_months_eps","earning_per_share");
        $metaKey=array('year_end', "q1_eps_cont_op","half_year_eps_cont_op","q3_nine_months_eps","earning_per_share");
        $fundaData=FundamentalRepository::getFundamentalDataHistory($metaKey,array($instrument_id));

        $year_end = $fundaData['year_end'][$instrument_id]->where('is_latest',1);
        $year_end=date('M',strtotime($year_end[0]['meta_value']));
        unset($fundaData['year_end']);


        $start_year_ts=strtotime('2012-01-01');

        // creating a
        $sorted_data=array();
        foreach($fundaData as $meta_key=>$metaDataForAllInstrument) {

            $temp=array();
            $metaDataForThisIns=$metaDataForAllInstrument[$instrument_id];
            foreach($metaDataForThisIns as $data){


                $temp['type']=$meta_key;
                $temp['meta_value']=$data['meta_value'];
                $temp['meta_date']=$data['meta_date'];
                $sorted_data[strtotime($data['meta_date'])] = $temp;
            }

        }


        ksort($sorted_data);



        $grouped_data=array();


        foreach($sorted_data as $timestamp=>$data)
        {
            // quaterly data maintaining from 2009. So we are filtering previous year
            if($start_year_ts>$timestamp)
                continue;

            $quarter_period=date('M',$timestamp);
            //$quarter_period_arr[$quarter_period]=$quarter_period;
            $quarter_year=date('Y',$timestamp);
            $grouped_data[$quarter_year][$quarter_period]=$data['meta_value'];

        }
        //$quarter_period_arr=array_keys($quarter_period_arr);

        //dump($grouped_data);          // this value is correct. problem starts from here

        // finding missing data and setting 0


        $quarter_period_arr = array('Mar', 'Jun', 'Sep', 'Dec');


        $grouped_data2=array();
        foreach($grouped_data as $year=>$data_of_this_year)
        {
            $temp=array();


            foreach($quarter_period_arr as $quarter_period)
            {
                if(isset($data_of_this_year[$quarter_period]))
                {
                    $temp[$quarter_period]=floatval($data_of_this_year[$quarter_period]);
                    $non_grouped_data["$year-$quarter_period"] = floatval($data_of_this_year[$quarter_period]);
                }else
                {
                    $temp[$quarter_period]=0; // setting 0 if any period data missing
                    $non_grouped_data["$year-$quarter_period"]=0;
                }
            }

            $grouped_data2[$year]=$temp;


        }

        $all_years=array_keys($grouped_data2);

        array_unshift($all_years,$all_years[0]-1);




        $financial_years=array();

        foreach($all_years as $year)
        {
            $temp=array();

            $year_start=$year."-".date('m-d',strtotime($year_end));
            $year_start="01 $year_end $year_start";
            $year_start=date('Y-m-d',strtotime($year_start));

            $from=Carbon::parse($year_start);


            $q1=$from->addMonths(3)->format("Y-M");
            $q2=$from->addMonths(3)->format("Y-M");
            $q3=$from->addMonths(3)->format("Y-M");
            $q4=$from->addMonths(3)->format("Y-M");

            $temp['q1']=$q1;
            $temp['q2']=$q2;
            $temp['q3']=$q3;
            $temp['q4']=$q4;
            $financial_years[]=$temp;
        }

        $qaurter_to_quarter_data=array();
        foreach($financial_years as $quarter)
        {


            $temp=array();

            if(!isset($non_grouped_data[$quarter['q1']]))
                $non_grouped_data[$quarter['q1']]=0;
            if(!isset($non_grouped_data[$quarter['q2']]))
                $non_grouped_data[$quarter['q2']]=0;
            if(!isset($non_grouped_data[$quarter['q3']]))
                $non_grouped_data[$quarter['q3']]=0;
            if(!isset($non_grouped_data[$quarter['q4']]))
                $non_grouped_data[$quarter['q4']]=0;


            if($non_grouped_data[$quarter['q1']]) {
                $temp['q1'] = $non_grouped_data[$quarter['q1']]; // 1st quarter data
            }else
            {
                $temp['q1'] = 0;
            }

            // if 1st quarter and 2nd quarter both are non zero data
            if($non_grouped_data[$quarter['q1']] && $non_grouped_data[$quarter['q2']])
            {
                $temp['q2']=$non_grouped_data[$quarter['q2']]-$non_grouped_data[$quarter['q1']]; //30 June data quarter to quarter data
            }else
            {
                $temp['q2']=0; //30 June data quarter to quarter = 0
            }

            // if 2nd quarter and 3rd quarter both are non zero data
            if($non_grouped_data[$quarter['q2']] && $non_grouped_data[$quarter['q3']])
            {
                $temp['q3']=$non_grouped_data[$quarter['q3']]-$non_grouped_data[$quarter['q2']]; //30 Sep data quarter to quarter data
            }else
            {
                $temp['q3']=0; //30 Sep data quarter to quarter = 0
            }

            // if 3rd quarter and 4th quarter both are non zero data
            if($non_grouped_data[$quarter['q3']] && $non_grouped_data[$quarter['q4']])
            {
                $temp['q4']=$non_grouped_data[$quarter['q4']]-$non_grouped_data[$quarter['q3']]; //31 Dec data quarter to quarter data
            }else
            {
                $temp['q4']=0; //31 Dec data quarter to quarter = 0
            }

            $cat=explode("-",$quarter['q1'])[0]."-".explode("-",$quarter['q4'])[0];
            $qaurter_to_quarter_data[$cat]=$temp;


        }



        $category=array();

        $quarterly_data_grouped_by_period=array();
        foreach($qaurter_to_quarter_data as $year=>$data_of_this_year)
        {
            $category[]=$year;


            foreach($data_of_this_year as $quarter_period=>$data)
            {
                $quarterly_data_grouped_by_period[$quarter_period][]=$data;
            }


        }
        $label=array_keys($quarterly_data_grouped_by_period);
        $quarterly_data_grouped_by_period=array_values($quarterly_data_grouped_by_period);



        $view->with('render_to', $render_to)
            ->with('category', collect($category)->toJson())
            ->with('quarterly_data_0',collect($quarterly_data_grouped_by_period[0])->toJson(JSON_NUMERIC_CHECK))
            ->with('quarterly_label_0',$label[0])
            ->with('quarterly_data_1',collect($quarterly_data_grouped_by_period[1])->toJson(JSON_NUMERIC_CHECK))
            ->with('quarterly_label_1',$label[1])
            ->with('quarterly_data_2',collect($quarterly_data_grouped_by_period[2])->toJson(JSON_NUMERIC_CHECK))
            ->with('quarterly_label_2',$label[2])
            ->with('quarterly_data_3',collect($quarterly_data_grouped_by_period[3])->toJson(JSON_NUMERIC_CHECK))
            ->with('quarterly_label_3',$label[3]);





    }
}