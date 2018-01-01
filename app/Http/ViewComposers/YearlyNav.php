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

class YearlyNav
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
        $render_to='yearly_nav';
        if(isset($viewdata['instrument_id']))
        {
            $instrument_id= (int) $viewdata['instrument_id'];
        }
        if(isset($viewdata['render_to']))
        {
            $render_to=$viewdata['render_to'];
        }

        $metaKey=array('year_end', "net_asset_val_per_share");
        $fundaData=FundamentalRepository::getFundamentalDataHistory($metaKey,array($instrument_id));
   /**/
   
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
   /**/     
        $start_year_ts=strtotime('2012-01-01');

        foreach($fundaData as $meta_key=>$metaDataForAllInstrument)
        {
            $metaDataForThisIns=$metaDataForAllInstrument->first();
            foreach($metaDataForThisIns as $data)
            {

                if($data->meta_date->timestamp<$start_year_ts)
                    continue;

                $year=$data->meta_date->format('Y');
                if($year_end_month == '09')
                {
                        $nextYear = $year - 1;
                        $year = "$nextYear - $year";  
                }

                $sortedByYear[$year][$meta_key]=$data;
            }

        }
        $sortedByYear=array_reverse($sortedByYear,true);

        $eps_history_per_quarter_data=array();
        foreach($sortedByYear as $year=>$all_data_of_this_year)
        {

            // quaterly data maintaining from 2009. So we are filtering previous year
            if(!isset($all_data_of_this_year['net_asset_val_per_share']))
            {
                continue;
            }

            //if full profit_after_tax found, we are calculating q4_eps_cont_op (as it is missing)


            $eps_history_per_quarter_data['category'][]=$year;

            foreach($all_data_of_this_year as $meta_key=>$data)
            {
                $eps_history_per_quarter_data[$meta_key][]=(float)$data['meta_value']+0;
            }

        }

        $view->with('render_to', $render_to)
            ->with('category', collect($eps_history_per_quarter_data['category'])->toJson())
            ->with('net_asset_val_per_share',collect($eps_history_per_quarter_data['net_asset_val_per_share'])->toJson(JSON_NUMERIC_CHECK));




    }
}