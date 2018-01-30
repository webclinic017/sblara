<div id="{{$renderTo}}"></div>

<script>
    $(function () {
        $('#{{$renderTo}}').highcharts({
            chart: {
                zoomType: 'xy',
                defaultSeriesType: 'spline',
                // plotBackgroundImage: 'http://www.new.stockbangladesh.com/img/chart_logo.gif',
                events: {
                    load: function() {
                        this.renderer.image('{{url('/img/chart_logo.gif')}}', this.chartWidth/2.5, this.chartHeight/2.5, 86, 63).add();  // add image(url, x, y, w, h)
                    }
                },
                showAxes: true,
                shadow: false,
                borderWidth: 1,
                borderColor: "#D5DAE0",

                spacingLeft: 2,
                spacingRight: 2,
                height:{{$height}}    // if height defined, scalling is not taking full canvas


            },
            title: {
                text: '{{$sector_name}}'
            },
            subtitle: {
                text: ''
            },
            xAxis: [{
                categories: {!! $category !!},
                tickInterval: 15,
                labels: {
                    enabled: true,
                    rotation: -90,
                    align: 'right'

                    //x:10,
                }
            }],
            yAxis: [{ // Primary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: '#1BA39C'
                    }
                },
                title: {
                    text: 'Price',
                    style: {
                        color: '#1BA39C'
                    }
                }
            }, { // Secondary yAxis
                title: {
                    text: 'Volume',
                    style: {
                        color: '#1BA39C'
                    }
                },
                labels: {
                    format: '{value}',
                    style: {
                        color: '#1BA39C'
                    }
                },
                opposite: true
            }],
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
                    align: 'left',
                    verticalAlign: 'top',
                    x: 5,
                    y: 15
                }
            },
            legend: {
                enabled: false

            },
            series: [{
                name: 'Volume',
                type: 'column',
                color: '#26C281',
                yAxis: 1,
                data: {!! $volumeData !!},
                tooltip: {
                    valueSuffix: ''
                }

            }, {
                name: 'Price',
                type: 'spline',
                color: '#ACB5C3',
                marker: {
                    radius: 3
                },
                data: {!! $indexData !!},
                tooltip: {
                    valueSuffix: ''
                }
            }]
        });
    });

</script>
