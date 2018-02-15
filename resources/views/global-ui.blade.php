<link href="{{ URL::asset('metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />

<div class="row" style="margin-right: 0">
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
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.news_box:instrument_id=" data-toggle="tab"> News </a>
            </li>
      
            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.news_chart:instrument_id=" data-toggle="tab"> News Chart </a>
            </li>   


            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.dividend_history:instrument_id=" data-toggle="tab"> Dividend History </a>
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
                            

                                    <select  id="Indicator2" class="bs-select form-control" >
                                        <option value="None">Indicator 2</option>
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
                     
                                    <select  id="Indicator3" class="bs-select form-control" >
                                        <option value="None">Indicator 3</option>
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
                      <div class="col-md-2 " >
                        <div class="margin-bottom-10">
                            
                                    <select  id="Indicator4" class="bs-select form-control" >
                                        <option value="None">Indicator 4</option>
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
                                    
                                <button data-dismiss="modal" type="button" onclick="loadChart()" class="btn btn-success form-control"><i class="fa fa-refresh"></i> Update</button>      
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
                        <a onclick="loadChart()" class="btn red btn-sm  visible-sm visible-xs" ><i class="fa fa-refresh"></i> Refresh </a>
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

@push('scripts')
<script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>

<script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}"></script>

<script>

    // cdir js
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function loadChartSettings() {
        data = getCookie('sbtachartsettings');
        if(data == '')
        {
            data = "{}";
        }
        var data = JSON.parse(data);
        $.each(data, function (k, v) {
                $('#'+k).val(v);
                $('#'+k).trigger('change');  

        })
    }

    function storeChartSettings() {
        var fields = {};
        //#adj, #configure, #charttype, #overlay, #Indicators, #mov1, #mov2, #touchspin_demo1, #touchspin_demo2, #dashboard-report-range
            
        fields['adj'] = $('#adj').val();
        // fields['interval'] = $('#interval').val();
        fields['configure'] = $('#configure').val();
        fields['charttype'] = $('#charttype').val();
        fields['overlay'] = $('#overlay').val();
        fields['Indicator1'] = $('#Indicator1').val();
        fields['Indicator2'] = $('#Indicator2').val();
        fields['Indicator3'] = $('#Indicator3').val();
        fields['Indicator4'] = $('#Indicator4').val();
        fields['ChartSize'] = $('#ChartSize').val();
        fields['mov1'] = $('#mov1').val();
        fields['mov2'] = $('#mov2').val();
        fields['touchspin_demo1'] = $('#touchspin_demo1').val();
        fields['touchspin_demo2'] = $('#touchspin_demo2').val();
        fields['chartRange'] = $('#chartRange').val();
        fields = JSON.stringify(fields);

        var d = new Date();
        var exdays = 365;
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = "sbtachartsettings" + "=" + fields + ";" + expires + ";path=/";
        
    }

    function loadChart() {
        $("div[id^='ta_chart_']").remove();
        $('.chartcontent').html(loadingDiv);
        if($('.toggle-button').attr('data-state') != 'open')
        {
            return;
        }
        storeChartSettings();
        var content = $('.chartcontent');
        var loading = $('.chart-loading');

        var chartRange = $('#chartRange').val();
        //var chartRange='2012-10-25|2013-04-25';
  

        // var comparewith=$('#comparewith').val();
        var comparewith = 'null';
        if ($('#shareList').val() == "") {
            sharelist = "DSEX";
        } else {
            sharelist = $('#shareList').val();
        }

        var Volume = 0;
        var ParabolicSAR = 0;
        var LogScale = 0;
        var PercentageScale = 0;

        $.each($('#configure').val(), function (k, v) {
            if(v == "VOLBAR"){Volume = 1; }
            if(v == "PSAR"){ParabolicSAR = 1; }
            if(v == "LOG"){LogScale = 1; }
            if(v == "PSCALE"){PercentageScale = 1; }
        })

        url = "/ta-chart?Adjusted="+$('#adj').val()+"&TickerSymbol="+sharelist+"&CompareWith=&TimeRange="+chartRange+"&ChartSize="+$('#ChartSize').val()+"&Volume="+Volume+"&ParabolicSAR="+ParabolicSAR+"&LogScale="+LogScale+"&PercentageScale="+PercentageScale+"&ChartType="+$('#charttype').val()+"&Band="+$('#overlay').val()+"&avgType1="+$('#mov1').val()+"&movAvg1="+$('#touchspin_demo1').val()+"&avgType2="+$('#mov2').val()+"&movAvg2="+$('#touchspin_demo2').val()+"&Indicator1="+$('#Indicator1').val()+"&Indicator2="+$('#Indicator2').val()+"&Indicator3="+$('#Indicator3').val()+"&Indicator4="+$('#Indicator4').val()+"&Button1=Update%20Chart&";
        
        var companyDetailsUrl = 'http://www.new.stockbangladesh.com/TechnicalAnalysis/company_details/' + sharelist
        var marketDepthUrl = 'http://www.new.stockbangladesh.com/TechnicalAnalysis/market_depth/' + sharelist

        $('#portlet_tab2_company').attr("data-url", companyDetailsUrl);
        $('#portlet_tab1_market_depth').attr("data-url", marketDepthUrl);

        $.get(url, function (data) {
                  //  App.unblockUI('#testdiv');
                    content.html(data);
        });
    }   

