<link href="{{ URL::asset('metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<div class="row">
<div class="col-md-12" style="z-index: 99; max-width:300px;">
	<div class="form-group">
        <div class="input-group select2-bootstrap-prepend " style="max-width: 300px">
            <span class="input-group-btn">
                <button class="btn red mt-ladda-btn toggle-button"  type="button" data-select2-open="multi-prepend"> <i class="fa fa-line-chart"></i> Chart </button>
            </span>
              @include('html.instrument_list_bs_select_with_sector',['bs_select_id'=>'shareList', 'class' => 'instrument-select bs-select'])
        </div>
    </div>
</div>

{{--  --}}


{{--  --}}
<div class="col-md-12 global-panel" style=" margin-top: -15px; display: none; padding-top: 10px ">
{{--  --}}

<style>
    table td{
        color:#000 !important;
    }
</style>
<div class="row widget-row" style=" margin-top: -48px;">
<div class="col-md-12 margin-bottom-20">
    <!-- BEGIN WIDGET TAB -->
        <style>
        .ta-chart-tabs ul li a{
            text-transform: uppercase !important;
        }
    </style>
    <div class=" ta-chart-tabs tabbable-custom ">
        <ul class="nav nav-tabs tabs-reversed">

            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.share_holdings_history_chart:instrument_id=" data-toggle="tab"> Share Holding History </a>
            </li>


            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.dividend_history:instrument_id=" data-toggle="tab"> Dividend History </a>
            </li>


            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.news_chart:instrument_id=" data-toggle="tab"> News Chart </a>
            </li>            

            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.news_box:instrument_id=" data-toggle="tab"> News </a>
            </li>
{{--             <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.market_depth_single:instrument_id=" data-toggle="tab"> Company Details </a>
            </li>
            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.market_depth_single:instrument_id=" data-toggle="tab"> Fundamental Details </a>
            </li> --}}

         
            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.market_depth_single:instrument_id=" data-toggle="tab"> MARKET DEPTH </a>
            </li>            

            <li>
                <a href="#share_holdings" data-url="/ajax/load_block/block_name=block.minute_chart:instrument_id=" data-toggle="tab"> Minute Chart </a>
            </li>

            <li class="active">
                <a href="#taChartTab" data-url ="#" data-toggle="tab">TA Chart </a>
            </li>
        </ul>
        <div class="tab-content" >
            <div class="tab-pane fade active in" id="taChartTab">
                <form action="index.html" class="form-horizontal ">
                    <div class="form-body" >

                        <div class="form-group " style="background: #f5f5f5; padding-top: 10px; display: inline-block; margin-right: 0px; margin-left: 0; width: 100%">
							<div class="col-md-9">
                            <div class="col-md-2 hidden-xs hidden-sm">
                                <div class="margin-bottom-10">
                                    <select id="adj" class="bs-select form-control" >
                                        <option value="1" selected>Adjusted</option>
                                        <option value="0" >Non Adjusted</option>
                                    </select>

                                </div>
                            </div>

