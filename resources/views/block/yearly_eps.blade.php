<div id="{{$render_to}}"></div>


<script>
    $(function () {


Highcharts.chart('{{$render_to}}', {
            chart: {
                zoomType: 'x',
                type: 'column'

            },
            title: {
                text: 'Yearly EPS'
            },
            xAxis: {
                categories: {!! $category !!},
                crosshair: true
            },
            yAxis: {
                title: {
                    text: 'Earning Per Share'
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
                name: 'EPS',
                data: {!! $earning_per_share !!}
            }]
        });



    });



</script>
