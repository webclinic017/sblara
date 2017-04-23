<!-- following style is to solve highchart problem in hidden tab-->
<script src="{{ url('/js/jquery-2.2.4.js')}}"></script>

<link rel="stylesheet" href="{{ url('/bootstrap-select/css/bootstrap-select.min.css') }}">
<script src="{{ url('/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script src="{{ url('/bootstrap-select/js/i18n/defaults-*.min.js')}}"></script>

<style>
    .tab-content > .tab-pane,
    .pill-content > .pill-pane {
        display: block;     /* undo display:none          */
        height: 0;          /* height:0 is also invisible */
        overflow-y: hidden; /* no-overflow                */
    }
    .tab-content > .active,
    .pill-content > .active {
        height: auto;       /* let the content decide it  */
    } /* bootstrap hack end */

</style>
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    <div class="portlet light" id="chart_portlet">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="icon-pin font-green-sharp"></i>
                                     <span class="caption-subject font-green-sharp bold uppercase">
                                     1 Minute Volume Price Analysis </span>
            </div>
            
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <label>Select Symbol</label>
                    <select name="symbol" id="symbol" class="form-control selectpicker" data-live-search="true">
                        <option value="-1">-- Select One --</option>
                        @foreach ($instruments as $element)
                            <option value="{{ $element->id }}">{{ $element->instrument_code }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <label>Select Interval</label>
                    <select name="period" id="period" class="form-control selectpicker" data-live-search="true">
                        <option value="-1">-- Select One --</option>
                        <option value="15">15 Minute</option>
                        <option value="30">30 Minute</option>
                        <option value="45">45 Minute</option>
                        <option value="60">1 Hour</option>
                        <option value="120">2 Hour</option>
                        <option value="1440">Full Day</option>
                    </select>
                </div>
            </div>
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#chart" aria-controls="chart" role="tab" data-toggle="tab">Chart</a>
                    </li>
                    <li role="presentation">
                        <a href="#Market_depth" aria-controls="Market_depth" role="tab" data-toggle="tab" id="marketBtn">Market Depth</a>
                    </li>
                </ul>
            
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="chart">
                        <div class="row" id="chart_placeholder" style="display: none;">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row" id="displayDiv" style="padding: 5px;">
                                <div id="monitor_chart"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" 
                                style="background: black; color: white; min-height: 1.8em;padding-top: 2px;" id="total">Total: </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" 
                                style="background: #5cb85c !important; color: white; min-height: 1.8em;padding-top: 2px;" id="bull">Bull: </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" 
                                style="background: #5bc0de !important; color: white; min-height: 1.8em;padding-top: 2px;" id="neutral">Neutral: </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" 
                                style="background: #d9534f !important; color: white; min-height: 1.8em;padding-top: 2px;" id="bear">Bear: </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 5px;">
                                    <button type="button" class="btn btn-success" style="width: 100%" id="todayBtn">&nbsp; Today</button>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 5px;">
                                    <button type="button" class="btn btn-primary" style="width: 100%" id="stockBtn">&nbsp; Stock Shart</button>
                                </div>                        
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 5px;">
                                    <button type="button" class="btn btn-primary" style="width: 100%" >&nbsp; Full VPA</button>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 5px;">
                                    <button type="button" class="btn btn-primary" style="width: 100%" id="yDayBtn">&nbsp; Yesterday</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="Market_depth">
                    <div class="row" id="marketDiv" style="padding: 5px;">
                                
                    </div>
                </div>
                </div>
            </div>
            
                
            
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ URL::asset('metronic_custom/highstock/code/js/highstock.js') }}"></script>


