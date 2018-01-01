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
        $render_to='eps_history_upto_quarter';
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

        $year_end = $fundaData['year_end'];
        unset($fundaData['year_end']);
        foreach ($year_end->first() as $y) {
            if($y->is_latest)
            {
                $year_end_month = Carbon::parse($y->meta_value)->addMonth(3)->format('m');
                break;
            }
            continue;
        }
        $start_year_ts=strtotime('2012-01-01');
        foreach($fundaData as $meta_key=>$metaDataForAllInstrument)
        {
            $metaDataForThisIns=$metaDataForAllInstrument->first();

            foreach($metaDataForThisIns as $data)
            {

                if($data->meta_date->timestamp <$start_year_ts)
                    continue;

                $year=$data->meta_date->format('Y');
                $month=$data->meta_date->format('m');

                if($year_end_month == '09')
                {

                    if($meta_key == 'q1_eps_cont_op' )
                    {
                        $nextYear = $year + 1;
                        $year = "$year - $nextYear"; 
                    }else if($meta_key == 'half_year_eps_cont_op' ){

                        $nextYear = $year + 1;
                        $year = "$year - $nextYear"; 
                    }else if($meta_key == 'q3_nine_months_eps' ){

                        $nextYear = $year - 1;
                        $year = "$nextYear - $year";
                    }else{

                        $nextYear = $year - 1;
                        $year = "$nextYear - $year";

                    }

                        // dump($meta_key);
                        // dump($data->meta_value);
                        // dump($year);
                        // dump($data->meta_date);


                // dump($data->meta_date);
                // dump($year);
                }
                $sortedByYear[$year][$meta_key]=$data;
            }

        }
           // dd($metaDataForAllInstrument);
        $sortedByYear=array_reverse($sortedByYear,true);




        $eps_history_per_quarter_data=array();
        foreach($sortedByYear as $year=>$all_data_of_this_year)
        {

            // quaterly data maintaining from 2009. So we are filtering previous year
            if(!isset($all_data_of_this_year['q1_eps_cont_op']))
            {
                continue;
            }
             if($all_data_of_this_year['q1_eps_cont_op']->meta_date->format('m') != $year_end_month)
            {
                continue;
            }

      
            $eps_history_per_quarter_data['category'][]=$year;

            foreach($all_data_of_this_year as $meta_key=>$data)
            {
                $eps_history_per_quarter_data[$meta_key][]=(float)$data['meta_value']+0;
            }

        }

        if(!isset($eps_history_per_quarter_data['category']))
        {
            $eps_history_per_quarter_data['category'] = [];
        }
        if(!isset($eps_history_per_quarter_data['q1_eps_cont_op']))
        {
            $eps_history_per_quarter_data['q1_eps_cont_op'] = [];
        }

        if(!isset($eps_history_per_quarter_data['q2_eps_cont_op']))
        {
            $eps_history_per_quarter_data['q2_eps_cont_op'] = [];
        }
        if(!isset($eps_history_per_quarter_data['q3_eps_cont_op']))
        {
            $eps_history_per_quarter_data['q3_eps_cont_op'] = [];
        }
        if(!isset($eps_history_per_quarter_data['q4_eps_cont_op']))
        {
            $eps_history_per_quarter_data['q4_eps_cont_op'] = [];
        }
        $view->with('render_to', $render_to)
            ->with('category', collect($eps_history_per_quarter_data['category'])->toJson())
            ->with('q1_eps_cont_op',collect($eps_history_per_quarter_data['q1_eps_cont_op'])->toJson(JSON_NUMERIC_CHECK))
            ->with('half_year_eps_cont_op',collect($eps_history_per_quarter_data['half_year_eps_cont_op'])->toJson(JSON_NUMERIC_CHECK))
            ->with('q3_nine_months_eps',collect($eps_history_per_quarter_data['q3_nine_months_eps'])->toJson(JSON_NUMERIC_CHECK))
            ->with('earning_per_share',collect($eps_history_per_quarter_data['earning_per_share'])->toJson(JSON_NUMERIC_CHECK));




    }
}