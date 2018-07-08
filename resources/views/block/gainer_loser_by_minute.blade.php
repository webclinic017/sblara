@php
$chart =  \App\Market::gainerLoserMinuteChart();
dump($chart);
@endphp
<div id="container">
    
</div>
<script>
    $(function () {
         Highcharts.chart('container', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Gainer Loser'
    },
    xAxis: {
        categories: ['10:30', '10:31', '10:32', '10:33', '1950', '1999', '10:30', '10:31', '10:32', '10:33', '1950', '1999', '10:30', '10:31', '10:32', '10:33', '1950', '1999', '2050'], //time here
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: 'Percent'
        }
    },
    tooltip: {
        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.2f}%</b> ({point.y:,.0f} items)<br/>',
        split: true
    },
    plotOptions: {
        area: {
            stacking: 'percent',
            lineColor: '#ffffff',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#ffffff'
            }
        }
    },
    series: [{
        name: 'Unchanged',
        color: '#4B77BE',
        data: [106, 107, 111, 133, 221, 767, 106, 107, 111, 133, 221, 767, 106, 107, 111, 133, 221, 767, 106, 107, 111, 133, 221, 767, 1766]
    },  {
        name: 'Gainer',
        color: '#26C281',
        data: [163, 203, 276, 408, 547, 729,163, 203, 276, 408, 547, 729,163, 203, 276, 408, 547, 729,163, 203, 276, 408, 547, 729, 628]
    } ,  {
        name: 'Loser',
        color: '#e43a45',
        data: [18, 31, 54, 156, 339, 818,18, 31, 54, 156, 339, 818,18, 31, 54, 156, 339, 818,18, 31, 54, 156, 339, 818,18, 31, 54, 156, 339, 818, 1201]
    }]
});
    })
   
</script>