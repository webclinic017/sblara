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
                                 UP DOWN- TRADES </span>
        </div>
        <ul class="nav nav-tabs">
            <li class="active" >
                <a class="reload" href="#up_down_tab" data-toggle="tab" aria-expanded="false" > UP DOWN </a>
            </li>

            <li class="" >
                <a class="reload" href="#trade_compare_tab" data-toggle="tab" aria-expanded="false" > TRADES </a>
            </li>


        </ul>
    </div>
    <div class="portlet-body">
        <div class="tab-content">

                     <div class="tab-pane active" id="up_down_tab">
                      <div id="up_down_today">
                             </div>

<table class="table table-striped table-bordered table-advance table-hover">

                <thead>

                <tr>

                    <th>



                    </th>
                    <th>

                        <i class="fa icon-equalizer"></i> Up

                    </th>

                    <th>

                        <i class="fa fa-bar-chart-o"></i> Down

                    </th>

                    <th>

                        <i class="fa fa-bar-chart-o"></i> Equal

                    </th>



                </tr>

                </thead>

                <tbody>

                <tr>

                    <td class="{{fontCss(1)}}">


                            Today

                    </td>
                    <td class="{{fontCss(1)}}">


                            {{$up_down_data_today->up}}

                    </td>

                    <td class="{{fontCss(-1)}}">

                        {{$up_down_data_today->down}}
                    </td>

                    <td>

                        {{$up_down_data_today->eq}}
                    </td>





                </tr>
                <tr>

                    <td class="{{fontCss(1)}}">


                            Prev day

                    </td>
                    <td class="{{fontCss(1)}}">


                            {{$up_down_data_prev->up}}

                    </td>

                    <td class="{{fontCss(-1)}}">

                        {{$up_down_data_prev->down}}
                    </td>

                    <td>

                        {{$up_down_data_prev->eq}}
                    </td>





                </tr>


                </tbody>

            </table>



                     </div>

                     <div class="tab-pane" id="trade_compare_tab">

        <div id="trade_compare">
        </div>
<table class="table table-striped table-bordered table-advance table-hover">

                <thead>

                <tr>

                    <th>

                        T.Trd

                    </th>

                    <th>

                        T.Vol

                    </th>

                    <th>

                        T.Value(m)

                    </th>

                    <th>

                        Projected Value

                    </th>



                </tr>

                </thead>

                <tbody>

                <tr>

                    <td >

                            {{$trade_data_today->TRD_TOTAL_TRADES}}

                    </td>

                    <td>

                        {{$trade_data_today->TRD_TOTAL_VOLUME}}
                    </td>

                    <td class="highlight" >

                        <strong>{{$trade_data_today->TRD_TOTAL_VALUE}}</strong>
                    </td>

                    <td>

                        {{$projected_trade_value}}
                    </td>





                </tr>


                </tbody>

            </table>

                     </div>


        </div>


    </div>
</div>

<script async>
$(function () {


Highcharts.chart('up_down_today', {
    chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            height: 195,
            type: 'pie'
        },
    title: {
        text: null
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        type: 'pie',
        name: 'Up Down',
        data: [
            {
                name: 'Up',
                y: {{$up_down_data_today->up}},
                color: '#26C281'
            },
            {
                name: 'Down',
                y: {{$up_down_data_today->down}},
                color: '#E43A45'
            },
            {
                name: 'Equal',
                y: {{$up_down_data_today->eq}},
                color: '#ACB5C3'
            }
        ]
    }]
});









Highcharts.chart('trade_compare', {
    chart: {
        type: 'bar',
        height: 235
    },
    title: {
        text: null
    },
    xAxis: {
        categories: ['{{$today}}', '{{$prevday}}']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total trade value (m)'
        },
        stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [{
        name: 'Projected value',
        color: '#94A0B2',
        data: [{{$projected_trade_value-$trade_data_today->TRD_TOTAL_VALUE}},0]
    }, {
        name: 'Real value',
        color: '#1BBC9B',
        data: [{{$trade_data_today->TRD_TOTAL_VALUE}},{{$trade_data_prev->TRD_TOTAL_VALUE}}]
    }]
});



});

</script>



