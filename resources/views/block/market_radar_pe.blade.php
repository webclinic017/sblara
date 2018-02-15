<div id="market_radar_pe">
</div>
<script>
$(function () {

Highcharts.chart('market_radar_pe', {
    chart: {
        type: 'column',
        height: 300
    },
    title: {
          style: {
                      fontSize: '14px'
                  },
        text: '{{$interested_on}} পিই রেশিও-তে আগ্রহ বেশী ({{$interested_per}}%)'
    },
    xAxis: {
                   categories: {!! $category !!},
                   crosshair: true
               },
    yAxis: [{
        min: 0,
        title: {
            text: null
        }
    }, {
        title: {
            text: null
        },
        opposite: true
    }],
    legend: {
        shadow: false
    },
    tooltip: {
        shared: true
    },
    plotOptions: {
        column: {
            grouping: false,
            shadow: false,
            borderWidth: 0
        }
    },
    series: [{
            name: 'Up',
            color: '#1BA39C',
            data: {!! $up !!},
            pointPadding: 0
        }, {
            name: 'Total',
            color: '#ACB5C3',
            data: {!! $total !!},
            pointPadding: 0.2
        }]

});



});

</script>