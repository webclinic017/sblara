@if(isset($_GET['dev']))
@push('css')
<link href="{{ URL::asset('metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

<div class="row">
<div class="col-md-12">
	<div class="form-group">
        <div class="input-group select2-bootstrap-prepend " style="max-width: 300px">
            <span class="input-group-btn">
                <button class="btn red mt-ladda-btn toggle-button"  type="button" data-select2-open="multi-prepend"> <i class="fa fa-line-chart"></i> Chart </button>
            </span>
              @include('html.instrument_list_bs_select',['bs_select_id'=>'shareList', 'class' => 'instrument-select select2', 'prepend' => true])
        </div>
    </div>
</div>

{{--  --}}


{{--  --}}
<div class="col-md-12 global-panel" style="background: #fff; margin-top: -15px; display: none; padding-top: 10px ">
{{--  --}}

<style>
    table td{
        color:#000 !important;
    }
</style>
<div class="row widget-row">
<div class="col-md-12 margin-bottom-20">
    <!-- BEGIN WIDGET TAB -->
    <div class=" ta-chart-tabs tabbable-custom ">
        <ul class="nav nav-tabs tabs-reversed">

            <li>
                <a href="#tab_1_3" data-url="/ajax/load_block/block_name=block.share_holdings_history_chart:instrument_id=" data-toggle="tab"> Share Holding History </a>
            </li>


            <li>
                <a href="#tab_1_3" data-url="/ajax/load_block/block_name=block.dividend_history:instrument_id=" data-toggle="tab"> Dividend History </a>
            </li>


            <li>
                <a href="#tab_1_3" data-url="/ajax/load_block/block_name=block.news_chart:instrument_id=" data-toggle="tab"> News Chart </a>
            </li>            

            <li>
                <a href="#tab_1_3" data-url="/ajax/load_block/block_name=block.news_box:instrument_id=" data-toggle="tab"> News </a>
            </li>
{{--             <li>
                <a href="#tab_1_3" data-url="/ajax/load_block/block_name=block.market_depth_single:instrument_id=" data-toggle="tab"> Company Details </a>
            </li>
            <li>
                <a href="#tab_1_3" data-url="/ajax/load_block/block_name=block.market_depth_single:instrument_id=" data-toggle="tab"> Fundamental Details </a>
            </li> --}}

         
            <li>
                <a href="#tab_1_3" data-url="/ajax/load_block/block_name=block.market_depth_single:instrument_id=" data-toggle="tab"> MARKET DEPTH </a>
            </li>            

            <li>
                <a href="#tab_1_4" data-url="/ajax/load_block/block_name=block.minute_chart:instrument_id=" data-toggle="tab"> Minute Chart </a>
            </li>

            <li class="active">
                <a href="#tab_1_1" data-url ="#" data-toggle="tab">TA Chart </a>
            </li>
        </ul>
        <div class="tab-content" >
            <div class="tab-pane fade active in" id="tab_1_1">
                <form action="index.html" class="form-horizontal ">
                    <div class="form-body" >

                        <div class="form-group " style="background: #f5f5f5; padding-top: 10px; display: inline-block; margin-right: 10px;">
							<div class="col-md-9">
                            <div class="col-md-3">
                                <div class="margin-bottom-10">
                                    <select id="adj" class="bs-select form-control" >
                                        <option value="1" selected>Adjusted Data</option>
                                        <option value="0" >Non Adjusted Data</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="margin-bottom-10">
                                    <select id="configure" class="bs-select form-control" multiple>
                                        <option value="VOLBAR" title="VOLBAR" selected="">Show volume bar</option>
                                        <option value="PSAR" title="PSAR">Parabolic SAR</option>
                                        <option value="LOG" title="LOG">Log Scale</option>
                                        <option value="PSCALE" title="PSCALE">Percentage Scale</option>
                                    </select>


                                </div>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <div class="margin-bottom-10">
                                    <select id="overlay" class="bs-select form-control ">
                                        <option value="BB" selected="">Bollinger Band</option>
                                        <option value="DC">Donchian Channel</option>
                                        <option value="Envelop">Envelop (SMA 20 +/- 10%)</option>
                                    </select>

                                </div>
                            </div>     
                       


                            <div class="col-md-2">
                                <div class="margin-bottom-10">

                                        <select id="mov1" class="bs-select form-control">
                                            <option value="SMA" selected="">Simple</option>
                                            <option value="EMA">Exponential</option>
                                            <option value="TMA">Triangular</option>
                                            <option value="WMA">Weighted</option>
                                        </select>


                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="margin-bottom-10">

                                        <input id="touchspin_demo1" type="text" value="13" name="demo1" class="form-control">


                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="margin-bottom-10">
                                    <select id="mov2" class="bs-select form-control">
                                        <option value="SMA" selected="">Simple</option>
                                        <option value="EMA">Exponential</option>
                                        <option value="TMA">Triangular</option>
                                        <option value="WMA">Weighted</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-2">

                                    <input id="touchspin_demo2" type="text" value="19" name="demo1" class="form-control">

                            </div>
                            <div class="col-md-4">
                                <div class="margin-bottom-10">
                                    <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height green" data-placement="top" data-original-title="Change dashboard date range">
                                        <i class="icon-calendar"></i>&nbsp;
                                        <span class="thin uppercase hidden-xs"></span>&nbsp;
                                        <i class="fa fa-angle-down"></i>
                                    </div>

                                </div>
                            </div>
                        </div>


                  	  <div class="col-md-3 ">
                                    <select id="Indicators" class="select2 double-row" multiple  title='Choose indicators' data-live-search="true">
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

 <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                   @include('ads.google_responsive')
                </div>
            </div>
        </div>
    </div>

            </div>
            <div class="tab-pane fade" id="tab_1_2">
            <div class="portlet light form-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-social-dribbble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">Bootstrap Select</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-cloud-upload"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-wrench"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-trash"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="index.html" class="form-horizontal form-row-seperated">
            <div class="form-body" >

            <div class="form-group">
                <label class="control-label col-md-3">Bootstrap Styles</label>
                <div class="col-md-9">
                    <div class="margin-bottom-10">
                        <select class="bs-select form-control input-small" data-style="btn-primary">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                        <select class="bs-select form-control input-small" data-style="btn-success">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                        <select class="bs-select form-control input-small" data-style="btn-info">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                        <select class="bs-select form-control input-small" data-style="btn-warning">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                        <select class="bs-select form-control input-small" data-style="btn-danger">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                        </select>
                    </div>
                </div>
            </div>

            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn green">
                            <i class="fa fa-check"></i> Submit</button>
                        <button type="button" class="btn default">Cancel</button>
                    </div>
                </div>
            </div>
            </form>
            <!-- END FORM-->
            <div id="form_modal11" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Sample Form in Modal</h4>
                        </div>
                        <div class="modal-body">
                            <form action="#" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Default</label>
                                    <div class="col-md-8">
                                        <select class="bs-select form-control">
                                            <option>Mustard</option>
                                            <option>Ketchup</option>
                                            <option>Relish</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Disabled</label>
                                    <div class="col-md-8">
                                        <select class="bs-select form-control" disabled>
                                            <option>Mustard</option>
                                            <option>Ketchup</option>
                                            <option>Relish</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Grouped</label>
                                    <div class="col-md-8">
                                        <select class="bs-select form-control">
                                            <optgroup label="Picnic">
                                                <option>Mustard</option>
                                                <option>Ketchup</option>
                                                <option>Relish</option>
                                            </optgroup>
                                            <optgroup label="Camping">
                                                <option>Tent</option>
                                                <option>Flashlight</option>
                                                <option>Toilet Paper</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn grey-salsa btn-outline" data-dismiss="modal" aria-hidden="true">Close</button>
                            <button class="btn green" data-dismiss="modal">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>
            <div class="tab-pane fade" id="tab_1_3">
                    
            </div>
            <div class="tab-pane fade" id="tab_1_4">
                <div class="widget-news margin-bottom-20">
                    <img class="widget-news-left-elem" src="../assets/layouts/layout7/img/07.jpg" alt="">
                    <div class="widget-news-right-body">
                        <h3 class="widget-news-right-body-title">San Francisco
                            <span class="label label-default"> March 10 </span>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit diam nonumy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                </div>
                <div class="widget-news margin-bottom-20">
                    <img class="widget-news-left-elem" src="../assets/layouts/layout7/img/04.jpg" alt="">
                    <div class="widget-news-right-body">
                        <h3 class="widget-news-right-body-title">New Workstation
                            <span class="label label-default"> March 16 </span>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit diam nonumy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                </div>
                <div class="widget-news margin-bottom-20">
                    <img class="widget-news-left-elem" src="../assets/layouts/layout7/img/05.jpg" alt="">
                    <div class="widget-news-right-body">
                        <h3 class="widget-news-right-body-title">Most Completed theme
                            <span class="label label-default"> March 12 </span>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit diam nonumy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                </div>
                <div class="widget-news">
                    <img class="widget-news-left-elem" src="../assets/layouts/layout7/img/03.jpg" alt="">
                    <div class="widget-news-right-body">
                        <h3 class="widget-news-right-body-title">Wondering anyone did this
                            <span class="label label-default"> March 25 </span>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit diam nonumy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    </div>
                </div>
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


    function loadChart(el) {
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

        url = url + "/" + chartRange + "/" + sharelist + "/" + comparewith + "/" + $('#Indicators').val() + "/" + $('#configure').val() + "/" + $('#charttype').val() + "/" + $('#overlay').val() + "/" + $('#mov1').val() + "/" + $('#touchspin_demo1').val() + "/" + $('#mov2').val() + "/" + $('#touchspin_demo2').val() + "/" + $('#adj').val();

        var companyDetailsUrl = 'http://www.new.stockbangladesh.com/TechnicalAnalysis/company_details/' + sharelist
        var marketDepthUrl = 'http://www.new.stockbangladesh.com/TechnicalAnalysis/market_depth/' + sharelist

        $('#portlet_tab2_company').attr("data-url", companyDetailsUrl);
        $('#portlet_tab1_market_depth').attr("data-url", marketDepthUrl);


        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            async: false,
            dataType: "html"


        }).done(function (data) {
          //  App.unblockUI('#testdiv');
            content.html(data);
    // JsChartViewer.hideObj('all');
    var viewer = JsChartViewer.get('ta_chart');
    // Draw track cursor when mouse is moving over plotarea
    viewer.attachHandler(["MouseMovePlotArea", "TouchStartPlotArea", "TouchMovePlotArea", "ChartMove", "Now"],
    function(e) {
        this.preventDefault(e);   // Prevent the browser from using touch events for other actions
            if($('#tab_1_1').hasClass('active'))
            {
                traceFinance(viewer, viewer.getPlotAreaMouseX());

            }
    });



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
            dateLimit: {
                days: 3000
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            "showCustomRangeLabel": false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
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
            $("#dashboard-report-range span").html(e.format("MMMM D, YYYY") + " - " + t.format("MMMM D, YYYY"))
            chartRange=e.format('YYYY-MM-DD')+'|'+t.format('YYYY-MM-DD');
            $('#dashboard-report-range').attr("data-range",chartRange);
        }), $("#dashboard-report-range span").html(moment().subtract("days", 120).format("MMMM D, YYYY") + " - " + moment().format("MMMM D, YYYY")), $("#dashboard-report-range").show())

        $('#dashboard-report-range span').html(moment().subtract('days', 120).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
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
            loadChart($(this));
        })
    $("#Button2")
        .on("click", function () {
            loadChart($(this));
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
		$('.instrument-select').change(function () {
			if($('.toggle-button').data('state') != 'open')
			{
			$('.toggle-button').attr('data-state', 'open');
				$('.global-panel').slideDown();
			}
			var e = $('.ta-chart-tabs li[class="active"] a');
			var url = e.data('url');

			if(url == '#')
			{
            	loadChart($(this));
			}else{
				loadFundamental(e);
			}
		});

		$('.toggle-button').click(function () {
			$('.select2-container').trigger('click');
			if($(this).data('state') == 'open')
			{
				$(this).html("<i class='fa fa-close'></i> Close");
				$(this).attr('data-state', 'close');
				
			}else{
				
				$(this).html("<i class='fa fa-line-chart'></i> Chart");
				$(this).attr('data-state', 'open');
				
			}

		});
	})
</script>
@endpush
@endif