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

class DividendHistory
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
        $render_to='dividend_history';
        if(isset($viewdata['instrument_id']))
        {
            $instrument_id= (int) $viewdata['instrument_id'];
        }
        if(isset($viewdata['render_to']))
        {
            $render_to=$viewdata['render_to'];
        }

        $metaKey=array("stock_dividend","cash_dividend");
        $fundaData=FundamentalRepository::getFundamentalDataHistory($metaKey,array($instrument_id));

        $stock_dividend_data=$fundaData['stock_dividend']->first()->sortBy('meta_date');
        $cash_dividend_data=$fundaData['cash_dividend']->first()->sortBy('meta_date');



        $dividend_data=array();
        foreach($stock_dividend_data as $dividend)
        {
            $dividend_data[ (int) $dividend->meta_date->format('Y')]['stock']=abs(floatval($dividend->meta_value));
        }
        foreach($cash_dividend_data as $dividend)
        {
            $dividend_data[(int) $dividend->meta_date->format('Y')]['cash']=abs(floatval($dividend->meta_value));
        }
   //     $dividend_data = collect($dividend_data)->sort();
        ksort($dividend_data);

        $category=array();
        $stock=array();
        $cash=array();
        foreach($dividend_data as $date=>$value)
        {
            $category[]=$date;
            if(isset($value['stock']))
                $stock[]=$value['stock'];
            else
                $stock[]=0;

            if(isset($value['cash']))
                $cash[]=$value['cash'];
            else
                $cash[]=0;

        }
        // dump($category);
        // dump($stock);
        // dd($cash);

        $view->with('category', collect($category)->toJson())
            ->with('render_to', $render_to)
            ->with('stock',collect($stock)->toJson(JSON_NUMERIC_CHECK))
            ->with('cash',collect($cash)->toJson(JSON_NUMERIC_CHECK));

    }
}