$("#touchspin_demo1").TouchSpin({
buttondown_class: 'btn blue',
buttonup_class: 'btn blue',
min: 1,
max: 300,
stepinterval: 1,
maxboostedstep: 10000000

});

$("#touchspin_demo2").TouchSpin({
buttondown_class: 'btn blue',
buttonup_class: 'btn blue',
min: 1,
max: 300,
stepinterval: 1,
maxboostedstep: 10000000

});



function loadFundamental(e) {
        $("div[id^='ta_chart_']").remove();
        url = e.data('url');
        
        instrument = $('#shareList').val();

        url = url + instrument;
        var target = e.attr('href');
        $(target).html(loadingDiv);
        $.get(url, function (html) {
            $(target).html(html);
        });
}

    $(document).ready(function () {

        loadChartSettings();
        $('#shareList').on('changed.bs.select', function (e) {
            if($(this).val() == null)
            {
                return;
            }
            if($('.toggle-button').data('state') != 'open')
            {
            $('.toggle-button').attr('data-state', 'open');
                $('.global-panel').show();
                window.dispatchEvent(new Event('resize'));
                $('.toggle-button').html("<i class='fa fa-close'></i> Close");

            }
            var e = $('.ta-chart-tabs li[class="active"] a');
            var url = e.data('url');

            if(url == '#')
            {

                loadChart();
            }else{
                loadFundamental(e);
            }
        });

        $('.ta-chart-tabs li[class="active"] a[data-url="#"]').click(function () {  
            var target = $(this).attr('href');
            $('.chartcontent').html(loadingDiv);
            loadChart();
        });

        $('.toggle-button').click(function () {
            if($('.toggle-button').attr('data-state') == 'open')
            {
            $("div[id^='ta_chart_']").remove();
                $('.global-panel').hide();
                $(this).html("<i class='fa fa-line-chart'></i> Chart");
                $(this).attr('data-state', 'close');
                
            $('#shareList').val('');
            $('#shareList').selectpicker('refresh');
                
            }else{
            $('#shareList').selectpicker('toggle');
                
            }

        });
// tab rearrange
window.onresize = function (e) {

    // set the modal up
    if($(document).width() < 992)
    {
        {{-- 
        remove (modal fade) class from parent div
        remove modal-cotent class
        remove modal-dialog modal-full class
        remove modal-body class
        hide modal-header
        hide modal-footer

        reverse this 
         --}}
        $('#modalFade').addClass('modal fade');        
        $('#modalContent').addClass('modal-content');        
        $('#modalDialogModalFull').addClass('modal-dialog modal-full');        
        $('#modalBody').addClass('modal-body');        
        $('.modal-header').show();        
    }
    // set the modal up
}
    })


</script>
@endpush