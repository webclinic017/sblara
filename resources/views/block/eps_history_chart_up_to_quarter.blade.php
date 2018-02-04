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
                name: '{{$quarterly_label_0}}',
                data: {!! $quarterly_data_0 !!}
            }, {
                name: '{{$quarterly_label_1}}',
                data: {!! $quarterly_data_1 !!}
            }, {
                name: '{{$quarterly_label_2}}',
                data: {!! $quarterly_data_2 !!}
            }, {
                name: '{{$quarterly_label_3}}',
                data: {!! $quarterly_data_3 !!}
            }]
        });



    });



</script>