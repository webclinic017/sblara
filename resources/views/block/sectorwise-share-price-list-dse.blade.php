@foreach($sector_up_down_details as $sector_up_down)

        <div class="row">
                                    <div class="col-lg-12 col-xs-12 col-sm-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption caption-md">
                                                    <i class="icon-bar-chart font-dark hide"></i>
                                                    <span class="caption-subject font-dark bold uppercase">{{$sector_list[$sector_up_down->sector_list_id]->name}}</span>
                                                    <span class="caption-helper"></span>
                                                </div>
                                                 <div class="tools">

                                                    <a href="" class="collapse">
                                                    </a>

                                                    </a>
                                                    <a href="" class="remove">
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-scrollable table-scrollable-borderless">
                                                    <table class="table table-hover table-light">
                                                        <thead>
                                                            <tr class="uppercase">
                                                                <th colspan="2"> Share </th>
                                                                <th>15 min vol</th>
                                                                <th>15 min ltp</th>
                                                                <th> LTP </th>
                                                                <th> High </th>
                                                                <th> Low </th>
                                                                <th> Vol </th>
                                                                <th> Value </th>
                                                            </tr>
                                                        </thead>
                                                {{--@foreach($last_15_minutes_data[$sector_up_down->sector_list_id] as $instrument)--}}
                                                @foreach($instrument_list_grouped_by_sector[$sector_up_down->sector_list_id] as $instrument)
                                                      @if(isset($last_15_minutes_data[$instrument->id]))

                                                        <tr>
                                                            <td class="fit">
                                                                {{--<img class="user-pic rounded" src="{{ URL::asset('img/up_arrow.png') }}"> </td>--}}
                                                            <td>
                                                                <a href="javascript:;" class="primary-link">{{$instrument->instrument_code}}</a>
                                                            </td>
                                                            <td> <div id="sparkline_vol_{{$instrument->id}}"></div> </td>
                                                            <td> <div id="sparkline_ltp_{{$instrument->id}}"></div> </td>
                                                            <td> {{$last_15_minutes_data[$instrument->id][0]->close_price}} </td>
                                                            <td> {{$last_15_minutes_data[$instrument->id][0]->high_price}} </td>
                                                            <td> {{$last_15_minutes_data[$instrument->id][0]->low_price}} </td>
                                                            <td>
                                                                <span class="bold theme-font">{{$last_15_minutes_data[$instrument->id][0]->total_volume}}</span>
                                                            </td>
                                                            <td> {{$last_15_minutes_data[$instrument->id][0]->total_value}} </td>
                                                        </tr>
                                                        @endif
                                                @endforeach

                                                        {{--<tr>
                                                            <td class="fit">
                                                                <img class="user-pic rounded" src="{{ URL::asset('img/equal.png') }}"> </td>
                                                            <td>
                                                                <a href="javascript:;" class="primary-link">Nick</a>
                                                            </td>
                                                            <td> $560 </td>
                                                            <td> 12 </td>
                                                            <td> 24 </td>
                                                            <td>
                                                                <span class="bold theme-font">67%</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fit">
                                                                <img class="user-pic rounded" src="{{ URL::asset('img/down_icon.png') }}">
                                                             </td>
                                                            <td>
                                                                <a href="javascript:;" class="primary-link">Tim</a>
                                                            </td>
                                                            <td> $1,345 </td>
                                                            <td> 450 </td>
                                                            <td> 46 </td>
                                                            <td>
                                                                <span class="bold theme-font">98%</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fit">
                                                                 <img class="user-pic rounded" src="{{ URL::asset('img/down-icon2.png') }}">
                                                                </td>
                                                            <td>
                                                                <a href="javascript:;" class="primary-link">Tom</a>
                                                            </td>
                                                            <td> $645 </td>
                                                            <td> 50 </td>
                                                            <td> 89 </td>
                                                            <td>
                                                                <span class="bold theme-font">58%</span>
                                                            </td>
                                                        </tr>--}}
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
</div>
@endforeach
<script>

@foreach($last_15_minutes_data as $instrument_id=>$instrument)

$("#sparkline_vol_{{$instrument_id}}").sparkline({{calculateDifference($instrument,'total_volume')->take(count($instrument)-1)->reverse()->pluck('total_volume_difference')->toJson()}}, {
                type: 'bar',
                width: '100',
                barWidth: 5,
                height: '30',
                barColor: '{{sparkLineBarColor($instrument[0]->close_price-$instrument[0]->yday_close_price)}}',
                negBarColor: '#e02222'
            });
   $("#sparkline_ltp_{{$instrument_id}}").sparkline({{$instrument->reverse()->pluck('close_price')->toJson()}}, {
                type: 'line',
                  height: '30',
                lineColor: '{{sparkLineLineColor($instrument[0]->close_price-$instrument[0]->yday_close_price)}}',
                fillColor: '{{sparkLineFillColor($instrument[0]->close_price-$instrument[0]->yday_close_price)}}'});


@endforeach

</script>

<script>
    $(function(){
        
    })
@foreach($sector_up_down_details as $sector_up_down)
new Highcharts.Chart({
            chart: {
                height:60,
                renderTo: 'gainer_loser_depth_{{$sector_up_down->sector_list_id}}',
                defaultSeriesType: 'bar',
                zoomType:'x',
               // borderWidth :1,
                spacingTop :0
              //  backgroundColor: "#ECECEC"
            },
            title: {
                text:null
            },
            colors:['#50B432','#64E572','#FFB2B2','#FF0000'/*'#ED561B'*/],
            xAxis: {
                categories: ["{{$sector_list[$sector_up_down->sector_list_id]->name}}"],
                title: {
                    text: null
                }

            },
            yAxis: {
                //min: 0,
                labels: {
                    //rotation:-90,
                    formatter: function() {
                        return this.value+' %';
                    }
                },
                title: {
                    text: null
                }

            },
            tooltip: {
                formatter: function() {
                if(this.series.name =='+2%')
                        tooltip_name='Greater than 2%';
                    else if(this.series.name =='-2%')
                        tooltip_name='Less than -2%';
                    else
                        tooltip_name=this.series.name;
                    return ' <b>'+
                         tooltip_name +':</b> '+ Math.round(this.percentage *100)/100 +' %';
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            if(this.y!=0 && this.percentage> 4)
                                return Math.round(this.percentage *100)/100 +' %';
                        },
                        color:'#000000',
                        x:1,
                        y:3,
                        pointPadding :0.25,
                        borderWidth: 0

                    },
                    stacking: 'percent'
                },
                series: {
                    pointPadding: 0,
                    groupPadding: 0.1

                }

            },
            legend: {
                //layout: 'vertical',
                //align: 'right',
                verticalAlign: 'top',
                //x: -100,
                y: 0,
                //floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true,
                reversed :true
            },
            credits:{
                enabled:true,
                href:"http://www.stockbangladesh.com",
                text:"stockbangladesh.com",
                style:
                {
                color: '#4572A7',
                right: '5px',
                bottom:'5px'
                }
            },
                series: [
                {
showInLegend: false,
                    name: '+2%',

                    data: [{{$sector_up_down->up_over_2}}]
                },

            {
            showInLegend: false,
                name: '2% to 0%',

                data: [{{$sector_up_down->up_0_to_2}}]
            },
            {
            showInLegend: false,
                name: '0% to -2%',

                data: [{{$sector_up_down->down_0_to_2}}]
            },
            {
            showInLegend: false,
                name: '-2%',

                data: [{{$sector_up_down->down_over_2}}]
            }

            ]
        });
@endforeach

</script>

