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

class NewsTimeLine
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

        $instrumentInfo=InstrumentRepository::getInstrumentsById(array($instrument_id))->first();
        $instrument_code=$instrumentInfo->instrument_code;

        $height=400;
        if(isset($viewdata['height']))
            $height=$viewdata['height'];



        $newsList=NewsRepository::getAllNewsByInstrumentId($instrument_id)->toArray();

        $news_flags=array();
        $news_flags2=array();
        foreach($newsList as $news)
        {
            $temp=array();
            $temp2=array();

            $date=strtotime($news['post_date']);
            $temp['x']=date('d-m-Y',$date);
            $temp['title']='N';
            // $temp['text']=$news['details'];
            $temp['text']=addslashes($news['details']);

            $formattednews = "";
            $arrstr = str_split($temp['text'], 50);
            foreach ($arrstr as $part) {
                $formattednews .= "$part <br />";
            }
            $temp['text']=$formattednews;


            $newsdetails=$news['details'];

            if (strstr($newsdetails, "(Q1)")) {
                $temp2 = $temp;
                $temp2['title'] = 'Q1';
                $news_flags2[]=$temp2;
            }
            if (strstr($newsdetails, "(H/Y)")) {
                $temp2 = $temp;
                $temp2['title'] = '(H/Y)';
                $news_flags2[]=$temp2;
            }
            if (strstr($newsdetails, "(Q3)")) {
                $temp2 = $temp;
                $temp2['title'] = 'Q3';
                $news_flags2[]=$temp2;

            }
            if (strstr($newsdetails, "intention to sell")) {
                $temp2 = $temp;
                $temp2['title'] = 'Dir Sell';
                $news_flags2[]=$temp2;
            }
            if (strstr($newsdetails, "intention to buy")) {
                $temp2 = $temp;
                $temp2['title'] = 'Dir Buy';
                $news_flags2[]=$temp2;
            }
            $news_flags[]=$temp;

        }

        $corporateActionData=CorporateActionRepository::getCorporateAction($instrument_id);

        foreach($corporateActionData as $ca)
        {
            $temp2=array();

            $date=strtotime($ca['record_date']);
            $temp2['x']=date('d-m-Y',$date);
            $temp2['title']=$ca['action'];
            $temp2['text']=$ca['action'];

            $news_flags2[]=$temp2;
        }

        /*  utf8 needed for json_encode work properly for long text*/
        $news_flags = array_map(function($r) {
            $r['text'] = utf8_encode($r['text']);
            return $r;
        }, $news_flags);

        $news_flags2 = array_map(function($r) {
            $r['text'] = utf8_encode($r['text']);
            return $r;
        }, $news_flags2);

        $view->with('instrument_code', $instrument_code)
            ->with('news_flags', NewsRepository::getAllNewsByInstrumentId($instrument_id)->sortBy('post_date'))
            ->with('news_flags2', $news_flags2)
            ->with('height', $height)
            ->with('renderTo', 'news_chart_div');


    }


}