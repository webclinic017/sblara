<!-- following style is to solve highchart problem in hidden tab-->

        <div class="portlet light " id="chart_portlet{{ $id }}">
            <div class="portlet-title tabbable-line">
                <div class="caption">
                    <i class="icon-globe font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase"></span>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#chart{{ $id }}" aria-controls="chart{{ $id }}" class="active" data-toggle="tab" aria-expanded="true"> Minute chart </a>
                    </li>
                    <li class="">
                        <a href="#Market_depth{{ $id }}" aria-controls="Market_depth{{ $id }}" data-toggle="tab" aria-expanded="false" id="marketBtn{{ $id }}"> Market Depth </a>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">


                <!--BEGIN TABS-->
                <div class="tab-content">
                    <div class="tab-pane active" id="chart{{ $id }}">
                                    <div class="row" >
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <select name="symbol{{ $id }}" id="symbol{{ $id }}" class="form-control selectpicker" data-live-search="true">
                                                <option value="-1">-- Select Symbol --</option>
                                                @foreach ($instruments as $element)
                                                    <option value="{{ $element->id }}">{{ $element->instrument_code }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                                            <select name="period{{ $id }}" id="period{{ $id }}" class="form-control selectpicker" data-live-search="true">
                                                <option value="-1">Time range</option>
                                                <option value="15">15 Minute</option>
                                                <option value="30">30 Minute</option>
                                                <option value="45">45 Minute</option>
                                                <option value="60">1 Hour</option>
                                                <option value="120">2 Hour</option>
                                                <option value="1440">Full Day</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="clearfix margin-bottom-10"> </div>

<div id="chart_placeholder{{ $id }}" >

    <div id="displayDiv{{ $id }}">
        <div id="monitor_chart{{ $id }}"></div>
    </div>

    <div class="btn-group btn-group-xs btn-group-justified">
            <a href="javascript:;" class="btn red" id="todayBtn{{ $id }}">Today </a>
            <a href="javascript:;" class="btn green" id="yDayBtn{{ $id }}"> Yday </a>
            <a href="javascript:;" class="btn green" id="2DayBtn{{ $id }}"> 2 day ago </a>
            <a href="javascript:;" class="btn green" id="3DayBtn{{ $id }}"> 3 day ago </a>
   </div>

   {{-- <div class="btn-group btn-group-xs btn-group-justified">
        <a href="javascript:;" class="btn red" id="todayBtn{{ $id }}">Today </a>
        <a href="javascript:;" class="btn blue" id="stockBtn{{ $id }}">Stock Ch. </a>
        <a href="javascript:;" class="btn red"  >Full VPA</a>
        <a href="javascript:;" class="btn green" id="yDayBtn{{ $id }}"> Yday </a>
    </div>--}}
   {{-- <div class="clearfix margin-bottom-10"> </div>

    <div class="btn-group btn-group-xs btn-group-justified">
        <a href="javascript:;" class="btn red" id="total{{ $id }}"> T: </a>
        <a href="javascript:;" class="btn blue" id="bull{{ $id }}"> B: </a>
        <a href="javascript:;" class="btn red"  id="neutral{{ $id }}">N: </a>
        <a href="javascript:;" class="btn green" id="bear{{ $id }}"> Be: </a>
    </div>--}}

</div>
                                    </div>


                    </div>
                    <div class="tab-pane" id="Market_depth{{ $id }}">
                        <div class="row" id="marketDiv{{ $id }}" >

                        </div>
                    </div>
                </div>
                <!--END TABS-->
            </div>
        </div>


<script>
$(document).ready(function(){
    @if (!Auth::guest())
        document.getElementById('symbol{{ $id }}').value = 
            {{ (isset($savedUserData['symbols'][$id]))? $savedUserData['symbols'][$id]: -1 }};
        document.getElementById('period{{ $id }}').value = 
        {{ (isset($savedUserData['periods'][$id]))? $savedUserData['periods'][$id]: -1 }};
    
    @else
        document.getElementById('symbol{{ $id }}').value = getCookie('symbol{{ $id }}');
        document.getElementById('period{{ $id }}').value = getCookie('period{{ $id }}');
    @endif
    $("#stockBtn{{ $id }}").click(function(){
       document.getElementById('displayDiv{{ $id }}').innerHTML = '<img src="{{ url('img/candlestick.jpg')}}" width="100%" height = "200"></img>'; 
    });
    $("#marketBtn{{ $id }}").click(function(){
    inst = document.getElementById('symbol{{ $id }}').value;
       get_url = "{{ url('/ajax/market/') }}"+'/'+inst;

      document.getElementById('marketDiv{{ $id }}').innerHTML = depthLoading();
        
        $.ajax({url: get_url, success: function(result){ 
            document.getElementById('marketDiv{{ $id }}').innerHTML = result;
            }
        }); 
    });

    function drawChart{{ $id }}(get_url) {
        $.ajax({url: get_url, success: function(result){
            document.getElementById('chart_placeholder{{ $id }}').style.display = 'block';
            var returnData = result;

            if(window.se_chart{{$id}} )
            {
                window.se_chart{{$id}} ++;
            }else{
                window.se_chart{{$id}} = 1;
            }
            if(window.se_chart{{$id}} == 15){
                location.reload();
            }
            $("#monitor_chart{{ $id }}").highcharts({
                                                     chart: {
                                                         zoomType: 'xy',
                                                         defaultSeriesType: 'spline',
                                                        // plotBackgroundImage: 'http://www.new.stockbangladesh.com/img/chart_logo.gif',
                                                         events: {
                                                             load: function() {
                                                                 this.renderer.image('http://www.new.stockbangladesh.com/img/chart_logo.gif', this.chartWidth/2.5, this.chartHeight/2.5, 86, 63).add();  // add image(url, x, y, w, h)
                                                             }
                                                         },
                                                         showAxes: true,
                                                         shadow: false,
                                                         borderWidth: 1,
                                                         borderColor: "#D5DAE0",

                                                         spacingLeft: 2,
                                                         spacingRight: 2
                                                       //  ,height: returnData.height   // if height defined, scalling is not taking full canvas


                                                     },
                                                     exporting: {
                                                         buttons: {
                                                             contextButton: {
                                                                 menuItems: [

                                                                     {
                                                                         textKey: 'downloadPNG',
                                                                         onclick: function () {
                                                                             this.exportChart({filename: 'StockBangladesh_minute-chart'});
                                                                         }
                                                                     }]
                                                             }
                                                         }
                                                     },
                                                     title: {
                                                         //text: '"'+returnData.instrumentInfo+'"',
                                                         text: '<b>'+returnData.instrumentInfo+'</b>: '+returnData.lm_date_time,
                                                         style: {
                                                             fontSize: '12px'
                                                         },
                                                         margin: 1

                                                     },
                                                     subtitle: {
                                                         text: 'Total Vol: <b>'+returnData.day_total_volume+'</b> Bull: '+returnData.bullBear[0].totalBull+' Bear: '+returnData.bullBear[0].totalBear+' Neutral: '+returnData.bullBear[0].totalNeutral,
                                                         useHTML: true,
                                         //floating: true,
                                                         y: 23,
                                                         style: {
                                                             fontSize: '10px'
                                                         }
                                         //margin: 50
                                                     },

                                                     xAxis: [
                                                         {
                                                             categories: returnData.xcat
                                                                 //'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                                                             ,
                                                             tickInterval: 1,
                                                             crosshair: true,
                                                             labels: {
                                                                 enabled: true,
                                                                 rotation: -90,
                                                                 align: 'right'

                                                                 //x:10,
                                                             }

                                                         }
                                                     ],
                                                     yAxis: [
                                                         { // Primary yAxis

                                                             title: {
                                                                 /* text: 'Price',
                                                                  style: {
                                                                  color: Highcharts.getOptions().colors[1]
                                                                  }*/
                                                                 text: ''
                                                             },
                                                             id: 'y_price',
                                                             enabled: false
                                                         },
                                                         { // Secondary yAxis
                                                             title: {
                                                                 text: ''
                                                             },
                                                             enabled: false,
                                                             labels: {
                                                                 format: '{value}',
                                                                 style: {
                                                                     color: '#1BA39C'
                                                                 }
                                                             },
                                                             id: 'y_volume',
                                                             opposite: true
                                                         }
                                                     ],
                                                     tooltip: {
                                                         shared: true
                                                     },
                                                     credits: {
                                                         enabled: true,
                                                         href: "http://www.stockbangladesh.com",
                                                         text: "stockbangladesh.com",
                                                         style: {
                                                             color: '#4572A7'

                                                         },
                                                         position: {
                                                             align: 'right',
                                                             verticalAlign: 'bottom'
                                                             /*  x: 5,
                                                              y: 15*/
                                                         }
                                                     },
                                                     legend: {
                                                         enabled: false
                                                         //layout: 'vertical',
                                                         /*   align: 'left',
                                                          verticalAlign: 'bottom'*/
                                                         /* x: 120,
                                                          verticalAlign: 'top',
                                                          y: 100,*/
                                                         /*  floating: true,
                                                          backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'*/
                                                     },
                                                     series: [
                                                         {
                                                             name: 'Volume',
                                                             type: 'column',
                                                             color: '#8CC152',
                                                             yAxis: 0,
                                                             data: returnData.ydata,
                                                             tooltip: {
                                                                 valueSuffix: ''
                                                             }

                                                         },
                                                         {
                                                             name: 'Price',
                                                             type: 'spline',
                                                             //color: '"'+returnData.price_chart_color+'"',
                                                             color: returnData.price_chart_color,
                                                             //color: '#26C281',
                                                             yAxis: 1,
                                                             marker: {
                                                                 radius: 3
                                                             },
                                                             data: returnData.xdata,
                                                             tooltip: {
                                                                 valueSuffix: ''
                                                             }
                                                         }
                                                         ,
                                                         {
                                                             type: 'pie',
                                                             name: 'BullBear',
                                                             data: [{
                                                                 name: 'Bull Vol',
                                                                 y: returnData.bullBear[0].totalBull,
                                                                 color: '#1BA39C' // bear
                                                             }, {
                                                                 name: 'Bear Vol',
                                                                 y: returnData.bullBear[0].totalBear,
                                                                 color: '#EF4836' // Bear color
                                                             }, {
                                                                 name: 'Neutral Vol',
                                                                 y: returnData.bullBear[0].totalNeutral,
                                                                 color: '#ACB5C3'// Neutral
                                                             }],
                                                             center: [30, 20],
                                                             size: 60,
                                                             showInLegend: false,
                                                             dataLabels: {
                                                                 enabled: false
                                                             }
                                                         }



                                                     ],
                                                     responsive: {
                                                         rules: [{
                                                             condition: {
                                                                 maxWidth: 500
                                                             }

                                                         }]
                                                     }
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
        get_url = "{{ url('/ajax/monitor/') }}/" + inst + "/" + period+"/1";
        drawChart{{ $id }}(get_url);

    });

    $("#2DayBtn{{ $id }}").click(function(){
            inst = document.getElementById('symbol{{ $id }}').value;
            if(inst < 0) {
                document.getElementById('chart_placeholder{{ $id }}').style.display = 'none';
                return;
            }
            document.getElementById('displayDiv{{ $id }}').innerHTML = '<div id="monitor_chart{{ $id }}"></div>';

            period = document.getElementById('period{{ $id }}').value;
            get_url = "{{ url('/ajax/monitor/') }}/" + inst + "/" + period+"/2";
            drawChart{{ $id }}(get_url);

        });

    $("#3DayBtn{{ $id }}").click(function(){
            inst = document.getElementById('symbol{{ $id }}').value;
            if(inst < 0) {
                document.getElementById('chart_placeholder{{ $id }}').style.display = 'none';
                return;
            }
            document.getElementById('displayDiv{{ $id }}').innerHTML = '<div id="monitor_chart{{ $id }}"></div>';

            period = document.getElementById('period{{ $id }}').value;
            get_url = "{{ url('/ajax/monitor/') }}/" + inst + "/" + period+"/3";
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

     setInterval(ref{{ $id }}, 60000);
    
});


</script>
