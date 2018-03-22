<?php

namespace App\Http\Controllers;
use View;
use \App\DataBanksEod;
use App\Repositories\DataBankEodRepository;
use App\Repositories\ChartRepository;
use App\Repositories\InstrumentRepository;
use App\Repositories\FundamentalRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\SectorListRepository;
use App\Repositories\FileDataRepository;
use App\Market;
use DB;
use Illuminate\Support\Facades\Storage;

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
        return response()->view('dashboard_new', ['trade_date_Info' => $trade_date_Info])
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


        dd(ChartRepository::getDailySectorData(11,'2017-06-28','2018-02-01'));
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

        if(request()->has('name'))
        {
            $id = request()->name?:'ACI';
            $instrumentInfo = \App\Instrument::where('instrument_code', $id)->first();
            $instrument_id=$instrumentInfo->id;
        }else
        {
            $instrument_id=(int)$instrument_id;
            $instrumentInfo=InstrumentRepository::getInstrumentsById(array($instrument_id))->first();
        }

        $lastTradeInfo=null;


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
        $avgVolCompareWithTodayPer= ($lastTradeInfo->total_volume/ $avgVol)*100;
        $avgVolCompareWithTodayPer=round($avgVolCompareWithTodayPer,2);

        $currentVolDiffThenYday=$lastTradeInfo->total_volume-$prevDayTradeInfo->total_volume;
        $currentVolDiffThenYdayPer = $currentVolDiffThenYday ? $currentVolDiffThenYday / ($prevDayTradeInfo->total_volume) * 100 : 0;
        $currentVolDiffThenYdayPer=round($currentVolDiffThenYdayPer,2);

       // return response()->view('company_details_page', ['instrumentInfo' => $instrumentInfo,'lastTradeInfo' => $lastTradeInfo])->setTtl(60);
        return response()->view('company_details_page',
            [
                'instrumentInfo' => $instrumentInfo,
                'lastTradeInfo' => $lastTradeInfo,
                'avgVol' => $avgVol,
                'avgVolCompareWithToday' => $avgVolCompareWithToday,
                'avgVolCompareWithTodayPer' => $avgVolCompareWithTodayPer,
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
        $category=DB::table('data_banks_intradays')->where('instrument_id',$instrument_id)->select('quote_bases')->orderBy('id')->limit(1)->get();
        $category=category($category[0]);

        //dd(InstrumentRepository::getInstrumentsScripWithIndex());


        return response()->view('fundamental_details_page',
            [
                'instrumentInfo' => $instrumentInfo,
                'category' => $category

            ]
        );
        //)->setTtl(60);

    }


    public function addCdl2crows(&$mainChart,$openData, $highData, $lowData, $closeData)
    {
        $candleFoundArr=trader_cdldoji($openData, $highData, $lowData, $closeData);

        foreach($lowData as $key=>$val)
        {
            if(!isset($candleFoundArr[$key]))
            {
                $candleFoundArr[$key]=1.7E+308;
            }
            if($candleFoundArr[$key])
            {
                $candleFoundArr[$key]=$val;
            }else
            {
                $candleFoundArr[$key]=1.7E+308;
            }
        }


        $buyLayer = $mainChart->addScatterLayer(null, $candleFoundArr, "Cdl 2 Crows", ArrowShape(0, 1, 0.4, 0.4), 11, 0x00ffff);
        # Shift the symbol lower by 20 pixels
        $dataSetObj = $buyLayer->getDataSet(0);
        $dataSetObj->setSymbolOffset(0, 20);

        return $dataSetObj;
    }

    public function rutime($ru, $rus, $index) {
        return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
        -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
    }


public function technicalAnalysisHome()
    {
        $instrument_list=InstrumentRepository::getInstrumentsScripWithIndex();
        $rustart = getrusage();

        //$c = FileDataRepository::get5MinutesUnadjustedData(13, 'o', 1);
        //dump($c);
        //$c = FileDataRepository::get5MinutesUnadjustedData(13, 'h', 1);
        //dump($c);
        //$c = FileDataRepository::get5MinutesUnadjustedData(13, 'l', 1);
        //dump($c);
        //$c = FileDataRepository::get5MinutesUnadjustedData(13, 'c', 1);
        //dump($c);
        $c = FileDataRepository::get5MinutesUnadjustedData(13, 'c', 1);
        dump($c);
        $c = FileDataRepository::get5MinutesUnadjustedData(13, 'd', 1);
        dd($c);

        $t=0;

        foreach($instrument_list as $ins) {

            $instrument_id=$ins->id;
            $o = FileDataRepository::get15MinutesUnadjustedData($instrument_id, 'o', $t);
            $c = FileDataRepository::get15MinutesUnadjustedData($instrument_id, 'h', $t);
            $c = FileDataRepository::get15MinutesUnadjustedData($instrument_id, 'l', $t);
            $c = FileDataRepository::get15MinutesUnadjustedData($instrument_id, 'c', $t);
            $c = FileDataRepository::get15MinutesUnadjustedData($instrument_id, 'v', $t);
            $d = FileDataRepository::get15MinutesUnadjustedData($instrument_id, 'd', $t);

        }
        $ru = getrusage();
        echo "This process used " . $this->rutime($ru, $rustart, "utime") .
            " ms for its computations\n";
        echo "It spent " . $this->rutime($ru, $rustart, "stime") .
            " ms in system calls\n";
        dd($d);



$sql="select instrument_id,open,high,low,close,volume,date
from data_banks_eods
where date >= DATE_SUB(NOW(),INTERVAL 1 YEAR) ORDER BY DATE asc";

        $data=\DB::select($sql);

        $data=collect($data)->groupBy('instrument_id');

        foreach($data as $instrument_id=>$ohlc)
        {
            $o=$ohlc->pluck('open');
            $h=$ohlc->pluck('high');
            $l=$ohlc->pluck('low');
            $c=$ohlc->pluck('close');
            $v=$ohlc->pluck('volume');
            $d=$ohlc->pluck('date');

            //$file = "data/filter/eod/unadjusted/o/$instrument_id.txt";
            $file = "data/filter/eod/unadjusted/$instrument_id/o.txt";
            $csv=$o->implode(',');
            Storage::disk('local')->put($file, $csv);

            $file = "data/filter/eod/unadjusted/$instrument_id/h.txt";
            $csv=$h->implode(',');
            Storage::disk('local')->put($file, $csv);


            $file = "data/filter/eod/unadjusted/$instrument_id/l.txt";
            $csv=$l->implode(',');
            Storage::disk('local')->put($file, $csv);


            $file = "data/filter/eod/unadjusted/$instrument_id/c.txt";
            $csv=$c->implode(',');
            Storage::disk('local')->put($file, $csv);

            $file = "data/filter/eod/unadjusted/$instrument_id/v.txt";
            $csv=$v->implode(',');
            Storage::disk('local')->put($file, $csv);

            $file = "data/filter/eod/unadjusted/$instrument_id/d.txt";
            $csv=$d->implode(',');
            Storage::disk('local')->put($file, $csv);
            //Storage::append($file, $csv);

            
           // $rsi= trader_rsi($c->toArray(), 14);
            

        }

     
        // $instrument_list=InstrumentRepository::getInstrumentsScripWithIndex();
        $instrument_list=collect(['id'=> 88]);
        foreach($instrument_list as $ins)
        {
            $instrument_id=88;

            $file = "data/filter/eod/unadjusted/$instrument_id/o.txt";

            $exists = Storage::disk('local')->exists($file);
            if($exists)
            {
                $contents = Storage::get($file);
                $o=explode(',',$contents);

                $file = "data/filter/eod/unadjusted/$instrument_id/h.txt";
                $contents = Storage::get($file);
                $h=explode(',',$contents);

                $file = "data/filter/eod/unadjusted/$instrument_id/l.txt";
                $contents = Storage::get($file);
                $l=explode(',',$contents);

                $file = "data/filter/eod/unadjusted/$instrument_id/c.txt";
                $contents = Storage::get($file);
                $c=explode(',',$contents);

                $file = "data/filter/eod/unadjusted/$instrument_id/v.txt";
                $contents = Storage::get($file);
                $v=explode(',',$contents);

                $rsi= trader_rsi($c, 14);
                dd($rsi);

            }



        }

        $ru = getrusage();
        echo "This process used " . $this->rutime($ru, $rustart, "utime") .
            " ms for its computations\n";
        echo "It spent " . $this->rutime($ru, $rustart, "stime") .
            " ms in system calls\n";
exit();
        // dd($rsi);

        $rsi= trader_rsi($closeData, 14);  //

//DataBankEodRepository::getEodDataAdjusted(10001,'2017-02-01','2018-02-28');
        $chartData = \App\Repositories\ChartRepository::getAdjustedDailyData(79, '2016-12-01', '2018-02-28');




    $chartData['realtimeStamps'] = array_reverse($chartData['realtimeStamps']);
    $timeStamps = array_reverse($chartData['date']);
    $closeData = array_reverse($chartData['close']);
    $openData = array_reverse($chartData['open']);
    $lowData = array_reverse($chartData['low']);
    $highData = array_reverse($chartData['high']);
    $volData = array_reverse($chartData['volume']);


    //dd($chartData);
        $bop=trader_bop($openData, $highData, $lowData, $closeData);



    // suppose we have 37 data in $closeData . trader_rsi will return 23 data (37-14) . We are using 10 extra point in
    // setData() . So when we will call addLineIndicator with 23 data it will again remove 10 data. So we are re-filling 14 data with null
        $rsi= trader_rsi($closeData, 14);  //
      //  $rsi=array_values($rsi);
    $fill=array_fill(0, 14, 1.7E+308);

    $rsi=array_merge($fill, $rsi);
    //$rsi[13]= 39.021;


    //dump($closeData);
    //dd($rsi);
        //dd($bop);
        require_once(app_path() . '/ChartDirector/FinanceChart.php');
        $m = new \FinanceChart(1260);
        $m->setData($timeStamps, $highData, $lowData, $openData, $closeData, $volData, 10);

    $mainChart=$m->addMainChart(300);

     $m->addCandleStick(0x33ff33, 0xff3333);

     $m->addVolBars(75, 0x99ff99, 0xff9999, 0x808080);


    //$m->addLineIndicator(70, $bop, 0x0000ff, "balance of power");

    $m->addRSI(70, 14, 0x800080, 20, 0xff6666, 0x6666ff);

    //dd($doji);




    if(1)
    {
        $period=10;

        $data=trader_mama($closeData,0.1,0.5);

/*
        $fill=array_fill(0, count($closeData)-count($data), 1.7E+308);
        $data=array_merge($fill, $data);*/

        $fill=array_fill(0, count($closeData)-count($data[0]), 1.7E+308);
        $data[0]=array_merge($fill, $data[0]);

        $fill=array_fill(0, count($closeData)-count($data[1]), 1.7E+308);
        $data[1]=array_merge($fill, $data[1]);

        //dump($closeData);
       // dd($data);


        $m->addLineIndicator2($mainChart, $data[0], 0x6666ff,"u-mama");
        $m->addLineIndicator2($mainChart, $data[1], 0x6666ff,"l-mama");
    }



    $m->addLineIndicator(70, $rsi, 0x0000ff, "custom rsi");

    $tmpArrayMath1 = new \ArrayMath($rsi);
    $rsi_obj=$tmpArrayMath1->result();


    $c = $m->addIndicator(70);
    $label = "RSI (14-sb)";
    $layer = $m->addLineIndicator2($c, $rsi_obj, 0x0000ff, "custom rsi -2");

    $range=20;
    if (($range > 0) && ($range < 50)) {
        $m->addThreshold($c, $layer, 50 + $range, '0xff6666', 50 - $range, '0x6666ff');
    }



        header("Content-type: image/png");
        print($m->makeChart2(PNG));
exit;

        return response()->view('technical-analysis-home',
            [
               /* 'instrumentInfo' => $instrumentInfo,
                'category' => $category*/

            ]
        );
        //)->setTtl(60);

    }



}
