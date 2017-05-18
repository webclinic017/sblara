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

class NetProfitHistoryChartUpToQuarter
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
        $render_to='net_profit_history_upto_quarter';
        if(isset($viewdata['instrument_id']))
        {
            $instrument_id=$viewdata['instrument_id'];
        }
        if(isset($viewdata['render_to']))
        {
            $render_to=$viewdata['render_to'];
        }

        $metaKey=array("q1_net_prft_aft_tx_cont_op","half_year_net_prft_aft_tx_cont_op","q3_nine_months_net_profit_after_tax","profit_after_tax");
        $fundaData=FundamentalRepository::getFundamentalDataHistory($metaKey,array($instrument_id));

        $start_year_ts=strtotime('2012-01-01');

        foreach($fundaData as $meta_key=>$metaDataForAllInstrument)
        {
            $metaDataForThisIns=$metaDataForAllInstrument->first();
            foreach($metaDataForThisIns as $data)
            {

                if($data->meta_date->timestamp<$start_year_ts)
                    continue;

                $year=$data->meta_date->format('Y');
                $sortedByYear[$year][$meta_key]=$data;
            }

        }
        $sortedByYear=array_reverse($sortedByYear,true);




        $eps_history_per_quarter_data=array();
        foreach($sortedByYear as $year=>$all_data_of_this_year)
        {

            // quaterly data maintaining from 2009. So we are filtering previous year
            if(!isset($all_data_of_this_year['q1_net_prft_aft_tx_cont_op']))
            {
                continue;
            }

            $eps_history_per_quarter_data['category'][]=$year;

            foreach($all_data_of_this_year as $meta_key=>$data)
            {
                $eps_history_per_quarter_data[$meta_key][]=(float)$data['meta_value']+0;
            }

        }



        $view->with('render_to', $render_to)
            ->with('category', collect($eps_history_per_quarter_data['category'])->toJson())
            ->with('q1_net_prft_aft_tx_cont_op',collect($eps_history_per_quarter_data['q1_net_prft_aft_tx_cont_op'])->toJson(JSON_NUMERIC_CHECK))
            ->with('half_year_net_prft_aft_tx_cont_op',collect($eps_history_per_quarter_data['half_year_net_prft_aft_tx_cont_op'])->toJson(JSON_NUMERIC_CHECK))
            ->with('q3_nine_months_net_profit_after_tax',collect($eps_history_per_quarter_data['q3_nine_months_net_profit_after_tax'])->toJson(JSON_NUMERIC_CHECK))
            ->with('profit_after_tax',collect($eps_history_per_quarter_data['profit_after_tax'])->toJson(JSON_NUMERIC_CHECK));




    }
}