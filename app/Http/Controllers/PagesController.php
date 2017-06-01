<?php

namespace App\Http\Controllers;
use View;
use \App\DataBanksEod;
use App\Repositories\DataBankEodRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Market;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data()
    {

        $d = DB::select("select * from `data_banks_eods` where `date` between '2017-05-30' and '2017-05-31' order by `date` desc");

        //dump(DataBankEodRepository::getPluginEodDataAll('2017-05-29', '2017-06-30', 0));
return $d;

    }
    public function dashboard()
    {

        $d= DB::select("select * from `data_banks_eods` where `date` between '2017-05-30' and '2017-05-31' order by `date` desc");

        dump(DataBankEodRepository::getPluginEodDataAll('2017-05-29', '2017-06-30', 0));

        //getPluginEodDataAll($from,$to,$adjusted=1,$instrumentCodeArr=array())
       /* dd(DataBankEodRepository::getPluginEodDataAll('2017-04-20','2017-05-30',0,array('ABBANK','ACI')));
        dd(DataBankEodRepository::getPluginEodDataAdjusted('ABBANK','2016-10-10','2017-05-30',0));
        dd(DataBanksIntradayRepository::getIntraForPlugin('ABBANK',0,15));*/
       /* $latestTradeDataAll=DataBanksIntradayRepository::getLatestTradeDataAll();
        $prevMinuteTradeDataAll=DataBanksIntradayRepository::getMinuteAgoTradeDataAll();
        $return=growthCalculate($latestTradeDataAll,$prevMinuteTradeDataAll,'close_price',500);
        //dd($return->toArray());
        dump($latestTradeDataAll->where('instrument_id',128)->toArray());
        dd($prevMinuteTradeDataAll->where('instrument_id',128)->toArray());*/

        $trade_date_Info=Market::getActiveDates()->first();
        return response()->view('dashboard', ['trade_date_Info' => $trade_date_Info])->setTtl(1);
    }
    public function dashboard2()
    {
        $sql = "SELECT *
FROM  dsbp_posts
INNER JOIN dsbp_postmeta ON dsbp_postmeta.post_id = dsbp_posts.id
WHERE  dsbp_posts.post_status LIKE  'publish'
AND  dsbp_postmeta.meta_key LIKE  '_thumbnail_id'
ORDER BY  dsbp_posts.post_date DESC
LIMIT 0 , 5";

        $result = DB::connection('dsb')->select($sql);


        $allNews = array();
        $liveNews = array();
        foreach ($result as $row) {
            $post_id = $row->ID;
            dd($post_id);
            $temp = array();
            $thumbnail_post_id = $row->meta_value;
            $tsql = "SELECT id,guid  FROM dsbp_posts WHERE id=$thumbnail_post_id";
            //$thumbArr = $db->get_results($tsql);
            //$taxsql="SELECT *  FROM dsbp_term_relationships WHERE object_id=$post_id";
            $taxsql = "SELECT * FROM dsbp_term_relationships INNER JOIN dsbp_terms ON dsbp_terms.term_id = dsbp_term_relationships.term_taxonomy_id WHERE dsbp_term_relationships.object_id=$post_id;";
            $taxonomyArr = $db->get_results($taxsql);
            //     $db->debug();
            $tagArr = array();
            foreach ($taxonomyArr as $tax) {
                $tagArr[] = $tax->name;
            }
            //  $db->debug();
            $temp['post_id'] = $post_id;
            $temp['post_date'] = $row->post_date;
            $temp['guid'] = $row->guid;
            $temp['post_content'] = $row->post_content;
            $temp['post_title'] = $row->post_title;
            $temp['thmbnail'] = $thumbArr[0]->guid;
            $temp['taxonomy'] = $tagArr;
            $liveNews[] = $temp;

        }



        $trade_date_Info=Market::getActiveDates()->first();
        return response()->view('dashboard2', ['trade_date_Info' => $trade_date_Info])->setTtl(1);
    }
    public function newsChart($instrument_id=13)
    {
        return View::make("news_chart_page")->with('instrument_id',(int)$instrument_id);
    }

    public function minuteChart($instrument_id=12)
    {

        // cache is working separately for every share. That means minute chart page of 300 share will create 300 cache
        return response()->view('minute_chart_page', ['instrument_id' => (int)$instrument_id])->setTtl(60);
        //return View::make("minute_chart_page")->with('instrument_id',(int)$instrument_id);

    }
    public function companyDetails($instrument_id=13)
    {

        $lastTradeInfo=null;
        $instrument_id=(int)$instrument_id;
        $instrumentInfo=InstrumentRepository::getInstrumentsById(array($instrument_id))->first();

        $lastTradeInfo=DataBanksIntradayRepository::getMinuteData(array($instrument_id),1);

        $prevDayTradeInfo=DataBanksIntradayRepository::getYdayMinuteData(array($instrument_id),1)->first()->first();
        if(count($lastTradeInfo))
            $lastTradeInfo=$lastTradeInfo->first()->first();
        else
        {
            $lastTradeInfo=$prevDayTradeInfo;

        }

        $lastFiveDay=DataBanksEod::where('instrument_id',$instrument_id)->select('volume')->orderByDesc('date')->skip(0)->take(5)->get();
        $avgVol=$lastFiveDay->avg('volume');
        $avgVolCompareWithToday=$lastTradeInfo->total_volume-$avgVol;
        $avgVolCompareWithToday=(int) $avgVolCompareWithToday;

        $currentVolDiffThenYday=$lastTradeInfo->total_volume-$prevDayTradeInfo->total_volume;
        $currentVolDiffThenYdayPer=$currentVolDiffThenYday?$currentVolDiffThenYday/($currentVolDiffThenYday)*100:0;

       // return response()->view('company_details_page', ['instrumentInfo' => $instrumentInfo,'lastTradeInfo' => $lastTradeInfo])->setTtl(60);
        return response()->view('company_details_page',
            [
                'instrumentInfo' => $instrumentInfo,
                'lastTradeInfo' => $lastTradeInfo,
                'avgVol' => $avgVol,
                'avgVolCompareWithToday' => $avgVolCompareWithToday,
                'currentVolDiffThenYday' => $currentVolDiffThenYday,
                'currentVolDiffThenYdayPer' => $currentVolDiffThenYdayPer
            ]
        );
        //)->setTtl(60);

    }
    public function fundamentalDetails($instrument_id=13)
    {

        $instrument_id=(int)$instrument_id;
        $instrumentInfo=InstrumentRepository::getInstrumentsById(array($instrument_id))->first();

        //dd(InstrumentRepository::getInstrumentsScripWithIndex());


        return response()->view('fundamental_details_page',
            [
                'instrumentInfo' => $instrumentInfo

            ]
        );
        //)->setTtl(60);

    }



}
