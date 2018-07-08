<div id="price_tree"></div>
@push('scripts')
<script src="http://code.highcharts.com/highcharts-more.js"></script>
<script>
$(function () {
// Parse the data from an inline table using the Highcharts Data plugin
Highcharts.chart('price_tree', {

    chart: {
        polar: true,
        type: 'column'
    },

    title: {
        text: 'Wind rose for South Shore Met Station, Oregon'
    },

    subtitle: {
        text: 'Source: or.water.usgs.gov'
    },

    pane: {
        size: '100%'
    },

    legend: {
        align: 'right',
        verticalAlign: 'top',
        y: 100,
        layout: 'vertical'
    },

     xAxis: {
                      tickmarkPlacement: 'on',
                      categories: {!! $category !!}
          },

    yAxis: {
        min: 0,
        endOnTick: false,
        showLastLabel: true,
        title: {
            text: 'Frequency (%)'
        },
        labels: {
            formatter: function () {
                return this.value + '%';
            }
        },
        reversedStacks: false
    },
    series: [{
            name: 'Today',
            data: {!! $today !!}
        }, {
            name: 'Yesterday',
            data:{!! $prevDay !!}
        }],

    tooltip: {
        valueSuffix: '%'
    },
    plotOptions: {
        series: {
            stacking: 'normal',
            shadow: false,
            groupPadding: 0,
            pointPlacement: 'on'
        }
    }

});
})

</script>
@endpush