{{-- 
                            <div class="col-md-2">
                                <div class="margin-bottom-10">
                                    <select id="interval" class="bs-select form-control" >
                                        <option value="{{1*60}}" >1 Minute</option>
                                        <option value="{{5*60}}" >5 Minute</option>
                                        <option value="{{15*60}}" >15 Minute</option>
                                        <option value="{{30*60}}" >30 Minute</option>
                                        <option value="{{45*60}}" >45 Minute</option>
                                        <option value="{{60*60}}" >1 Hour</option>
                                        <option value="{{24*60*60}}" selected>1 Day</option>
                                        <option value="{{7*24*60*60}}" >7 Days</option>
                                        <option value="{{30*24*60*60}}" >30 Days</option> 
                                    </select>

                                </div>
                            </div>

 --}}
                            <div class="col-md-2 hidden-xs hidden-sm">
                                <div class="margin-bottom-10">
                                    <select id="configure" class="bs-select form-control" multiple>
                                        <option value="VOLBAR" title="VOLBAR" selected="">Volume bar</option>
                                        <option value="PSAR" title="PSAR">Parabolic SAR</option>
                                        <option value="LOG" title="LOG">Log Scale</option>
                                        <option value="PSCALE" title="PSCALE">Percentage Scale</option>
                                    </select>


                                </div>
                            </div>
                            <div class="col-md-3 hidden-xs hidden-sm">
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
                            <div class="col-md-3  hidden-xs hidden-sm">
                                <div class="margin-bottom-10">
                                    <select id="overlay" class="bs-select form-control ">
                                        <option value="BB" selected="">Bollinger Band</option>
                                        <option value="DC">Donchian Channel</option>
                                        <option value="Envelop">Envelop (SMA 20 +/- 10%)</option>
                                    </select>

                                </div>

                            </div>     
                       


                            <div class="col-md-2  hidden-xs hidden-sm">
                                <div class="margin-bottom-10">

                                        <select id="mov1" class="bs-select form-control">
                                            <option value="SMA" selected="">Simple</option>
                                            <option value="EMA">Exponential</option>
                                            <option value="TMA">Triangular</option>
                                            <option value="WMA">Weighted</option>
                                        </select>


                                </div>
                            </div>
                            <div class="col-md-2  hidden-xs hidden-sm">
                                <div class="margin-bottom-10">

                                        <input id="touchspin_demo1" type="text" value="13" name="demo1" class="form-control">


                                </div>
                            </div>
                            <div class="col-md-2  hidden-xs hidden-sm">
                                <div class="margin-bottom-10">
                                    <select id="mov2" class="bs-select form-control">
                                        <option value="SMA" selected="">Simple</option>
                                        <option value="EMA">Exponential</option>
                                        <option value="TMA">Triangular</option>
                                        <option value="WMA">Weighted</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-2  hidden-xs hidden-sm">

                                    <input id="touchspin_demo2" type="text" value="19" name="demo1" class="form-control">

                            </div>
                            <div class="col-md-3">
                                <div class="margin-bottom-10">
                                        <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height green" data-placement="top" data-original-title="Change dashboard date range">                            
                                        <i class="icon-calendar"></i>&nbsp;
                                        <span class="thin uppercase hidden-xs"></span>&nbsp;
                                        <i class="fa fa-angle-down"></i>
                               
                                        

                                    </div>


                                </div>
                            </div>

                            <div class="col-md-1">
                                <button type="button" onclick="loadChart()" class="btn btn-success"><i class="fa fa-refresh"></i></button>      
                            </div>
                        </div>

<style>
    @media (max-width: 990px) {
        .se-sm-margin{
         margin: 10px 0 10px 0;
            
        }
    }
</style>
                  	  <div class="col-md-3 se-sm-margin" >
                                    <select  id="Indicators" class="select2 double-row" multiple  title='Choose indicators' data-live-search="true">
                                        <option value="None">Select Indicators</option>
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
                                        <option value="MACD" title="MACD" selected="">MACD</option>
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
                                        <option value="RSI" selected="" title="RSI">RSI</option>
                                        <option value="SStoch" title="SStoch">Slow Stochastic</option>
                                        <option value="StochRSI" title="StochRSI">StochRSI</option>
                                        <option value="TRIX" title="TRIX">TRIX</option>
                                        <option value="UO" title="UO">Ultimate Oscillator</option>
                                        <option value="Vol" title="VOL">Volume</option>
                                        <option value="WilliamR" title="WilliamR">William's %R</option>
                                    </select>  
                   	  </div>


                  	  </div>


                    </div>

                </form>

{{--  --}}
 <script type="text/javascript" src="/cdjcv.js"></script>

