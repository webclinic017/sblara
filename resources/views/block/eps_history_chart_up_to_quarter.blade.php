<div id="{{$render_to}}"></div>


<script>
    $(function () {


Highcharts.chart('{{$render_to}}', {
            chart: {
                zoomType: 'x',
                type: 'column'
            },
            title: {
                text: 'EPS History (Up to Quarter)'
            },
            xAxis: {
                categories: {!! $category !!},
                crosshair: true
            },
            yAxis: {
                title: {
                    text: 'EPS'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: '3 months',
                data: {!! $q1_eps_cont_op !!}
            }, {
                name: '6 months',
                data: {!! $half_year_eps_cont_op !!}
            }, {
                name: '9 months',
                data: {!! $q3_nine_months_eps !!}
            }, {
                name: '12 months/Yearly',
                data: {!! $earning_per_share !!}
            }]
        });



    });



</script>