<script>
    $(function () {

        $('#<?php echo $chartData["div"]; ?>').highcharts({
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
                spacingRight: 2,
                height:<?php echo $chartData["height"]; ?>    // if height defined, scalling is not taking full canvas


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
                text: '<?php echo $chartData["instrument_code"]; ?>',
                style: {
                    fontSize: '12px'
                },
                margin: 1

            },
            subtitle: {
                text: '<?php echo 'Total Vol :'.$chartData['day_total_volume'].' Bull V :'.$chartData['bullVolume'].' Bear Vol : '. $chartData['bearVolume'].' Neutral Vol : '. $chartData['neutralVolume']
                .' Bull Strength : '. $chartData['totalBullStrength'].''.' Bear Strength : '. $chartData['totalBearStrength'].'';?>   '+'<a href=' + window.baseURL + 'minute_chart?symbol=<?php echo $chartData["subtitle"]; ?> target="_blank" >'+'browse' + '</a>',
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
                    categories: [

                        <?php echo $this->Text->toList($chartData["xcat"],','); ?>
                        //'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'




                    ],
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
                    data: <?php echo $chartData["ydata"] ?>,
                    tooltip: {
                        valueSuffix: ''
                    }

                },
                {
                    name: 'Price',
                    type: 'spline',
                    color: '<?php echo $chartData['price_chart_color'];?>',
                    yAxis: 1,
                    marker: {
                        radius: 3
                    },
                    data: <?php echo $chartData["xdata"] ?>,
                    tooltip: {
                        valueSuffix: ''
                    }
                },
                {
                    type: 'pie',
                    name: '<?php echo $chartData['last5daysBullBearStrength'][0]['trade_date'];?>',
                    data: [{
                        name: 'Bull Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][0]['totalBullStrength'];?>,
                        color: '#1BA39C' // bear
                    }, {
                        name: 'Bear Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][0]['totalBearStrength'];?>,
                        color: '#EF4836' // Bear color
                    }, {
                        name: 'Neutral Vol',
                        y: <?php echo $chartData['neutralVolume'];?>,
                        color: '#ACB5C3'// Neutral
                    }],
                    center: [0, 0],
                    size: 30,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                },
                {
                    type: 'pie',
                    name: '<?php echo $chartData['last5daysBullBearStrength'][1]['trade_date'];?>',
                    data: [{
                        name: 'Bull Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][1]['totalBullStrength'];?>,
                        color: '#1BA39C' // bear
                    }, {
                        name: 'Bear Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][1]['totalBearStrength'];?>,
                        color: '#EF4836' // Bear color
                    }, {
                        name: 'Neutral Vol',
                        y: <?php echo $chartData['neutralVolume'];?>,
                        color: '#ACB5C3'// Neutral
                    }],
                    center: [30, 0],
                    size: 30,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                },
                {
                    type: 'pie',
                    name: '<?php echo $chartData['last5daysBullBearStrength'][2]['trade_date'];?>',
                    data: [{
                        name: 'Bull Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][2]['totalBullStrength'];?>,
                        color: '#1BA39C' // bear
                    }, {
                        name: 'Bear Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][2]['totalBearStrength'];?>,
                        color: '#EF4836' // Bear color
                    }, {
                        name: 'Neutral Vol',
                        y: <?php echo $chartData['neutralVolume'];?>,
                        color: '#ACB5C3'// Neutral
                    }],
                    center: [60, 0],
                    size: 30,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                },
                {
                    type: 'pie',
                    name: '<?php echo $chartData['last5daysBullBearStrength'][3]['trade_date'];?>',
                    data: [{
                        name: 'Bull Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][3]['totalBullStrength'];?>,
                        color: '#1BA39C' // bear
                    }, {
                        name: 'Bear Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][3]['totalBearStrength'];?>,
                        color: '#EF4836' // Bear color
                    }, {
                        name: 'Neutral Vol',
                        y: <?php echo $chartData['neutralVolume'];?>,
                        color: '#ACB5C3'// Neutral
                    }],
                    center: [90, 0],
                    size: 30,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                },
                {
                    type: 'pie',
                    name: '<?php echo $chartData['last5daysBullBearStrength'][4]['trade_date'];?>',
                    data: [{
                        name: 'Bull Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][4]['totalBullStrength'];?>,
                        color: '#1BA39C' // bear
                    }, {
                        name: 'Bear Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][4]['totalBearStrength'];?>,
                        color: '#EF4836' // Bear color
                    }],
                    center: [120, 0],
                    size: 30,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                },
                {
                    type: 'pie',
                    name: '<?php echo $chartData['last5daysBullBearStrength'][5]['trade_date'];?>',
                    data: [{
                        name: 'Bull Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][5]['totalBullStrength'];?>,
                        color: '#1BA39C' // bear
                    }, {
                        name: 'Bear Vol',
                        y: <?php echo $chartData['last5daysBullBearStrength'][5]['totalBearStrength'];?>,
                        color: '#EF4836' // Bear color
                    }, {
                        name: 'Neutral Vol',
                        y: <?php echo $chartData['neutralVolume'];?>,
                        color: '#ACB5C3'// Neutral
                    }],
                    center: [150, 0],
                    size: 30,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                },
                /*{
                    type: 'pie',
                    name: '<?php echo $chartData['trade_date'];?>',
                    data: [{
                        name: 'Bull Vol',
                        y: <?php echo $chartData['totalBullStrength'];?>,
                        color: '#1BA39C' // bear
                    }, {
                        name: 'Bear Vol',
                        y: <?php echo $chartData['totalBearStrength'];?>,
                        color: '#EF4836' // Bear color
                    }, {
                        name: 'Neutral Vol',
                        y: <?php echo $chartData['neutralVolume'];?>,
                        color: '#ACB5C3'// Neutral
                    }],
                    center: [180, 0],
                    size: 30,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                },*/{
                    type: 'pie',
                    name: 'Bull Bear Chart',
                    data: [{
                        name: 'Bull Vol',
                        y: <?php echo $chartData['bullVolume'];?>,
                        color: '#32c5d2' // Bull
                    }, {
                        name: 'Bear Vol',
                        y: <?php echo $chartData['bearVolume'];?>,
                        color: '#f2784b' // Bear color
                    }, {
                        name: 'Neutral Vol',
                        y: <?php echo $chartData['neutralVolume'];?>,
                        color: '#ACB5C3'// Neutral
                    }],
                    center: [180, 0],
                    size: 30,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                }
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    }

                }]
            }
        });



        var chart = $('#<?php echo $chartData["div"]; ?>').highcharts();
        var y_volume =chart.yAxis[0];
        var y_price =chart.yAxis[1];

        <?php
        $y_price_min=$chartData["price_low"];
        $y_price_max=$chartData["price_high"];
         $y_price_max=$y_price_max+(($y_price_max-$y_price_min)*10)/100;
        $y_price_min=$y_price_min-(($y_price_max-$y_price_min)*10)/100;
        ?>;
        // setting axis max & min to look the chart big and nice
        y_price.setExtremes(<?php echo $y_price_min?>,<?php echo $y_price_max?>);
        y_volume.setExtremes(<?php echo$chartData["volume_low"]?>,<?php echo $chartData["volume_high"]?>);


    });

</script>