<script>
$(document).ready(function(){
    $("#stockBtn").click(function(){
       document.getElementById('displayDiv').innerHTML = '<img src="" width="100%"></img>'; 
    });
    $("#marketBtn").click(function(){
       get_url = "{{ url('/ajax/market') }}";
        
        $.ajax({url: get_url, success: function(result){ 
            document.getElementById('marketDiv').innerHTML = result;
            }
        }); 
    });

    function drawChart(get_url) {
        $.ajax({url: get_url, success: function(result){
            document.getElementById('chart_placeholder').style.display = 'block';

            var returnData = JSON.parse(result);
            var total = 0 + returnData.bear + returnData.neutral + returnData.bull;
            document.getElementById('total').innerHTML = 'Total: ' + total;
            document.getElementById('bull').innerHTML = 'Bull: ' + returnData.bull;
            document.getElementById('neutral').innerHTML = 'Neutral: ' + returnData.neutral;
            document.getElementById('bear').innerHTML = 'Bear: ' + returnData.bear;
            $("#monitor_chart").highcharts({
                chart: {
                    zoomType: 'xy',
                    height: 400
                },
                title: {
                    text: null
                },
                subtitle: {

                },

                xAxis: {
                    type: 'datetime',
                    dateTimeLabelFormats: { // don't display the dummy year
                        day: '%e of %b',
                        minute: '%H:%M',
                        hour: '%H:%M'
                    },

                    title: null
                },
                yAxis: [{ // Primary yAxis
                    gridLineDashStyle: 'longdash',
                    lineColor: '#d2d2d2',
                    lineWidth: 1,
                    tickInterval: null,
                    maxPadding: 0.1,
                    labels: {
                        format: '{value}',
                        
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    title: null
                }, { // Secondary yAxis
                    gridLineDashStyle: 'longdash',
                    lineColor: '#d2d2d2',
                    lineWidth: 1,
                    tickInterval: null,
                    maxPadding: 0.8,
                    title: null,
                    labels: {
                        format: '{value}',
                        
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    opposite: true
                }],
                tooltip: {
                    shared: false,
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x: %H:%M}  {point.name} | {point.y:.2f} '
                },
                credits: {
                    enabled: true,
                    href: "http://www.stockbangladesh.com",
                    text: "stockbangladesh.com",
                    style: {
                        color: '#4572A7'

                    },
                    position: {
                        align: 'left',
                        verticalAlign: 'top',
                        x: 5,
                        y: 395
                    }
                },
                legend: {
                    enabled: false

                },
                plotOptions: {
                    series: {
                        pointWidth: 20,
                        groupPadding: 0
                    }
                },
                series: [ {
                    name: 'Volume',
                    type: 'column',
                    color: '#4572A7',
                    yAxis: 1,
                    data: returnData.volumeData

                }, {
                    name: 'Close Price',
                    type: 'line',
                    color: '#89A54E',
                    marker: {
                        radius: 1
                    },
                    data: returnData.priceData
                }, {
                    type: 'pie',
                    name: 'Summary',
                    data: [{
                        name: 'Bear',
                        y: returnData.bear,
                        color: '#d9534f'
                    }, {
                        name: 'Bull',
                        y: returnData.bull,
                        color: '#5cb85c'
                    }, {
                        name: 'Neutral',
                        y: returnData.neutral,
                        color: '#5bc0de' 
                    }
                    ],
                    center: [500, 60],
                    size: 150,
                    showInLegend: true,
                    legend: true,
                    dataLabels: {
                        enabled: false
                    }
                }]
            });
        }});
    }

    $("#yDayBtn").click(function(){
        inst = document.getElementById('symbol').value;
        if(inst < 0) {
            document.getElementById('chart_placeholder').style.display = 'none';
            return;
        }
        document.getElementById('displayDiv').innerHTML = '<div id="monitor_chart"></div>';

        period = document.getElementById('period').value;
        get_url = "{{ url('/ajax/yDay/') }}/" + inst + "/" + period;
        drawChart(get_url);

    });
    $("#todayBtn").click(function(){
        $("#symbol").trigger('change');
    });
    $("select").change(function(){
        inst = document.getElementById('symbol').value;
        if(inst < 0) {
            document.getElementById('chart_placeholder').style.display = 'none';
            return;
        }
        document.getElementById('displayDiv').innerHTML = '<div id="monitor_chart"></div>';

        period = document.getElementById('period').value;
        get_url = "{{ url('/ajax/monitor/') }}/" + inst + "/" + period;
        
        drawChart(get_url);
    });
    
    if(document.getElementById('symbol').value != -1) 
        $("#symbol").trigger('change');
    
});


</script>


@endpush