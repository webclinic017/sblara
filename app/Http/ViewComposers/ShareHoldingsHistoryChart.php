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

class ShareHoldingsHistoryChart
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
        $render_to='share_holding_hostory';
        if(isset($viewdata['instrument_id']))
        {
            $instrument_id=(int)$viewdata['instrument_id'];
        }
        if(isset($viewdata['render_to']))
        {
            $render_to=$viewdata['render_to'];
        }

        $metaKey=array("share_percentage_director","share_percentage_govt","share_percentage_institute","share_percentage_foreign","share_percentage_public");

        $fundaData=FundamentalRepository::getFundamentalDataHistory($metaKey,array($instrument_id));

        $sorted_arr=array();

        foreach($fundaData as $key=>$data_arr)
        {
            foreach($data_arr[$instrument_id] as $data)
            {
                $date = $data->meta_date->timestamp;
                $sorted_arr[$date][$key]=$data->meta_value;

            }

        }

        ksort($sorted_arr);

        $category = array();
        $director = array();
        $govt = array();
        $institute = array();
        $foreign = array();
        $public = array();

        foreach($sorted_arr as $timestamp=>$holding_data_of_this_month)
        {

            $category[]= date('M,Y',$timestamp);
            if(isset($holding_data_of_this_month['share_percentage_director']))
            {
                $director[] = $holding_data_of_this_month['share_percentage_director'];
                //sbdump($holding_data_of_this_month['share_percentage_director'], 'afmsohail@gmail.com');
            }else
            {
                $director[] = 0;
            }

            if (isset($holding_data_of_this_month['share_percentage_govt']))
            {
                $govt[] = $holding_data_of_this_month['share_percentage_govt'];
            } else {
                $govt[] = 0;
            }

            if (isset($holding_data_of_this_month['share_percentage_institute'])) {
                $institute[] = $holding_data_of_this_month['share_percentage_institute'];
            } else {
                $institute[] = 0;
            }

            if (isset($holding_data_of_this_month['share_percentage_foreign'])) {
                $foreign[] = $holding_data_of_this_month['share_percentage_foreign'];
            } else {
                $foreign[] = 0;
            }

            if (isset($holding_data_of_this_month['share_percentage_public'])) {
                $public[] = $holding_data_of_this_month['share_percentage_public'];
            } else {
                $public[] = 0;
            }

        }

        //sbdd($public, 'afmsohail@gmail.com');

       // dd($fundaData['share_percentage_director']->first()->pluck('meta_value')->toArray());

        $view->with('render_to', $render_to)
            ->with('category', collect($category)->toJson())
            ->with('director',collect($director)->toJson(JSON_NUMERIC_CHECK))
            ->with('govt',collect($govt)->toJson(JSON_NUMERIC_CHECK))
            ->with('institute',collect($institute)->toJson(JSON_NUMERIC_CHECK))
            ->with('foreign',collect($foreign)->toJson(JSON_NUMERIC_CHECK))
            ->with('public',collect($public)->toJson(JSON_NUMERIC_CHECK));



    }
}