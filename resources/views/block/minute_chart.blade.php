<div id="{{$chartData["div"]}}"></div>
@push('scripts')

<script>
    $(function () {

        $('#{{$chartData["div"]}}').highcharts({
            chart: {
                zoomType: 'xy',
                defaultSeriesType: 'spline',
               // plotBackgroundImage: 'http://www.new.stockbangladesh.com/img/chart_logo.gif',
                events: {
                    load: function() {
                        this.renderer.image('http://www.new.stockbangladesh.com/img/chart_logo.gif', this.chartWidth/2.5, this.chartHeight/2.5, 86, 63).add();  // add image(url, x, y, w, h)
                    }
                },
                showAxes: true,
                shadow: false,
                borderWidth: 1,
                borderColor: "#D5DAE0",

                spacingLeft: 2,
                spacingRight: 2
                //,height:{{$chartData["height"]}}   // if height defined, scalling is not taking full canvas


            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: [

                            {
                                textKey: 'downloadPNG',
                                onclick: function () {
                                    this.exportChart({filename: 'StockBangladesh_minute-chart'});
                                }
                            }]
                    }
                }
            },
            title: {
                text: '{{$chartData['instrumentInfo']->instrument_code}}',
                style: {
                    fontSize: '12px'
                },
                margin: 1

            },
            subtitle: {
                text: 'Total Vol:{{$chartData['day_total_volume']}}',
                useHTML: true,
//floating: true,
                y: 23,
                style: {
                    fontSize: '10px'
                }
//margin: 50
            },

            xAxis: [
                {
                    categories:
                       {!! $chartData["xcat"] !!}

                        //'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ,
                    tickInterval: 1,
                    crosshair: true,
                    labels: {
                        enabled: true,
                        rotation: -90,
                        align: 'right'

                        //x:10,
                    }

                }
            ],
            yAxis: [
                { // Primary yAxis

                    title: {
                        /* text: 'Price',
                         style: {
                         color: Highcharts.getOptions().colors[1]
                         }*/
                        text: ''
                    },
                    id: 'y_price',
                    enabled: false
                },
                { // Secondary yAxis
                    title: {
                        text: ''
                    },
                    enabled: false,
                    labels: {
                        format: '{value}',
                        style: {
                            color: '#1BA39C'
                        }
                    },
                    id: 'y_volume',
                    opposite: true
                }
            ],
            tooltip: {
                shared: true
            },
            credits: {
                enabled: true,
                href: "http://www.stockbangladesh.com",
                text: "stockbangladesh.com",
                style: {
                    color: '#4572A7'

                },
                position: {
                    align: 'right',
                    verticalAlign: 'bottom'
                    /*  x: 5,
                     y: 15*/
                }
            },
            legend: {
                enabled: false
                //layout: 'vertical',
                /*   align: 'left',
                 verticalAlign: 'bottom'*/
                /* x: 120,
                 verticalAlign: 'top',
                 y: 100,*/
                /*  floating: true,
                 backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'*/
            },
            series: [
                {
                    name: 'Volume',
                    type: 'column',
                    color: '#8CC152',
                    yAxis: 0,
                    data: {!! $chartData["ydata"] !!},
                    tooltip: {
                        valueSuffix: ''
                    }

                },
                {
                    name: 'Price',
                    type: 'spline',
                    color: '{!! $chartData["price_chart_color"] !!}',
                    yAxis: 1,
                    marker: {
                        radius: 3
                    },
                    data: {!! $chartData["xdata"] !!},
                    tooltip: {
                        valueSuffix: ''
                    }
                }
                @for($i=0;$i<count($chartData['bullBear']);$i++)
                ,
                {
                    type: 'pie',
                    name: '{{$chartData['bullBear'][$i]['trade_date']}}',
                    data: [{
                        name: 'Bull Vol',
                        y: {{$chartData['bullBear'][$i]['totalBull']}},
                        color: '#1BA39C' // bear
                    }, {
                        name: 'Bear Vol',
                        y: {{$chartData['bullBear'][$i]['totalBear']}},
                        color: '#EF4836' // Bear color
                    }, {
                        name: 'Neutral Vol',
                        y: {{$chartData['bullBear'][$i]['totalNeutral']}},
                        color: '#ACB5C3'// Neutral
                    }],
                    center: [{{40*($i+1)}}, 10],
                    size: 40,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                }

                @endfor

            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    }

                }]
            }
        });


       

    });

</script>
@endpush