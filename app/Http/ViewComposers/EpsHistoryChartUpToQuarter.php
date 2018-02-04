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

class EpsHistoryChartUpToQuarter
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
        $metaKey=array('year_end', "q1_eps_cont_op","half_year_eps_cont_op","q3_nine_months_eps","earning_per_share");
        $fundaData=FundamentalRepository::getFundamentalDataHistory($metaKey,array($instrument_id));

        $year_end = $fundaData['year_end'][$instrument_id]->where('is_latest',1);
        $year_end=date('d-M',strtotime($year_end[0]['meta_value']));
        unset($fundaData['year_end']);

        $start_year_ts=strtotime('2012-01-01');

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


        if($year_end=='30-Jun')
        {
            $quarter_period_arr=array('30-Sep','31-Dec','31-Mar','30-Jun');
        }

        if($year_end=='30-Sep')
        {
            $quarter_period_arr=array('31-Dec','31-Mar','30-Jun','30-Sep');
        }

        if($year_end=='31-Dec')
        {
            $quarter_period_arr=array('31-Mar','30-Jun','30-Sep','31-Dec');
        }
        if($year_end=='31-Mar')
        {
            $quarter_period_arr=array('30-Jun','30-Sep','31-Dec','31-Mar');
        }


        foreach($sorted_data as $timestamp=>$data)
        {
            // quaterly data maintaining from 2009. So we are filtering previous year
            if($start_year_ts>$timestamp)
                continue;

            $quarter_period=date('d-M',$timestamp);
            //$quarter_period_arr[$quarter_period]=$quarter_period;
            $quarter_year=date('Y',$timestamp);
            $grouped_data[$quarter_year][$quarter_period]=$data['meta_value'];
        }

//        dump($grouped_data);
        $category=array();

        $quarterly_data_grouped_by_period=array();
        foreach($grouped_data as $year=>$data_of_this_year)
        {
            $category[]=$year;


            foreach($quarter_period_arr as $quarter_period)
            {
                if(isset($data_of_this_year[$quarter_period]))
                {
                    $quarterly_data_grouped_by_period[$quarter_period][]=$data_of_this_year[$quarter_period];
                }else
                {
                    $quarterly_data_grouped_by_period[$quarter_period][]=0;
                }
            }


        }
        $label=array_keys($quarterly_data_grouped_by_period);
        $quarterly_data_grouped_by_period=array_values($quarterly_data_grouped_by_period);
//        dd($quarterly_data_grouped_by_period);

       /* dump($sorted_data);
        dump($category);
        dd($quarterly_data_grouped_by_period);*/


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