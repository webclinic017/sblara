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

        $category=array();
        foreach($fundaData['share_percentage_director']->first()->pluck('meta_date') as $meta_date)
        {
            $category[]=$meta_date->format('M,Y');
        }

        $director=$fundaData['share_percentage_director']->first()->pluck('meta_value')->toArray();
        $govt=$fundaData['share_percentage_govt']->first()->pluck('meta_value')->toArray();
        $institute=$fundaData['share_percentage_institute']->first()->pluck('meta_value')->toArray();
        $foreign=$fundaData['share_percentage_foreign']->first()->pluck('meta_value')->toArray();
        $public=$fundaData['share_percentage_public']->first()->pluck('meta_value')->toArray();

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