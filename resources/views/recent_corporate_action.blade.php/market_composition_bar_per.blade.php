<div id="{{$renderTo}}"></div>

<script>

chart_bar_total_trade = new Highcharts.Chart({
            chart: {
                height:{{$height}},
                renderTo: '{{$renderTo}}',
                defaultSeriesType: 'bar',
                zoomType :'x'
              //  borderWidth :1,
              //  backgroundColor: "#ECECEC"
            },
            title: {
                text: null
            },
            xAxis: {
                categories:{!! $category !!},
                title: {
                    text: null
                },
                gridLineWidth :0
            },
            yAxis: {
                min: 0,
                title: {
                    text: '{{$ylabel}}'
                }
                
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.y +'</b> millions'+' On <b>'+ this.series.name+'</b>';
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            return '<b>'+this.y +'</b>';
                        }
                    },
                    lineWidth  :0,
                    groupPadding: 0
                },
                series:
                {
                    pointPadding: 0,
                    groupPadding: 0.1
                }
            },
            credits:{
                enabled:true,
                href:"http://www.stockbangladesh.com",
                text:"stockbangladesh.com",
                style: 
                {
                color: '#4572A7',
                right: '5px',
                bottom:'5px'
                }
            }, 
                series: [{
                name: '{{$todayDate}}',
                data: {!! $today !!}
            }, {
                name: '{{$prevDate}}',
                data: {!! $prevDay !!}
            }, ]
        });
        

</script>
