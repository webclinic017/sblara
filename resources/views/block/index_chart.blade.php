<!-- following style is to solve highchart problem in hidden tab-->
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
<div class="portlet light" id="chart_portlet">
    <div class="portlet-title tabbable-line">
        <div class="caption hidden-xs">
            <i class="icon-pin font-green-sharp"></i>
                                 <span class="caption-subject font-green-sharp bold uppercase">
                                 INDEX- </span>
        </div>
        <ul class="nav nav-tabs">
        @foreach($indexData['index'] as $data)
            <li class="{{$data['details']['active']}}" >
                <a class="reload" href="#{{$data['details']['id']}}_tab1" data-toggle="tab" aria-expanded="false" > {{$data['details']['instrument_code']}} </a>
            </li>

        @endforeach

        </ul>
    </div>
    <div class="portlet-body">
        <div class="tab-content">
        @foreach($indexData['index'] as $data)
            <div class="tab-pane {{$data['details']['active']}}" id="{{$data['details']['id']}}_tab1">
            <div id="{{$data['details']['id']}}_chart">
            </div>
 <table class="table table-striped table-bordered table-advance table-hover">

                                                        <tbody>

                                                        <tr>

                                                            <td class="highlight">

                                                                <div class="success">

                                                                </div>

                                                                <a href="#">

                                                                    {{$data['details']['instrument_code']}}</a>

                                                            </td>

                                                            <td class="{{fontCss( $data['last']['deviation'])}}">


                                                                {{$data['last']['capital_value']}}

                                                            </td>
                                                            <td class="{{fontCss( $data['last']['deviation'])}}">

                                                                {{round($data['last']['deviation'],2)}}

                                                            </td>

                                                            <td class="{{fontCss($data['last']['deviation'])}}">

                                                              {{round($data['last']['percentage_deviation'],2)}}%

                                                            </td>





                                                        </tr>


                                                        </tbody>

                   </table>
            </div>

         @endforeach

   
        </div>


    </div>
</div>


@push('scripts')
<script async>
@foreach($indexData['index'] as $row)


    $(function () {
        $("#{{$row['details']['id']}}_chart").highcharts({
            chart: {
                zoomType: 'xy',

                height:{{$row['details']['height']}}

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
                tickInterval: 15,
                labels: {
                    format: '{value}',
                    rotation: -95,
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: null
            }, { // Secondary yAxis
                gridLineDashStyle: 'longdash',
                lineColor: '#d2d2d2',
                lineWidth: 1,
                tickInterval: 15,
                title: null,
                labels: {
                    format: '{value}',
                    rotation: -95,
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true,
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x: %H:%M} |  {point.y:.2f} m'
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
                    y: 295
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
                color: '#1BA39C',
                yAxis: 1,
                data: {{$indexData['trade']}}

            }, {
                name: '{{$row['details']['instrument_code']}}',
                type: 'spline',
                color: '#EF4836',
                marker: {
                    radius: 1
                },
                data: {{$row['data']}}
            }]
        });
    });

@endforeach

</script>


@endpush
