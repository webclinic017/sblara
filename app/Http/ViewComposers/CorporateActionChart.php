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

class CorporateActionChart 
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
        $instrument_id=(int)$viewdata['instrument_id'];

        $instrumentInfo=InstrumentRepository::getInstrumentsById(array($instrument_id))->first();
        $instrument_code=$instrumentInfo->instrument_code;

        $height=400;
        if(isset($viewdata['height']))
            $height=$viewdata['height'];


        $from='2007-01-01';
        $to=date('Y-m-d');

        // return data asc. This is needed for highchart candle. Otherwise candle chart will not be shown
        $data=DataBankEodRepository::getEodDataAsc($instrument_id,$from,$to);

        $ohlc=array();
        $volume=array();
        for($i=0;$i<count($data['t']);++$i)
        {

            $temp=array();
            $temp[]=$data['t'][$i]*1000;
            $temp[]=$data['o'][$i];
            $temp[]=$data['h'][$i];
            $temp[]=$data['l'][$i];
            $temp[]=$data['c'][$i];
            $ohlc[]=$temp;

            $voltemp=array();
            $voltemp[]=$data['t'][$i]*1000;
            $voltemp[]=$data['v'][$i];
            $volume[]=$voltemp;
        }
        $newsList=NewsRepository::getAllNewsByInstrumentId($instrument_id)->toArray();

        $news_flags=array();
        $news_flags2=array();
        foreach($newsList as $news)
        {
            $temp=array();
            $temp2=array();

            $date=strtotime($news['post_date'])*1000;
            $temp['x']=$date;
            $temp['title']='N';
            // $temp['text']=$news['details'];
            $temp['text']=addslashes($news['details']);

        }

        $corporateActionData=CorporateActionRepository::getCorporateAction($instrument_id);

        foreach($corporateActionData as $ca)
        {
            $temp2=array();

            $date=strtotime($ca['record_date'])*1000 ;

            $temp2['x']=$date;
            $temp2['title']=$ca['action'];

            switch ($temp2['title']) {
                case 'stockdiv':
                    $temp2['title'] = 'Stock Dividend';
                    break;

                case 'cashdiv':
                    $temp2['title'] = 'Cash Dividend';
                    break;

                case 'split':
                    $temp2['title'] = 'Split';
                    break;

                case 'rightshare':
                    $temp2['title'] = 'Right Share';
                    break;
            }
            $temp2['text']=$temp2['title'];            

            $news_flags2[]=$temp2;
        }

        /*  utf8 needed for json_encode work properly for long text*/

        $news_flags2 = array_map(function($r) {
            $r['text'] = utf8_encode($r['text']);
            return $r;
        }, $news_flags2);


        $view->with('ohlc', collect($ohlc)->toJson(JSON_NUMERIC_CHECK))
            ->with('volume', collect($volume)->toJson(JSON_NUMERIC_CHECK))
            ->with('instrument_code', $instrument_code)
            ->with('news_flags2', json_encode($news_flags2))
            ->with('height', $height)
            ->with('renderTo', 'news_chart_div');
    }


}