  <div class="tab-pane">

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
<script>
$(function () {

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



