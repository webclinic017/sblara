<div id="sector_gainer_loser">


@push('scripts')

<script>

Highcharts.chart('sector_gainer_loser', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Stacked bar chart'
    },
    xAxis: {
        categories: {!! $category !!}

    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total fruit consumption'
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
                    name: 'Up',
                    data: {{$upArr}}
                }, {
                    name: 'Down',
                    data: {{$downArr}}
                }, {
                    name: 'Eq',
                    data: {{$eqArr}}
                }]
});

</script>


@endpush


