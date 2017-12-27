<div id="up_down_today">


@push('scripts')

<script>

Highcharts.chart('up_down_today', {
    chart: {
        type: 'column'
    },
    title: {
        text: null
    },
    xAxis: {
        categories: ['Up/Down']
    },
    yAxis: {
        min: 0,
        title: {
            text: null
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        }
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },
    series: [{
        showInLegend: false,
         color: '#1bbf49',
        name: 'Up',
        data: [{{$viewData['upDownData']['up']->count()}}]
    }, {
    showInLegend: false,
    color: '#bdbdbd',
        name: 'Equal',
        data: [{{$viewData['upDownData']['eq']->count()}}]
    }, {
    showInLegend: false,
    color: '#ff6161',
        name: 'Down',
        data: [{{$viewData['upDownData']['down']->count()}}]
    }]
});

</script>


@endpush


