<link href="{{ URL::asset('metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />


<div class="row global-ui" style="margin-right: 0">
<div class="col-md-12 share-list" style="z-index: 99; max-width:300px;">
    <div class="form-group">
        <div class="input-group select2-bootstrap-prepend " style="max-width: 300px">
            <span class="input-group-btn">
                <button class="btn red mt-ladda-btn toggle-button"  type="button" data-select2-open="multi-prepend"> <i class="fa fa-line-chart"></i> Chart </button>
            </span>
              @include('html.instrument_list_bs_select_with_sector',['bs_select_id'=>'shareList', 'class' => 'instrument-select bs-select'])

        </div>
                                                                  
    </div>
</div>

<div class="col-md-12 global-panel" style=" margin-top: -15px; display: none;  padding-top: 10px; padding: 0 ">
{{--  --}}

<style>
    table td{
        color:#000 !important;
    }
    div.col-md-2{
        /*z-index: 100;*/
    }
</style>
<div class=" widget-row" style=" margin-top: -35px; margin-right: 0 !important">
<div class="col-md-12 margin-bottom-20" style="padding-right: 0">
    <!-- BEGIN WIDGET TAB -->
        <style>
        .ta-chart-tabs ul li a{
            text-transform: uppercase !important;
        }
    </style>
    <div class=" ta-chart-tabs tabbable  tabbable-tabdrop tabbable-custom">
        <ul class="nav nav-tabs">

            <li class="active">
                <a href="#taChartTab" data-url ="#" data-toggle="tab">TA Chart </a>
            </li>
            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.minute_chart:instrument_id=" data-toggle="tab"> Minute Chart </a>
            </li>      
            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.sector_minute_chart:instrument_id=" data-toggle="tab"> Sector Chart </a>
            </li>                  

            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.market_depth_single:instrument_id=" data-toggle="tab"> MARKET DEPTH </a>
            </li>      


            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.fundamental_summary:instrument_id=" data-toggle="tab"> Fundamental </a>
            </li>

            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.news_box:instrument_id=" data-toggle="tab"> News </a>
            </li>

            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.dividend_history:instrument_id=" data-toggle="tab"> Dividend History </a>
            </li>
      
            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.news_chart:instrument_id=" data-toggle="tab"> News Chart </a>
            </li>   
            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.share_holdings_history_chart:instrument_id=" data-toggle="tab"> Share Holding History </a>
            </li>              
        </ul>
        <div class="tab-content" >
            <div class="tab-pane fade active in" id="taChartTab">
                {{-- modal start --}}

                                        {{-- modal fade --}}                                                 <div  class="" id="modalFade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="" id="modalDialogModalFull">
                                                        <div class="" id="modalContent">
                                                            <div class="modal-header" style="display: none;">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title">Chart Options</h4>
                                                            </div>
                                                            <div class="" id="modalBody">
{{-- settings start --}}
    <div class="options">
                    
                <form action="index.html" class="form-horizontal ">
                    <div class="form-body" >

                        <div class="form-group " style="background: #f5f5f5; padding-top: 10px; display: inline-block; margin-right: 0px; margin-left: 0; width: 100%">
                            <div class="col-md-12" style="padding: 0">
                            <div class="col-md-2 ">
                                <div class="margin-bottom-10">
                                    <select name="" id="chartRange" class="bs-select form-control">
                                        <option value="{{1}}">1 Day</option>
                                        <option value="{{2}}">2 Days</option>
                                        <option value="{{5}}">5 Days</option>
                                        <option value="{{10}}">10 Days</option>
                                        <option value="{{30}}">1 Month</option>
                                        <option value="{{4*30}}">4 Months</option>
                                        <option selected value="{{5*30}}">5 Months</option>
                                        <option  value="{{6*30}}">6 Months</option>
                                        <option value="{{365}}">1 Year</option>
                                        <option value="{{365*2}}">2 Years</option>
                                        <option value="{{365*3}}">3 Years</option>
                                        <option value="{{365*4}}">4 Years</option>
                                        <option value="{{365*5}}">5 Years</option>
                                        <option value="{{365*6}}">6 Years</option>
                                        <option value="{{365*7}}">7 Years</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <div class="margin-bottom-10">
                                    <select id="configure" class="bs-select form-control" multiple>
                                        <option value="VOLBAR" title="VOLBAR" selected="">Volume bar</option>
                                        <option value="PSAR" title="PSAR">Parabolic SAR</option>
                                        <option value="LOG" title="LOG">Log Scale</option>
                                        <option value="PSCALE" title="PSCALE">Percentage Scale</option>
                                    </select>


                                </div>
                            </div>

                      <div class="col-md-2 " >
                        <div class="margin-bottom-10">
                                    <select  id="Indicator1" class="bs-select form-control" >
                                        <option value="None">Indicator 1</option>
                                        <option value="AccDist" title="A/D">Accu/Dist</option>
                                        <option value="AroonOsc" title="ArnOsc">Aroon Oscillator</option>
                                        <option value="Aroon" title="Aroon">Aroon Up/Down</option>
                                        <option value="ADX" title="ADX">Avg Directional Index</option>
                                        <option value="ATR" title="ATR">Avg True Range</option>
                                        <option value="BBW" title="BBW">Bollinger Band Width</option>
                                        <option value="CMF" title="CMF">Chaikin Money Flow</option>
                                        <option value="COscillator" title="COsc">Chaikin Oscillator</option>
                                        <option value="CVolatility" title="CVol">Chaikin Volatility</option>
                                        <option value="CLV" title="CLV">Close Location Value</option>
                                        <option value="CCI" title="CCI">CCI</option>
                                        <option value="DPO" title="DPO">Detrended Price Osc</option>
                                        <option value="DCW" title="DCW">Donchian Channel</option>
                                        <option value="EMV" title="EMV">Ease of Movement</option>
                                        <option value="FStoch" title="FStoch">Fast Stochastic</option>
                                        <option value="MACD" title="MACD">MACD</option>
                                        <option value="MDX" title="MDX">Mass Index</option>
                                        <option value="Momentum" title="Momentum">Momentum</option>
                                        <option value="MFI" title="MFI">Money Flow Index</option>
                                        <option value="NVI" title="NVI">Neg Volume Index</option>
                                        <option value="OBV" title="OBV">On Balance Volume</option>
                                        <option value="Performance" title="Perfornamce">Performance</option>
                                        <option value="PPO" title="PPO">% Price Oscillator</option>
                                        <option value="PVO" title="PVO">% Volume Oscillator</option>
                                        <option value="PVI" title="PVI">Pos Volume Index</option>
                                        <option value="PVT" title="PVT">Price Volume Trend</option>
                                        <option value="ROC" title="ROC">Rate of Change</option>
                                        <option value="RSI"  title="RSI" selected="">RSI</option>
                                        <option value="SStoch" title="SStoch">Slow Stochastic</option>
                                        <option value="StochRSI" title="StochRSI">StochRSI</option>
                                        <option value="TRIX" title="TRIX">TRIX</option>
                                        <option value="UO" title="UO">Ultimate Oscillator</option>
                                        <option value="Vol" title="VOL">Volume</option>
                                        <option value="WilliamR" title="WilliamR">William's %R</option>
                                    </select>  
                            </div>
                      </div>
                      <div class="col-md-2 " >
                        <div class="margin-bottom-10">
                            

                                    <select  id="Indicator2" class="bs-select form-control">


                                            <option value="AccDist" title="A/D">Accu/Dist</option>
                                            <option value="AroonOsc" title="ArnOsc">Aroon Oscillator</option>
                                            <option value="Aroon" title="Aroon">Aroon Up/Down</option>
                                            <option value="ADX" title="ADX">Avg Directional Index</option>
                                            <option value="ATR" title="ATR">Avg True Range</option>
                                            <option value="BBW" title="BBW">Bollinger Band Width</option>
                                            <option value="CMF" title="CMF">Chaikin Money Flow</option>
                                            <option value="COscillator" title="COsc">Chaikin Oscillator</option>
                                            <option value="CVolatility" title="CVol">Chaikin Volatility</option>
                                            <option value="CLV" title="CLV">Close Location Value</option>
                                            <option value="CCI" title="CCI">CCI</option>
                                            <option value="DPO" title="DPO">Detrended Price Osc</option>
                                            <option value="DCW" title="DCW">Donchian Channel</option>
                                            <option value="EMV" title="EMV">Ease of Movement</option>
                                            <option value="FStoch" title="FStoch">Fast Stochastic</option>
                                            <option value="MACD" title="MACD" selected="" >MACD</option>
                                            <option value="MDX" title="MDX">Mass Index</option>
                                            <option value="Momentum" title="Momentum">Momentum</option>
                                            <option value="MFI" title="MFI">Money Flow Index</option>
                                            <option value="NVI" title="NVI">Neg Volume Index</option>
                                            <option value="OBV" title="OBV">On Balance Volume</option>
                                            <option value="Performance" title="Perfornamce">Performance</option>
                                            <option value="PPO" title="PPO">% Price Oscillator</option>
                                            <option value="PVO" title="PVO">% Volume Oscillator</option>
                                            <option value="PVI" title="PVI">Pos Volume Index</option>
                                            <option value="PVT" title="PVT">Price Volume Trend</option>
                                            <option value="ROC" title="ROC">Rate of Change</option>
                                            <option value="RSI"  title="RSI">RSI</option>
                                            <option value="SStoch" title="SStoch">Slow Stochastic</option>
                                            <option value="StochRSI" title="StochRSI">StochRSI</option>
                                            <option value="TRIX" title="TRIX">TRIX</option>
                                            <option value="UO" title="UO">Ultimate Oscillator</option>
                                            <option value="Vol" title="VOL">Volume</option>
                                            <option value="WilliamR" title="WilliamR">William's %R</option>

                                    </select>  
                        </div>                                    
                      </div>
                      <div class="col-md-2 " >
                        <div class="margin-bottom-10">
                     
                                    <select  id="Indicator3" class="bs-select form-control" title="Indicators + candle patterns" data-style="yellow">
                                        <optgroup label="Indicators">
                                            <option value="AccDist" title="A/D">Accu/Dist</option>
                                            <option value="AroonOsc" title="ArnOsc">Aroon Oscillator</option>
                                            <option value="Aroon" title="Aroon">Aroon Up/Down</option>
                                            <option value="ADX" title="ADX">Avg Directional Index</option>
                                            <option value="ATR" title="ATR">Avg True Range</option>
                                            <option value="BBW" title="BBW">Bollinger Band Width</option>
                                            <option value="CMF" title="CMF">Chaikin Money Flow</option>
                                            <option value="COscillator" title="COsc">Chaikin Oscillator</option>
                                            <option value="CVolatility" title="CVol">Chaikin Volatility</option>
                                            <option value="CLV" title="CLV">Close Location Value</option>
                                            <option value="CCI" title="CCI">CCI</option>
                                            <option value="DPO" title="DPO">Detrended Price Osc</option>
                                            <option value="DCW" title="DCW">Donchian Channel</option>
                                            <option value="EMV" title="EMV">Ease of Movement</option>
                                            <option value="FStoch" title="FStoch">Fast Stochastic</option>
                                            <option value="MACD" title="MACD" >MACD</option>
                                            <option value="MDX" title="MDX">Mass Index</option>
                                            <option value="Momentum" title="Momentum">Momentum</option>
                                            <option value="MFI" title="MFI">Money Flow Index</option>
                                            <option value="NVI" title="NVI">Neg Volume Index</option>
                                            <option value="OBV" title="OBV">On Balance Volume</option>
                                            <option value="Performance" title="Perfornamce">Performance</option>
                                            <option value="PPO" title="PPO">% Price Oscillator</option>
                                            <option value="PVO" title="PVO">% Volume Oscillator</option>
                                            <option value="PVI" title="PVI">Pos Volume Index</option>
                                            <option value="PVT" title="PVT">Price Volume Trend</option>
                                            <option value="ROC" title="ROC">Rate of Change</option>
                                            <option value="RSI"  title="RSI">RSI</option>
                                            <option value="SStoch" title="SStoch">Slow Stochastic</option>
                                            <option value="StochRSI" title="StochRSI">StochRSI</option>
                                            <option value="TRIX" title="TRIX">TRIX</option>
                                            <option value="UO" title="UO">Ultimate Oscillator</option>
                                            <option value="Vol" title="VOL">Volume</option>
                                            <option value="WilliamR" title="WilliamR">William's %R</option>
                                        </optgroup>
                                       <optgroup label="Candle Pattern">
                                           <option value="trader_cdl2crows" >Two Crows</option>
                                           <option value="trader_cdl3blackcrows">Three Black Crows</option>
                                           <option value="trader_cdl3inside">Three Inside Up/Down</option>
                                           <option value="trader_cdl3linestrike">Three-Line Strike</option>
                                           <option value="trader_cdl3outside">Three Outside Up/Down</option>
                                           <option value="trader_cdl3starsinsouth">Three Stars In The South</option>
                                           <option value="trader_cdl3whitesoldiers" >Three Advancing White Soldiers</option>
                                           <option value="trader_cdlabandonedbaby" >Abandoned Baby</option>
                                           <option value="trader_cdlbelthold" >Belt-hold</option>
                                           <option value="trader_cdlbreakaway" >Breakaway</option>
                                           <option value="trader_cdlclosingmarubozu" >Closing Marubozu</option>
                                           <option value="trader_cdlconcealbabyswall" >Concealing Baby Swallow</option>
                                           <option value="trader_cdlcounterattack" >Counterattack</option>
                                           <option value="trader_cdldarkcloudcover" >Dark Cloud Cover</option>
                                           <option value="trader_cdldoji" >Doji</option>
                                           <option value="trader_cdldojistar" >Doji Star</option>
                                           <option value="trader_cdldragonflydoji" >Dragonfly Doji</option>
                                           <option value="trader_cdlengulfing" >Engulfing Pattern</option>
                                           <option value="trader_cdleveningdojistar" >Evening Doji Star</option>
                                           <option value="trader_cdleveningstar" >Evening Star</option>
                                           <option value="trader_cdlgapsidesidewhite" >Up/Down-gap side-by-side white lines</option>
                                           <option value="trader_cdlgravestonedoji" >Gravestone Doji</option>
                                           <option value="trader_cdlhammer" >Hammer</option>
                                           <option value="trader_cdlhangingman" >Hanging Man</option>
                                           <option value="trader_cdlharami" >Harami Pattern</option>
                                           <option value="trader_cdlharamicross" >Harami Cross Pattern</option>
                                           <option value="trader_cdlhighwave" >High-Wave Candle</option>
                                           <option value="trader_cdlhikkake" >Hikkake Pattern</option>
                                           <option value="trader_cdlhikkakemod" >Modified Hikkake Pattern</option>
                                           <option value="trader_cdlhomingpigeon" >Homing Pigeon</option>
                                           <option value="trader_cdlidentical3crows" >Identical Three Crows</option>
                                           <option value="trader_cdlinneck" >In-Neck Pattern</option>
                                           <option value="trader_cdlinvertedhammer" >Inverted Hammer</option>
                                           <option value="trader_cdlkicking" >Kicking</option>
                                           <option value="trader_cdlkickingbylength" >Kicking - bull/bear determined by the longer marubozu</option>
                                           <option value="trader_cdlladderbottom" >Ladder Bottom</option>
                                           <option value="trader_cdllongleggeddoji" >Long Legged Doji</option>
                                           <option value="trader_cdllongline" >Long Line Candle</option>
                                           <option value="trader_cdlmarubozu" >Marubozu</option>
                                           <option value="trader_cdlmatchinglow" >Matching Low</option>
                                           <option value="trader_cdlmathold" >Mat Hold</option>
                                           <option value="trader_cdlmorningdojistar" >Morning Doji Star</option>
                                           <option value="trader_cdlmorningstar" >Morning Star</option>
                                           <option value="trader_cdlonneck" >On-Neck Pattern</option>
                                           <option value="trader_cdlpiercing" >Piercing Pattern</option>
                                           <option value="trader_cdlrickshawman" >Rickshaw Man</option>
                                           <option value="trader_cdlrisefall3methods" >Rising/Falling Three Methods</option>
                                           <option value="trader_cdlseparatinglines" >Separating Lines</option>
                                           <option value="trader_cdlshootingstar" >Shooting Star</option>
                                           <option value="trader_cdlshortline" >Short Line Candle</option>
                                           <option value="trader_cdlspinningtop" >Spinning Top</option>
                                           <option value="trader_cdlstalledpattern" >Stalled Pattern</option>
                                           <option value="trader_cdlsticksandwich" >Stick Sandwich</option>
                                           <option value="trader_cdltakuri" >Takuri (Dragonfly Doji with very long lower shadow)</option>
                                           <option value="trader_cdltasukigap" >Tasuki Gap</option>
                                           <option value="trader_cdlthrusting" >Thrusting Pattern</option>
                                           <option value="trader_cdltristar" >Tristar Pattern</option>
                                           <option value="trader_cdlunique3river" >Unique 3 River</option>
                                           <option value="trader_cdlupsidegap2crows" >Upside Gap Two Crows</option>
                                           <option value="trader_cdlxsidegap3methods" >Upside/Downside Gap Three Methods</option>
                                       </optgroup>
                                    </select>  
                        </div>                                    
                      </div>
                      <div class="col-md-2 " >
                        <div class="margin-bottom-10">
                        
                                    <select  id="Indicator4" class="indicator4 form-control indicator4" multiple="">
                                        
                                        <option value="AccDist" title="A/D">Accu/Dist</option>
                                        <option value="AroonOsc" title="ArnOsc">Aroon Oscillator</option>
                                        <option value="Aroon" title="Aroon">Aroon Up/Down</option>
                                        <option value="ADX" title="ADX">Avg Directional Index</option>
                                        <option value="ATR" title="ATR">Avg True Range</option>
                                        <option value="BBW" title="BBW">Bollinger Band Width</option>
                                        <option value="CMF" title="CMF">Chaikin Money Flow</option>
                                        <option value="COscillator" title="COsc">Chaikin Oscillator</option>
                                        <option value="CVolatility" title="CVol">Chaikin Volatility</option>
                                        <option value="CLV" title="CLV">Close Location Value</option>
                                        <option value="CCI" title="CCI">CCI</option>
                                        <option value="DPO" title="DPO">Detrended Price Osc</option>
                                        <option value="DCW" title="DCW">Donchian Channel</option>
                                        <option value="EMV" title="EMV">Ease of Movement</option>
                                        <option value="FStoch" title="FStoch">Fast Stochastic</option>
                                        <option value="MACD" title="MACD" >MACD</option>
                                        <option value="MDX" title="MDX">Mass Index</option>
                                        <option value="Momentum" title="Momentum">Momentum</option>
                                        <option value="MFI" title="MFI">Money Flow Index</option>
                                        <option value="NVI" title="NVI">Neg Volume Index</option>
                                        <option value="OBV" title="OBV">On Balance Volume</option>
                                        <option value="Performance" title="Perfornamce">Performance</option>
                                        <option value="PPO" title="PPO">% Price Oscillator</option>
                                        <option value="PVO" title="PVO">% Volume Oscillator</option>
                                        <option value="PVI" title="PVI">Pos Volume Index</option>
                                        <option value="PVT" title="PVT">Price Volume Trend</option>
                                        <option value="ROC" title="ROC">Rate of Change</option>
                                        <option value="RSI"  title="RSI">RSI</option>
                                        <option value="SStoch" title="SStoch">Slow Stochastic</option>
                                        <option value="StochRSI" title="StochRSI">StochRSI</option>
                                        <option value="TRIX" title="TRIX">TRIX</option>
                                        <option value="UO" title="UO">Ultimate Oscillator</option>
                                        <option value="Vol" title="VOL">Volume</option>
                                        <option value="WilliamR" title="WilliamR">William's %R</option>
                                    </select>  
                            </div>                                    
                      </div>          
                            <div class="col-md-2 ">
                                <div class="margin-bottom-10">
                                    <select id="charttype" class="bs-select form-control">
                                        <option value="CandleStick" selected="">CandleStick</option>
                                        <option value="Close">Closing Price</option>
                                        <option value="Median">Median Price</option>
                                        <option value="OHLC">OHLC</option>
                                        <option value="TP">Typical Price</option>
                                        <option value="WC">Weighted Close</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-2  ">
                                <div class="margin-bottom-10">
                                    <select id="overlay" class="bs-select form-control ">
                                        <option value="BB" selected="">Bollinger Band</option>
                                        <option value="DC">Donchian Channel</option>
                                        <option value="Envelop">Envelop (SMA 20 +/- 10%)</option>
                                    </select>

                                </div>

                            </div>     
                            <div class="col-md-2  ">
                                <div class="margin-bottom-10">

                                        <select id="mov1" class="bs-select form-control">
                                            <option value="SMA" selected="">Simple</option>
                                            <option value="EMA">Exponential</option>
                                            <option value="TMA">Triangular</option>
                                            <option value="WMA">Weighted</option>
                                            <option value="trader_dema">DEMA</option>
                                            <option value="trader_kama">KAMA</option>
                                            <option value="trader_mama">MAMA</option>
                                            <option value="trader_midpoint">MidPoint</option>
                                            <option value="trader_t3">T3</option>
                                            <option value="trader_tema">TEMA</option>
                                            <option value="trader_trima">TRIMA</option>
                                            <option value="trader_ht_trendline">Hilbert Transform</option>

                                        </select>


                                </div>
                            </div>
                            <div class="col-md-2  ">
                                <div class="margin-bottom-10">

                                        <input id="touchspin_demo1" type="text" value="13" name="demo1" class="form-control">


                                </div>
                            </div>
                            <div class="col-md-2  ">
                                <div class="margin-bottom-10">
                                    <select id="mov2" class="bs-select form-control">
                                        <option value="SMA" selected="">Simple</option>
                                        <option value="EMA">Exponential</option>
                                        <option value="TMA">Triangular</option>
                                        <option value="WMA">Weighted</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-2  ">
                                <div class="margin-bottom-10">
                                    <input id="touchspin_demo2" type="text" value="19" name="demo1" class="form-control">
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="margin-bottom-10">
                                    <select id="adj" class="bs-select form-control" >
                                        <option value="1" selected>Adjusted</option>
                                        <option value="0" >Non Adjusted</option>
                                    </select>   


                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <div class="margin-bottom-10">
                                    <select id="interval" class="form-control bs-select">
                                        <option value="5">5 Minute</option>
                                        <option value="10">10 Minute</option>
                                        <option value="15">15 Minute</option>
                                        <option value="30">30 Minute</option>
                                        <option value="60">1 Hour</option>
                                        <option selected="" value="D">Daily</option>
                                    </select>
                                </div>
                            </div> 

                            <div class="col-md-2 ">
                                <div class="margin-bottom-10">
                                    <select id="ChartSize" class="form-control bs-select">
                                        <option >Chart Size</option>
                                        <option value="S">Small</option>
                                        <option value="M">Medium</option>
                                        <option value="L">Large</option>
                                        <option value="H" selected>Huge</option>
                                    </select>
                                </div>
                            </div>                            

                            <div class="col-md-2">
                                <div class="margin-bottom-10">
                                    
                                <button data-dismiss="modal" type="button"  class="btn btn-success form-control loadChart"><i class="fa fa-refresh"></i> Update</button>      
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="margin-bottom-10">
                                    <div class="btn-group btn-group-solid hidden-sm hidden-xs">

                                            <button type="button" class="btn purple prev tooltips" data-container="body" data-placement="left" data-original-title="Press left arrow of keyboard"><i class="fa fa-arrow-left"></i> Prev</button>
                                            <button type="button" class="btn purple next tooltips" data-container="body" data-placement="right" data-original-title="Press right arrow of keyboard">Next <i class="fa fa-arrow-right"></i></button>

                                    </div> 
                                </div>
                            </div>
                        </div>

