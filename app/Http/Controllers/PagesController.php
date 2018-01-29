<?php

namespace App\Http\Controllers;
use View;
use \App\DataBanksEod;
use App\Repositories\DataBankEodRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\InstrumentRepository;
use App\Repositories\FundamentalRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\SectorListRepository;
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
        return response()->view('dashboard3', ['trade_date_Info' => $trade_date_Info])
        ->setTtl(60)
        ;
    }

    function upDownStats($allTradeData)
    {

        $up = $allTradeData->filter(function ($value, $key) {
            return $value->price_change_growth > 0;
        });

        $down = $allTradeData->filter(function ($value, $key) {
            return $value->price_change_growth < 0;
        });

        $eq = $allTradeData->filter(function ($value, $key) {
            if ($value->price_change_growth == 0)
                return true;
            else
                return false;

        });

        $returnData = array();
        $returnData['up'] = $up;
        $returnData['down'] = $down;
        $returnData['eq'] = $eq;


        return $returnData;
    }
    public function dashboard2()
    {


        dd(SectorListRepository::getSectorPE([20,16]));
        //dd(SectorListRepository::getSectorPE());

        //dd('hhhh');


     /*   $epsData = Cache::remember("annualized_eps_all_instruments", 1440, function () use ($instrument_arr) {
            $epsData = FundamentalRepository::getAnnualizedEPS($instrument_arr);
            return $epsData;
        });*/



        $metaKey = array("market_lot", "face_value", "net_asset_val_per_share");
        $fundamentaInfo = FundamentalRepository::getFundamentalDataAll($metaKey)->keyBy('instrument_id');
        dd($fundamentaInfo);
        $latestTradeDataAll = DataBanksIntradayRepository::getLatestTradeDataAll();
        $prevMinuteTradeDataAll = DataBanksIntradayRepository::getMinuteAgoTradeDataAll();
        $instrumentTradeData = growthCalculate($latestTradeDataAll, $prevMinuteTradeDataAll, 'price_change', 500);

        $instrumentList = InstrumentRepository::getInstrumentsScripOnly();
        $up = array();
        $down = array();
        $eq = array();
        foreach ($instrumentList as $instrument) {
            $instrument_id = $instrument->id;
            $sector_name = $instrument->sector_list->name;

            if (isset($instrumentTradeData[$instrument_id])) {
                if ($instrumentTradeData[$instrument_id]->price_change_growth > 0) {
                    if (isset($up[$sector_name])) {
                        $up[$sector_name] += 1;
                    } else {
                        $up[$sector_name] = 1;
                    }

                }

                if ($instrumentTradeData[$instrument_id]->price_change_growth < 0) {
                    if (isset($down[$sector_name])) {
                        $down[$sector_name] += 1;
                    } else {
                        $down[$sector_name] = 1;
                    }

                }
                if ($instrumentTradeData[$instrument_id]->price_change_growth == 0) {
                    if (isset($eq[$sector_name])) {
                        $eq[$sector_name] += 1;
                    } else {
                        $eq[$sector_name] = 1;
                    }

                }
            }


        }
        arsort($up);
        arsort($down);
        arsort($eq);


        $category_arr = array();

        foreach ($up as $sector_name => $share_no) {
            $category_arr[$sector_name] = $sector_name;

        }

        foreach ($down as $sector_name => $share_no) {
            $category_arr[$sector_name] = $sector_name;
        }

        foreach ($eq as $sector_name => $share_no) {
            $category_arr[$sector_name] = $sector_name;
        }

        $up_arr = array();
        $down_arr = array();
        $eq_arr = array();
        $category = array();

        foreach ($category_arr as $sector_name) {
            $category[] = $sector_name;
            if (isset($up[$sector_name]))
                $up_arr[] = $up[$sector_name];
            else
                $up_arr[] = 0;

            if (isset($down[$sector_name]))
                $down_arr[] = $down[$sector_name];
            else
                $down_arr[] = 0;

            if (isset($eq[$sector_name]))
                $eq_arr[] = $eq[$sector_name];
            else
                $eq_arr[] = 0;
        }

        dump($category);
        dump($up_arr);
dump($down_arr);
dd($eq_arr);

        /*    $ismatured=InstrumentRepository::isMature(12,'2017-05-07');

           $trade_date_Info=Market::getActiveDates()->first();
           return response()->view('dashboard2', ['trade_date_Info' => $trade_date_Info])->setTtl(1);*/
    }
    public function newsChart($instrument_id=13)
    {
        return View::make("news_chart_page")->with('instrument_id',(int)$instrument_id);
    }

    public function minuteChart($instrument_id=12)
    {

        // cache is working separately for every share. That means minute chart page of 300 share will create 300 cache
        $instrument_id=(int)$instrument_id;
        $instrument_info=InstrumentRepository::getInstrumentsById([$instrument_id])->keyBy('id');
        $instrument_name=ucwords(strtolower($instrument_info[$instrument_id]->name));
        $instrument_code=$instrument_info[$instrument_id]->instrument_code;

        return response()->view('minute_chart_page', ['instrument_id' => (int)$instrument_id,'instrument_name'=>$instrument_name,'instrument_code'=>$instrument_code])->setTtl(60);
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
