<!-- following style is to solve highchart problem in hidden tab-->

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 5px; !important">
    <div class="portlet light" id="chart_portlet{{ $id }}">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="icon-pin font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">
                                     1 Minute Volume Price Analysis </span>
            </div>
            
        </div>
        <div class="portlet-body">
            <div class="row" style="padding: 10px;">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <label>Select Symbol</label>
                    <select name="symbol{{ $id }}" id="symbol{{ $id }}" class="form-control selectpicker" data-live-search="true">
                        <option value="-1">-- Select One --</option>
                        @foreach ($instruments as $element)
                            <option value="{{ $element->id }}">{{ $element->instrument_code }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <label>Select Interval</label>
                    <select name="period{{ $id }}" id="period{{ $id }}" class="form-control selectpicker" data-live-search="true">
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
                        <a href="#chart{{ $id }}" aria-controls="chart{{ $id }}" role="tab" data-toggle="tab">Chart</a>
                    </li>
                    <li role="presentation">
                        <a href="#Market_depth{{ $id }}" aria-controls="Market_depth{{ $id }}" role="tab" data-toggle="tab" id="marketBtn{{ $id }}">Market Depth</a>
                    </li>
                </ul>
            
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="chart{{ $id }}">
                        <div class="row" id="chart_placeholder{{ $id }}" style="display: none;margin: 0px;">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row" id="displayDiv{{ $id }}" style="padding: 5px;">
                                <div id="monitor_chart{{ $id }}"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" 
                                style="background: black; color: white; min-height: 1.8em;padding-top: 2px;" id="total{{ $id }}">Total: </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" 
                                style="background: #5cb85c !important; color: white; min-height: 1.8em;padding-top: 2px;" id="bull{{ $id }}">Bull: </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" 
                                style="background: #5bc0de !important; color: white; min-height: 1.8em;padding-top: 2px;" id="neutral{{ $id }}">Neutral: </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" 
                                style="background: #d9534f !important; color: white; min-height: 1.8em;padding-top: 2px;" id="bear{{ $id }}">Bear: </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 1px;">
                                    <button type="button" class="btn btn-success" style="width: 100%" id="todayBtn{{ $id }}">Today</button>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 1px;">
                                    <button type="button" class="btn btn-primary" style="width: 100%" id="stockBtn{{ $id }}">Stock Ch.</button>
                                </div>                        
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 1px;">
                                    <button type="button" class="btn btn-primary" style="width: 100%" >Full VPA</button>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding: 1px;">
                                    <button type="button" class="btn btn-primary" style="width: 100%" id="yDayBtn{{ $id }}">Yesterday</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="Market_depth{{ $id }}">
                    <div class="row" id="marketDiv{{ $id }}" style="padding: 5px; margin-left: -15%">
                                
                    </div>
                </div>
                </div>
            </div>
            
                
            
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    @if (!Auth::guest())
        document.getElementById('symbol{{ $id }}').value = 
            {{ (isset($savedUserData['symbols'][$id]))? $savedUserData['symbols'][$id]: -1 }};
        document.getElementById('period{{ $id }}').value = 
        {{ (isset($savedUserData['periods'][$id]))? $savedUserData['periods'][$id]: -1 }};
    @endif

    document.getElementById('symbol{{ $id }}').value = getCookie('symbol{{ $id }}');
    document.getElementById('period{{ $id }}').value = getCookie('period{{ $id }}');
    $("#stockBtn{{ $id }}").click(function(){
       document.getElementById('displayDiv{{ $id }}').innerHTML = '<img src="{{ url('img/candlestick.jpg')}}" width="100%" height = "200"></img>'; 
    });
    $("#marketBtn{{ $id }}").click(function(){
       get_url = "{{ url('/ajax/market') }}";
        
        $.ajax({url: get_url, success: function(result){ 
            document.getElementById('marketDiv{{ $id }}').innerHTML = result;
            }
        }); 
    });

    function drawChart{{ $id }}(get_url) {
        $.ajax({url: get_url, success: function(result){
            document.getElementById('chart_placeholder{{ $id }}').style.display = 'block';

            var returnData = JSON.parse(result);
            var total = 0 + returnData.bear + returnData.neutral + returnData.bull;
            document.getElementById('total{{ $id }}').innerHTML = '<center>Total </center><center>' + total + '</center>';
            document.getElementById('bull{{ $id }}').innerHTML = '<center>Bull </center><center>' + returnData.bull + '</center>';
            document.getElementById('neutral{{ $id }}').innerHTML = '<center>Neutral </center><center>' + returnData.neutral + '</center>';
            document.getElementById('bear{{ $id }}').innerHTML = '<center>Bear </center><center>' + returnData.bear + '</center>';
            //alert('test');
            $("#monitor_chart{{ $id }}").highcharts({
                chart: {
                    zoomType: 'xy',
                    height: 200,
                    events: {
                        load: function() {
                            this.renderer.image('{{ url('/img/chart_logo.gif') }}', this.chartWidth/3.5, this.chartHeight/5, 86, 63).add(); 
                        }
                    }
                },
                title: {
                    text: null
                },
                subtitle: {

                },
                            
                xAxis: {
                    type: 'datetime',
                    tickInterval: 1,
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
                    name: 'Bear Volume',
                    type: 'column',
                    color: '#d9534f',
                    yAxis: 1,
                    pointWidth: 5,
                    data: returnData.bearVolumeData

                }, 
                {
                    name: 'Bull Volume',
                    type: 'column',
                    color: '#5bc0de',
                    yAxis: 1,
                    pointWidth: 5,
                    data: returnData.neutVolumeData

                }, 
                {
                    name: 'Neutral Volume',
                    type: 'column',
                    color: '#5cb85c',
                    yAxis: 1,
                    pointWidth: 5,
                    data: returnData.bullVolumeData

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
                    center: [200, 0],
                    size: 50,
                    showInLegend: true,
                    legend: true,
                    dataLabels: {
                        enabled: false
                    }
                }]
            });
            //alert('test2');
        }});
    }

    $("#yDayBtn{{ $id }}").click(function(){
        inst = document.getElementById('symbol{{ $id }}').value;
        if(inst < 0) {
            document.getElementById('chart_placeholder{{ $id }}').style.display = 'none';
            return;
        }
        document.getElementById('displayDiv{{ $id }}').innerHTML = '<div id="monitor_chart{{ $id }}"></div>';

        period = document.getElementById('period{{ $id }}').value;
        get_url = "{{ url('/ajax/yDay/') }}/" + inst + "/" + period;
        drawChart{{ $id }}(get_url);

    });
    $("#todayBtn{{ $id }}").click(function(){
        $("#symbol{{ $id }}").trigger('change');
    });
    $("#symbol{{ $id }}").change(function(){
        inst = document.getElementById('symbol{{ $id }}').value;
        if(inst < 0) {
            document.getElementById('chart_placeholder{{ $id }}').style.display = 'none';
            return;
        }

        for(i=0; i< 9 ; i++){
            if (i == {{ $id }}) continue;
            var sel = 'symbol' + i;
            if(document.getElementById(sel).value == inst){
                alert("Already Selected");
                document.getElementById('chart_placeholder{{ $id }}').style.display = 'none';
                return;
            }
        }
        
        document.getElementById('displayDiv{{ $id }}').innerHTML = '<div id="monitor_chart{{ $id }}"></div>';

        period = document.getElementById('period{{ $id }}').value;
        get_url = "{{ url('/ajax/monitor/') }}/" + inst + "/" + period;
        
        drawChart{{ $id }}(get_url);
        @if (Auth::guest())
            setCookie('symbol{{ $id }}', inst, 30);
            setCookie('period{{ $id }}', period, 30);
        @endif
    });

    $("#period{{ $id }}").change(function(){
        inst = document.getElementById('symbol{{ $id }}').value;
        if(inst < 0) {
            document.getElementById('chart_placeholder{{ $id }}').style.display = 'none';
            return;
        }

        for(i=0; i< 9 ; i++){
            if (i == {{ $id }}) continue;
            var sel = 'symbol' + i;
            if(document.getElementById(sel).value == inst){
                alert("Already Selected");
                document.getElementById('chart_placeholder{{ $id }}').style.display = 'none';
                return;
            }
        }
        
        document.getElementById('displayDiv{{ $id }}').innerHTML = '<div id="monitor_chart{{ $id }}"></div>';

        period = document.getElementById('period{{ $id }}').value;
        get_url = "{{ url('/ajax/monitor/') }}/" + inst + "/" + period;
        
        drawChart{{ $id }}(get_url);
        @if (Auth::guest())
            setCookie('symbol{{ $id }}', inst, 30);
            setCookie('period{{ $id }}', period, 30);
        @endif
    });
    
    if(document.getElementById('symbol{{ $id }}').value != -1) 
        $("#symbol{{ $id }}").trigger('change');
    
    function ref{{ $id }}() {
        if(document.getElementById('symbol{{ $id }}').value != -1) 
            $("#symbol{{ $id }}").trigger('change');
    }

    var myInt = setInterval(ref{{ $id }}, 60000);
    
});


</script>