<style>
    @media (max-width: 990px) {
        .{
         margin: 10px 0 10px 0;
            
        }
    }
</style>

                      </div>
                    </div>
                </form>
                </div>
{{-- settings end --}}
                                                             </div>
                                              
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
           
                {{-- modal end --}}
                <div class="row margin-bottom-10" >      
                    <div class="col-xs-6">
                        <a class="btn red btn-sm  visible-sm visible-xs" data-toggle="modal" href="#modalFade"> <i class="fa fa-bars"></i> Options </a>
                    </div>
                    <div class="col-xs-6">
                        <a  class="btn red btn-sm  visible-sm visible-xs loadChart" ><i class="fa fa-refresh"></i> Refresh </a>
                    </div>
                </div>

        <div class="row margin-bottom-10" >      
            <div class="col-md-12" style="text-align: center;">
                
            <div class="btn-group btn-group-solid hidden-md hidden-lg " >

                    <button type="button" class="btn purple prev btn-sm " data-container="body" data-placement="left" ><i class="fa fa-arrow-left"></i> Prev</button>
                    <button type="button" class="btn purple next btn-sm " data-container="body" data-placement="right" >Next <i class="fa fa-arrow-right"></i></button>

            </div> 

            </div>
        </div>

            
{{--  --}}
            <div id="chartContainer" class="chartcontent thumbnail" style="min-height: 200px;">
                <input type="hidden" id="chart_id" value="">
                </div>


            </div>

            <div class="tab-pane fade container-fluid" id="share_holdings">
                    
            </div>
        </div>
    </div>
    <!-- END WIDGET TAB -->

</div>

</div>



{{--  --}}
</div>
{{--  --}}


    
</div>

