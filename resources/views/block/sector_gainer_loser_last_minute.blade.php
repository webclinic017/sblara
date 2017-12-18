  <div id="sector_gainer_loser_last_minute"></div>

<script>

Highcharts.chart('sector_gainer_loser_last_minute', {
    chart: {
        type: 'bar'
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
            stacking: 'normal'
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
                 color: "#1BA39C",
                 data: {{$upArr}}

             }
             ]
});


</script>



