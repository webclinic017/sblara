  <div id="sector_gainer_loser"></div>

<script>

Highcharts.chart('sector_gainer_loser', {
    chart: {
        type: 'bar',
        pointWidth: '200',
    },
    title: {
        text: null
    },
    xAxis: {
        categories: {!! $category !!}

    },
    yAxis: {
        min: 0,
        title: {
            text: null
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal',
            pointWidth:9,
        }
    },
    series: [ {
             name: 'Eq',
             color: "#ACB5C3",
             data: {{$eqArr}}
             },{
                    name: 'Down',
                    color: "#EF4836",
                    data: {{$downArr}}
                },
                {
                 name: 'Up',
                 color: "#32C5D2",
                 data: {{$upArr}}

             }
             ]
});


</script>





