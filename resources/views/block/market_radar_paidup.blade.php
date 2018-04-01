<div id="market_radar_paidup">
</div>
<div class="btn-group btn-group-justified">
                                                                    <a href="javascript:;" class="btn btn-default btn-xs"> 0-10 </a>
                                                                    <a href="javascript:;" class="btn btn-default btn-xs"> 10-30 </a>
                                                                    <a href="javascript:;" class="btn btn-default btn-xs"> 30-50 </a>
                                                                    <a href="javascript:;" class="btn btn-default btn-xs"> 30-50 </a>
                                                                    <a href="javascript:;" class="btn btn-default btn-xs"> 50-100 </a>
                                                                    <a href="javascript:;" class="btn btn-default btn-xs"> 100-200 </a>
                                                                    <a href="javascript:;" class="btn btn-default btn-xs"> over 200 </a>
                                                                </div>
<script>
$(function () {

Highcharts.chart('market_radar_paidup', {
    chart: {
        type: 'column',
        height: 300
    },
    title: {
          style: {
                      fontSize: '14px'
                  },
        text: '{{$interested_on}}কোটি পেইডআপে আগ্রহ বেশী ({{$interested_per}}%)'
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