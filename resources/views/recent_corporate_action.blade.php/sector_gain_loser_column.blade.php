<div id="{{$renderTo}}"></div>
@push('scripts')
<script>
chart_collumn_gain_loser = new Highcharts.Chart({
            chart: {
                height:{{$height}},
                renderTo: '{{$renderTo}}',
                defaultSeriesType: 'column',
                zoomType :'x',
                borderWidth :1,
                backgroundColor: "#ECECEC",
            },
            title: {
                text: 'Sectorwise Gain Loser'
            },
            colors:['#89A54E','#AA4643','#4572A7'],
            xAxis: {
                categories: {!! $category !!},
                title: {
                    text: null
                },
                labels: {
                    rotation:-90,
                    align:'right'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: null,

                }
            },
            tooltip: {
                formatter: function() {
                    return this.series.name +' : '+ this.y ;
                }
            },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            // display only if larger than 1
                            //return Math.round(this.percentage *100)/100 +' %';
                            return this.y;
                        },
                        rotation :-90,
                        y:-10,
                        x:3

                    },
                    shadow:false,
                    borderWidth :0


                },
                series:
                {
                    pointPadding: 0,
                    groupPadding: 0.1
                }
            },
            legend: {
                //layout: 'vertical',
                //align: 'right',
                verticalAlign: 'top',
                //x: -100,
                y: 40,
                //floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
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
                name: 'Gainer',

                data: {!! $upArr !!}
            }, {
                name: 'Loser',

                data: {!! $downArr !!}
            },
            {
                name: 'No Change',

                data: {!! $eqArr !!}
            }
            ]
        });

</script>
@endpush