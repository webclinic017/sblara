<div id="{{$render_to}}"></div>

@push('scripts')

<script>
    $(function () {


Highcharts.chart('{{$render_to}}', {
            chart: {
                zoomType: 'x',
                type: 'column'
            },
            title: {
                text: 'EPS History (Quarter to Quarter)'
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
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
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
                name: 'Q1',
                data: {!! $q1_eps_cont_op !!}
            }, {
                name: 'Q2',
                data: {!! $q2_eps_cont_op !!}
            }, {
                name: 'Q3',
                data: {!! $q3_eps_cont_op !!}
            }, {
                name: 'Q4',
                data: {!! $q4_eps_cont_op !!}
            }]
        });



    });



</script>
@endpush