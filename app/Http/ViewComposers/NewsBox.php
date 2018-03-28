<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\DataBankEodRepository;
use App\Repositories\InstrumentRepository;
use App\Repositories\NewsRepository;
use App\Repositories\CorporateActionRepository;

class NewsBox
{
    /**
     * The index repository implementation.
     *
     * @var IndexRepository
     */

    /**
     * Create a new market_summary composer.
     *
     * @param  IndexRepository  $indexes
     * @return void
     */


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $viewdata= $view->getData();

        $instrument_id=13;
        if(isset($viewdata['instrument_id']))
            $instrument_id=$viewdata['instrument_id'];

        $limit=20;
        if(isset($viewdata['limit']))
            $limit=$viewdata['limit'];

        $show_ads=0;
        if(isset($viewdata['show_ads']))
        {
            $show_ads=(int)$viewdata['show_ads'];
        }


       $allNews=NewsRepository::getAllNewsByInstrumentId($instrument_id)->groupBy('instrument_id');
      //  dd($allNews->toArray());


       $searchKeyArr=array();

        $temp['label']='Q1';
        $temp['search_key']= "Q1";
        $temp['filter_key']= "q1";
        $searchKeyArr[]=$temp;

        $temp['label']='Q2';
        $temp['search_key']= "Q2";
        $temp['filter_key']= "q2";
        $searchKeyArr[]=$temp;

        $temp['label']='Q3';
        $temp['search_key']= "Q3";
        $temp['filter_key']= "q3";
        $searchKeyArr[]=$temp;

        $temp['label']='Sell';
        $temp['search_key']= "sell";
        $temp['filter_key']= "dsell";
        $searchKeyArr[]=$temp;

        $temp['label']='Buy';
        $temp['search_key']= "buy";
        $temp['filter_key']= "dbuy";
        $searchKeyArr[]=$temp;

        $temp['label']='Board';
        $temp['search_key']= "Board of Directors";
        $temp['filter_key']= "bod";
        $searchKeyArr[]=$temp;

        $temp['label']='Dividend';
        $temp['search_key']= "dividend";
        $temp['filter_key']= "dividend";
        $searchKeyArr[]=$temp;

        $allNewsResult=array();

        $foundSearchKey=array();
      foreach($allNews as $oneInstrumentsNews)
      {
          $code=$oneInstrumentsNews->first()->prefix;
          $code = explode(' ', $code);
          $code = $code[0];

          $code = explode('(', $code);
          $code = $code[0];

          $temp['label']=$code;
          $temp['search_key']= "--";
          $temp['filter_key']= "$code";
          $searchKeyArr[]=$temp;
          $foundSearchKey[$temp['filter_key']]=$temp;


          foreach($oneInstrumentsNews->slice(0,$limit) as $news)
          {
              $filter_str="$code ";
              $newsdetails=$news->details;

              foreach($searchKeyArr as $arr)
              {
                  $search_key=$arr['search_key'];
                  $filter_key=$arr['filter_key'];

                  if (strstr($newsdetails, $search_key)) {
                      $filter_str="$filter_str$filter_key ";
                      $foundSearchKey[$filter_key]=$arr;
                  }
              }
              $news['filter_str']=trim($filter_str);
              $allNewsResult[]=$news;
          }

      }

        $allNewsResult=collect($allNewsResult);
        $allNewsResult=$allNewsResult->groupBy('instrument_id');
        //dd($allNews);

        $view->with('allNews', $allNewsResult)
            ->with('instrument_id', $instrument_id)
            ->with('show_ads', $show_ads)
            ->with('searchKeyArr', $foundSearchKey);

    }


}