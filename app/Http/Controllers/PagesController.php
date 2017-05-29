<?php

namespace App\Http\Controllers;
use View;
use \App\DataBanksEod;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\DataBankEodRepository;
use App\Market;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return response()->view('dashboard', ['trade_date_Info' => $trade_date_Info])->setTtl(1);
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

        $instrument_id=(int)$instrument_id;
        $instrumentInfo=InstrumentRepository::getInstrumentsById(array($instrument_id))->first();

        $tradeInfo=DataBanksIntradayRepository::getMinuteData(array($instrument_id),1)->first()->first();
        $lastTradeInfo=$tradeInfo->first()->first();

        $prevDayTradeInfo=DataBanksIntradayRepository::getYdayMinuteData(array($instrument_id),1)->first()->first();

        $lastFiveDay=DataBanksEod::where('instrument_id',$instrument_id)->select('volume')->orderByDesc('date')->skip(0)->take(5)->get();
        $avgVol=$lastFiveDay->avg('volume');
        $avgVolCompareWithToday=$lastTradeInfo->total_volume-$avgVol;
        $avgVolCompareWithToday=(int) $avgVolCompareWithToday;

        $currentVolDiffThenYday=$lastTradeInfo->total_volume-$prevDayTradeInfo->total_volume;
        $currentVolDiffThenYdayPer=$currentVolDiffThenYday/($lastTradeInfo->total_volume-$prevDayTradeInfo->total_volume)*100;

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