<script>
//
// Draw finance chart track line with legend
//
function traceFinance(viewer, mouseX)
{
    // Remove all previously drawn tracking object
    viewer.hideObj("all");

    // It is possible for a FinanceChart to be empty, so we need to check for it.
    if (!viewer.getChart())
        return;

    // Get the data x-value that is nearest to the mouse
    var xValue = viewer.getChart().getNearestXValue(mouseX);

    // Iterate the XY charts (main price chart and indicator charts) in the FinanceChart
    var c = null;
    for (var i = 0; i < viewer.getChartCount(); ++i)
    {
        c = viewer.getChart(i);

        // Variables to hold the legend entries
        var ohlcLegend = "";
        var legendEntries = [];

        // Iterate through all layers to build the legend array
        for (var j = 0; j < c.getLayerCount(); ++j)
        {
            var layer = c.getLayerByZ(j);
            var xIndex = layer.getXIndexOf(xValue);
            var dataSetCount = layer.getDataSetCount();

            // In a FinanceChart, only layers showing OHLC data can have 4 data sets
            if (dataSetCount == 4)
            {
                var highValue = layer.getDataSet(0).getValue(xIndex);
                var lowValue = layer.getDataSet(1).getValue(xIndex);
                var openValue = layer.getDataSet(2).getValue(xIndex);
                var closeValue = layer.getDataSet(3).getValue(xIndex);

                if (closeValue == null)
                    continue;

                // Build the OHLC legend
                ohlcLegend =
                    "Open: " + openValue.toPrecision(4) + ", High: " + highValue.toPrecision(4) +
                    ", Low: " + lowValue.toPrecision(4) + ", Close: " + closeValue.toPrecision(4);

                // We also draw an upward or downward triangle for up and down days and the % change
                var lastCloseValue = layer.getDataSet(3).getValue(xIndex - 1);
                if (lastCloseValue != null)
                {
                    var change = closeValue - lastCloseValue;
                    var percent = change * 100 / closeValue;
                    if (change >= 0)
                        ohlcLegend += "&nbsp;&nbsp;<span style='color:#008800;'>&#9650; ";
                    else
                        ohlcLegend += "&nbsp;&nbsp;<span style='color:#CC0000;'>&#9660; ";
                    ohlcLegend += change.toPrecision(4) + " (" + percent.toFixed(2) + "%)</span>";
                }

                // Add a spacer box, and make sure the line does not wrap within the legend entry
                ohlcLegend = "<nobr>" + ohlcLegend + viewer.htmlRect(20, 0) + "</nobr> ";
            }
            else
            {
                // Iterate through all the data sets in the layer
                for (var k = 0; k < dataSetCount; ++k)
                {
                    var dataSet = layer.getDataSetByZ(k);
                    var name = dataSet.getDataName();
                    var value = dataSet.getValue(xIndex);
                    if ((!name) || (value == null))
                        continue;

                    // In a FinanceChart, the data set name consists of the indicator name and its latest value. It is
                    // like "Vol: 123M" or "RSI (14): 55.34". As we are generating the values dynamically, we need to
                    // extract the indictor name out, and also the volume unit (if any).

                    // The unit character, if any, is the last character and must not be a digit.
                    var unitChar = name.charAt(name.length - 1);
                    if ((unitChar >= '0') && (unitChar <= '9'))
                        unitChar = '';

                    // The indicator name is the part of the name up to the colon character.
                    var delimiterPosition = name.indexOf(':');
                    if (delimiterPosition != -1)
                        name = name.substring(0, delimiterPosition);

                    // In a FinanceChart, if there are two data sets, it must be representing a range.
                    if (dataSetCount == 2)
                    {
                        // We show both values in the range
                        var value2 = layer.getDataSetByZ(1 - k).getValue(xIndex);
                        name = name + ": " + Math.min(value, value2).toPrecision(4) + " - "
                            + Math.max(value, value2).toPrecision(4);
                    }
                    else
                    {
                        // In a FinanceChart, only the layer for volume bars has 3 data sets for up/down/flat days
                        if (dataSetCount == 3)
                        {
                            // The actual volume is the sum of the 3 data sets.
                            value = layer.getDataSet(0).getValue(xIndex) + layer.getDataSet(1).getValue(xIndex) +
                                layer.getDataSet(2).getValue(xIndex);
                        }

                        // Create the legend entry
                        name = name + ": " + value.toPrecision(4) + unitChar;
                    }

                    // Build the legend entry, consist of a colored square box and the name (with the data value in it).
                    legendEntries.push("<nobr>" + viewer.htmlRect(5, 5, dataSet.getDataColor(),
                        "solid 1px black") + " " + name + viewer.htmlRect(20, 0) + "</nobr>");
                }
            }
        }

        // The legend is formed by concatenating the legend entries.
        var legend = legendEntries.reverse().join(" ");

        // Add the date and the ohlcLegend (if any) at the beginning of the legend
        legend = "<nobr>[" + c.xAxis().getFormattedLabel(xValue, "mmm dd, yyyy") + "]" + viewer.htmlRect(20, 0) +
            "</nobr> " + ohlcLegend + legend;

        // Get the plot area position relative to the entire FinanceChart
        var plotArea = c.getPlotArea();
        var plotAreaLeftX = plotArea.getLeftX() + c.getAbsOffsetX();
        var plotAreaTopY = plotArea.getTopY() + c.getAbsOffsetY();

        // Draw a vertical track line at the x-position
        viewer.drawVLine("trackLine" + i, c.getXCoor(xValue) + c.getAbsOffsetX(), plotAreaTopY,
            plotAreaTopY + plotArea.getHeight(), "black 1px dotted");

        // Display the legend on the top of the plot area
        viewer.showTextBox("legend" + i, plotAreaLeftX + 1, plotAreaTopY + 1, JsChartViewer.TopLeft, legend,
            "padding-left:5px;width:" + (plotArea.getWidth() - 1) + "px;font:11px Arial;-webkit-text-size-adjust:100%;");
    }
}

