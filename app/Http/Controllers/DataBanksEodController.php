<?php

namespace App\Http\Controllers;

use App\DataBanksEod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use View;
use App\Repositories\InstrumentRepository;
use App\Repositories\ChartRepository;
use App\Repositories\FundamentalRepository;
//use App\ChartDirector\FinanceChart;

class DataBanksEodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataBanksEod  $dataBanksEod
     * @return \Illuminate\Http\Response
     */
    public function show(DataBanksEod $dataBanksEod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataBanksEod  $dataBanksEod
     * @return \Illuminate\Http\Response
     */
    public function edit(DataBanksEod $dataBanksEod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataBanksEod  $dataBanksEod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataBanksEod $dataBanksEod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataBanksEod  $dataBanksEod
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataBanksEod $dataBanksEod)
    {
        //
    }

   // public function chart_img_trac(Request $request,$reportrange = "", $instrumentCode = 'DSEX', $comparewith = 'ABBANK', $Indicators = "RSI,MACD", $configure = "VOLBAR", $charttype = "CandleStick", $overlay = "BB", $mov1 = "SMA",$avgPeriod1=20, $mov2 = "SMA",$avgPeriod2=30,$adj=1)
    public function chart_img_trac(Request $request)
    {

        //$path=public_path('metronic_custom/chart_director/lib/FinanceChart.php');
        //File::requireOnce($path);
        include(app_path() . '\ChartDirector\FinanceChart.php');


        $instrumentCode = $request->input('instrumentCode','ABBANK');
        $Indicators = $request->input('Indicators','RSI,MACD');
        $configure = $request->input('configure','VOLBAR');
        $charttype = $request->input('charttype','CandleStick');
        $overlay = $request->input('overlay','BB');
        $mov1 = $request->input('mov1','SMA');
        $avgPeriod1 = $request->input('avgPeriod1',20);
        $mov2 = $request->input('mov2','SMA');
        $avgPeriod2 = $request->input('avgPeriod2',30);
        $adj = $request->input('adj',1);



        $instrumentCode = $request->input('instrumentCode','DSEX');
        $cacheVar = "chartData$instrumentCode";

        $chartData = Cache::remember("$cacheVar", 1, function () use($request){

            $reportrange = $request->input('reportrange');
            if ($reportrange == '') {
                $from = date('Y-m-d', strtotime(' -120 days'));
                $to = date('Y-m-d');
            } else {
                $datearr = explode('|', $reportrange);
                $from = $datearr[0];
                $to = $datearr[1];
            }

            $instrumentCode = $request->input('instrumentCode','ABBANK');
            $Indicators = $request->input('Indicators','RSI,MACD');
            $configure = $request->input('configure','VOLBAR');
            $charttype = $request->input('charttype','CandleStick');
            $overlay = $request->input('overlay','BB');
            $mov1 = $request->input('mov1','SMA');
            $avgPeriod1 = $request->input('avgPeriod1',20);
            $mov2 = $request->input('mov2','SMA');
            $avgPeriod2 = $request->input('avgPeriod2',30);
            $adj = $request->input('adj',1);


            $width = 1230; $mainHeight = 320; $indicatorHeight = 90; $extraPoints = null;
            $timeStamps = null; $volData = null; $highData = null; $lowData = null; $openData = null; $closeData = null;

            $instrumentCodeArr=array();
            $instrumentCodeArr[]=$instrumentCode;

            $instrumentInfo=InstrumentRepository::getInstrumentsByCode($instrumentCodeArr)->first();
            $instrumentId = $instrumentInfo->id;



            $extraPoints = 19;

            if ($avgPeriod1 > $extraPoints) {

                $extraPoints = $avgPeriod1;

            }

            if ($avgPeriod2 > $extraPoints) {

                $extraPoints = $avgPeriod2;

            }

            $ohlcData = ChartRepository::getAdjustedDailyData($instrumentId,$from,$to,21);

            if ($adj)
                $ohlcData = ChartRepository::getAdjustedDailyData($instrumentId,$from,$to,$extraPoints);

            else
                $ohlcData = DataBankEodRepository::getEodData($instrumentId,$from,$to,$extraPoints);


            $timeStamps = $ohlcData['date'];
            $closeData = $ohlcData['close'];
            $openData = $ohlcData['open'];
            $lowData = $ohlcData['low'];
            $highData = $ohlcData['high'];
            $volData = $ohlcData['volume'];


            $index = count($ohlcData['realtimeStamps']);
            $lastday = $ohlcData['realtimeStamps'][$index - 1];
            $lastday = date("M d, Y", $lastday);
            $open = $openData[$index - 1];
            $high = $highData[$index - 1];
            $low = $lowData[$index - 1];
            $close = $closeData[$index - 1];
            $volume = $volData[$index - 1];

            $metaKey = array();
            $metaKey[] = 'category';
            $metaKey[] = 'market_lot';
            $metaKey[] = 'no_of_securities';
            $metaKey[] = 'net_asset_value_per_share';
            $metaKey[] = 'year_end';
            $metaKey[] = 'share_percentage_public';

            //$fundamentalDataOrganized = $StockBangladesh->getFundamentalInfo($instrumentId,$metaKey);
            $fundamentalDataOrganized=FundamentalRepository::getFundamentalData($metaKey,array($instrumentId))->toArray();


            $publicText = $fundamentalDataOrganized['share_percentage_public']['meta_value'] . '%';

            $topText =$instrumentInfo->name;
            $topText .= '<*font=arial.ttf,size=9*> CAT:- ' . $fundamentalDataOrganized['category']['meta_value'] . ',';
            $topText .= '<*font=arial.ttf,size=9*> LOT:- ' . $fundamentalDataOrganized['market_lot']['meta_value'] . ',';
            $topText .= '<*font=arial.ttf,size=9*> YearEnd:- ' . $fundamentalDataOrganized['year_end']['meta_value'] . ',';
            $topText .= '<*font=arial.ttf,size=9*> NAV:- ' . $fundamentalDataOrganized['net_asset_value_per_share']['meta_value'] . ',';

            $share_percentage_public = ($fundamentalDataOrganized['no_of_securities']['meta_value'] * $fundamentalDataOrganized['share_percentage_public']['meta_value']) / 100;

            $chartData['width']=$width;
            $chartData['mainHeight']=$mainHeight;
            $chartData['indicatorHeight']=$indicatorHeight;
            $chartData['timeStamps']=$timeStamps;
            $chartData['closeData']=$closeData;
            $chartData['openData']=$openData;
            $chartData['lowData']=$lowData;
            $chartData['highData']=$highData;
            $chartData['volData']=$volData;
            $chartData['lastday']=$lastday;
            $chartData['open']=$open;
            $chartData['high']=$high;
            $chartData['low']=$low;
            $chartData['close']=$close;
            $chartData['volume']=$volume;
            $chartData['publicText']=$publicText;
            $chartData['topText']=$topText;
            $chartData['share_percentage_public']=$share_percentage_public;
            $chartData['extraPoints']=$extraPoints;
            $chartData['fundamentalDataOrganized']=$fundamentalDataOrganized;
            $chartData['mov1']=$mov1;
            $chartData['mov2']=$mov2;
            $chartData['avgPeriod1']=$avgPeriod1;
            $chartData['avgPeriod2']=$avgPeriod2;

            return $chartData;
        });

        extract($chartData);
        $width = 1230;
        $mainHeight = 320;
        $indicatorHeight = 90;

        # Set the data into the chart object
        $m = new \FinanceChart($width);
        $m->setData($timeStamps, $highData, $lowData, $openData, $closeData, $volData, $extraPoints);


        $m->addMainChart($mainHeight);

        // $m->addCandleStick(0x33ff33, 0xff3333);

        // $m->addVolBars(75, 0x99ff99, 0xff9999, 0x808080);



        $indiArr = explode(",", $Indicators);

        foreach ($indiArr as $indi) {

            ChartRepository::addIndicator($m, $indi, $indicatorHeight);

        }


        $configureArr = explode(",", $configure);


        foreach ($configureArr as $config) {

            ChartRepository::addConfiguration($m, $config, $indicatorHeight);

        }


        $m->addPlotAreaTitle(BottomLeft, sprintf("<*font=arial.ttf,size=8*>%s - Open: %s High: %s Low: %s Close: %s Volume: %s   NOS: %s Public( %s ): %s", $lastday, $open,$high,$low,$close,$volume,$fundamentalDataOrganized['no_of_securities']['meta_value'],$publicText,$share_percentage_public));

        ChartRepository::addMovingAvg($m, $mov1, $avgPeriod1, 0x663300);

        ChartRepository::addMovingAvg($m, $mov2, $avgPeriod2, 0x9900ff);

        ChartRepository::addChartType($m,$charttype);
        ChartRepository::addOverlay($m,$overlay);



        # A copyright message at the bottom right corner the title area
        $m->addPlotAreaTitle(BottomRight,"<*font=arial.ttf,size=8*>(c) StockBangladesh Ltd.");
        $textBoxObj = $m->addText(650, 270, "www.stockbangladesh.com", 'arial.ttf', 20, 0xc09090, '', 0);
        $textBoxObj->setAlignment(TopRight);
        $m->addPlotAreaTitle(TopLeft, $topText);

      //  App::uses('String', 'Utility');

        //$chartId = md5(String::uuid());
        $chartId = md5('fgfdgdfgfdgd');



        # Create the WebChartViewer object

        //$viewer = new WebChartViewer("chart");

        $viewer = new \WebChartViewer("chart$chartId");



        # Output the chart

        $chartQuery = $m->makeSession($viewer->getId());



        # Set the chart URL to the viewer

        $viewer->setImageUrl("getchart/" . $chartQuery);



        # Output Javascript chart model to the browser to support tracking cursor

        //$viewer->setChartModel($m->getJsChartModel());  // SHOULD BE DISABLE IN LIVE AS IT IS NOT WORKING COMPRESSION
        // $instrumentList=array_flip ($instrumentList);

        $imageMap = $m->getHTMLImageMap("", "", "title='".$m->getToolTipDateFormat()." {value|G}'");


        return View::make("ta_chart/chart_img")->with('viewer',$viewer)->with('imageMap',$imageMap);

    }

}
