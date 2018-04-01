<div id="market_radar_institute_holdings">
</div>
<script>
$(function () {

Highcharts.chart('market_radar_institute_holdings', {
    chart: {
        type: 'column',
        height: 300
    },
    title: {
          style: {
                      fontSize: '14px'
                  },
        text: '{{$interested_on}} % ইনস্টিটিউট হোল্ডিং-এ আগ্রহ বেশী ({{$interested_per}}%)'
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