</script>
{{--  --}}
            <div id="chartContainer" class="chartcontent thumbnail">
				<input type="hidden" id="chart_id" value="">
                </div>


            </div>

            <div class="tab-pane fade" id="share_holdings">
                    
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
function crossHairAxisLabel(viewer, x, y)
{
    // Show cross hair
    viewer.showCrossHair(x, y);

    // The chart, its plot area and axes
    var c = viewer.getChart();
    var xAxis = c.xAxis();
    var yAxis = c.yAxis();

    // The axis label style
    var labelStyle = "padding:2px 4px; font: bold 8pt arial; border:1px solid black;" +
        "background-color:#DDDDFF; -webkit-text-size-adjust:100%;";

    // Draw x-axis label
    var yPos = xAxis.getY() + ((xAxis.getAlignment() == JsChartViewer.Top) ? -2 : 3);
    var alignment = (xAxis.getAlignment() == JsChartViewer.Top) ? JsChartViewer.Bottom : JsChartViewer.Top;
    viewer.showTextBox("xAxisLabel", x, yPos, alignment, c.getXValue(x).toPrecision(4), labelStyle);

    // Draw y-axis label
    var xPos = yAxis.getX() + ((yAxis.getAlignment() == JsChartViewer.Left) ? -2 : 3);
    var alignment = (yAxis.getAlignment() == JsChartViewer.Left) ? JsChartViewer.Right : JsChartViewer.Left;
    viewer.showTextBox("yAxisLabel", xPos, y, alignment, c.getYValue(y, yAxis).toPrecision(4), labelStyle);
}

function showDataPointToolTip(x, y)
{
    var viewer = JsChartViewer.get('ta_chart');
    viewer.showTextBox("toolTipBox", viewer.getChartMouseX() + 20, viewer.getChartMouseY() + 20, JsChartViewer.TopLeft,
        "<table><tr><td>Concentration</td><td>: " + x.toPrecision(4) +
        " g/liter</td></tr><tr><td>Conductivity</td><td>: " + y.toPrecision(4) + " W/K</td></tr></table>",
        "padding:0px; font:bold 8pt arial; border:1px solid black; background-color:#DDDDFF");
}
function hideToolTip()
{
    var viewer = JsChartViewer.get('ta_chart');
    viewer.hideObj("toolTipBox");
}
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
            if(k == 'dashboard-report-range')
            {
                date = v.split('|');
                start = date[0].split('-');
                end = date[1].split('-');
                start = start[1]+'/'+start[2]+'/'+start[0];
                end = end[1]+'/'+end[2]+'/'+end[0];
                $("#dashboard-report-range").data('daterangepicker').setStartDate(start);
                //use end if user want to store end date;
                $('#dashboard-report-range').data('daterangepicker').setEndDate(moment());
                $('#dashboard-report-range').attr('data-range', date[0]+'|{{date('Y-m-d')}}');
                $('#dashboard-report-range span').html(moment(date[0], "YYYY-MM-DD").format('MMM DD, YYYY') +' - {{date('M d, Y')}}'); //'data-range',

            }else{
                $('#'+k).val(v);
                $('#'+k).trigger('change');    
            }


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
        fields['Indicators'] = $('#Indicators').val();
        fields['mov1'] = $('#mov1').val();
        fields['mov2'] = $('#mov2').val();
        fields['touchspin_demo1'] = $('#touchspin_demo1').val();
        fields['touchspin_demo2'] = $('#touchspin_demo2').val();
        fields['dashboard-report-range'] = $('#dashboard-report-range').attr('data-range');
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

        var chartRange = $('#dashboard-report-range').attr("data-range");
        //var chartRange='2012-10-25|2013-04-25';
        var url = "{{ url('/ta/ajax/') }}";

        // var comparewith=$('#comparewith').val();
        var comparewith = 'null';
        if ($('#shareList').val() == "") {
            sharelist = "DSEX";
        } else {
            sharelist = $('#shareList').val();
        }

        url = url + "/" + chartRange + "/" + sharelist + "/" + comparewith + "/" + $('#Indicators').val() + "/" + $('#configure').val() + "/" + $('#charttype').val() + "/" + $('#overlay').val() + "/" + $('#mov1').val() + "/" + $('#touchspin_demo1').val() + "/" + $('#mov2').val() + "/" + $('#touchspin_demo2').val() + "/" + $('#adj').val(); //+ "/" + $('#interval').val();
            url += '?width='+$("#chartContainer").width();
            url += '&height='+$(window).height();

        var companyDetailsUrl = 'http://www.new.stockbangladesh.com/TechnicalAnalysis/company_details/' + sharelist
        var marketDepthUrl = 'http://www.new.stockbangladesh.com/TechnicalAnalysis/market_depth/' + sharelist

        $('#portlet_tab2_company').attr("data-url", companyDetailsUrl);
        $('#portlet_tab1_market_depth').attr("data-url", marketDepthUrl);

        $.get(url, function (data) {
                  //  App.unblockUI('#testdiv');
                    content.html(data);
            // JsChartViewer.hideObj('all');
            // var viewer = JsChartViewer.get('ta_chart');
            // Draw track cursor when mouse is moving over plotarea
            // viewer.attachHandler(["MouseMovePlotArea", "TouchStartPlotArea", "TouchMovePlotArea", "ChartMove", "Now"],
            // function(e) {
            //     this.preventDefault(e);   // Prevent the browser from using touch events for other actions
            //         if($('#taChartTab').hasClass('active') && $('.toggle-button').attr('data-state') == 'open' )
            //         {
            //             // traceFinance(viewer, viewer.getPlotAreaMouseX());                        

            //         }
            // });

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




    $(function() {
        var chartRange;
        jQuery().daterangepicker && ($("#dashboard-report-range").daterangepicker({
            startDate: moment().subtract('days', 252),
            endDate: moment(),
            minDate: '01/01/1999',
            maxDate: moment(),
           showCustomRangeLabel: true,
            // showDropdowns: true,
            // showWeekNumbers: true,
            // timePicker: false,
            ranges: {
                //  'Last 7 Days': [moment().subtract('days', 6), moment()],
                //  'Last 30 Days': [moment().subtract('days', 29), moment()],
                //  'This Month': [moment().startOf('month'), moment().endOf('month')],
                //  'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                '4 months': [moment().subtract('month', 4), moment()],
                '6 months': [moment().subtract('month', 6), moment()],
                '1 year': [moment().subtract('year', 1), moment()],
                '2 year': [moment().subtract('year', 2), moment()],
                '3 year': [moment().subtract('year', 3), moment()],
                '4 year': [moment().subtract('year', 4), moment()],
                '5 year': [moment().subtract('year', 5), moment()],
                '6 year': [moment().subtract('year', 6), moment()],
                '7 year': [moment().subtract('year', 7), moment()]
            },
            locale: {
                format: "MM/DD/YYYY",
                separator: " - ",
                applyLabel: "Apply",
                cancelLabel: "Cancel",
                fromLabel: "From",
                toLabel: "To",
                customRangeLabel: "Custom",
                daysOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                firstDay: 1
            },
            opens: App.isRTL() ? "right" : "left"
        }, function (e, t, a) {
            $("#dashboard-report-range span").html(e.format("MMM D, YYYY") + " - " + t.format("MMM D, YYYY"))
            chartRange=e.format('YYYY-MM-DD')+'|'+t.format('YYYY-MM-DD');
            $('#dashboard-report-range').attr("data-range",chartRange);
        }), $("#dashboard-report-range span").html(moment().subtract("days", 120).format("MMM D, YYYY") + " - " + moment().format("MMM D, YYYY")), $("#dashboard-report-range").show())

        $('#dashboard-report-range span').html(moment().subtract('days', 120).format('MMM D, YYYY') + ' - ' + moment().format('MMM D, YYYY'));
        chartRange=moment().subtract('days', 120).format('YYYY-MM-DD') + '|' + moment().format('YYYY-MM-DD');
        $('#dashboard-report-range').attr("data-range",chartRange);



    $('#tab5').click(function() {
        App.blockUI({
            target: '#basic',
            overlayColor: 'none',
            cenrerY: true,
            animate: true
        });

        window.setTimeout(function() {
            App.unblockUI('#basic');
        }, 2000);
    });

    $("#Button1")
        .on("click", function () {
            loadChart();
        })
    $("#Button2")
        .on("click", function () {
            loadChart();
        })



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

		$('#adj, #configure, #charttype, #overlay, #Indicators, #mov1, #mov2, #touchspin_demo1, #touchspin_demo2, #dashboard-report-range').change(function () {
            // if($(this).attr('id') == 'interval')
            // {
            //     if($(this).val() != {{24*60*60}})
            //     {
            //         $('#adj').val(0);
            //         $('#adj').trigger('change');
            //     return;
            //     }
            // }

            // if($(this).attr('id') == 'adj')
            // {
            //     if($(this).val() == 1)
            //     {
            //         $('#interval').val( {{24*60*60}});
            //         $('#interval').trigger('change');

            //     }
            // }
			loadChart();
		});
	})

		$('#dashboard-report-range').on('hide.daterangepicker', function () {
			loadChart();
		});
</script>
@endpush