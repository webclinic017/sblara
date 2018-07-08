<div id="{{$renderTo}}"></div>
@push('scripts')
<script>
$(function(){
    chart_collumn_gain_loser_depth = new Highcharts.Chart({
            chart: {
                height:{{$height}},
                renderTo: '{{$renderTo}}',
                defaultSeriesType: 'bar',
                zoomType:'x',
               // borderWidth :1,
                spacingRight :50
              //  backgroundColor: "#ECECEC"
            },
            title: {
                text:'Sectorwise Gain Loser in-depth: {{$todayDate}}'
            },
            colors:['#50B432','#64E572','#FFB2B2','#FF0000'/*'#ED561B'*/],
            xAxis: {
                categories: {!! $category !!},
                title: {
                    text: null
                }

            },
            yAxis: {
                //min: 0,
                labels: {
                    //rotation:-90,
                    formatter: function() {
                        return this.value+' %';
                    }
                },
                title: {
                    text: null
                }

            },
            tooltip: {
                formatter: function() {
                if(this.series.name =='+2%')
                        tooltip_name='Greater than 2%';
                    else if(this.series.name =='-2%')
                        tooltip_name='Less than -2%';
                    else
                        tooltip_name=this.series.name;
                    return ' <b>'+
                         tooltip_name +':</b> '+ Math.round(this.percentage *100)/100 +' %';
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            if(this.y!=0 && this.percentage> 4)
                                return Math.round(this.percentage *100)/100 +' %';
                        },
                        color:'#000000',
                        x:1,
                        y:3,
                        pointPadding :0.25,
                        borderWidth: 0

                    },
                    stacking: 'percent'
                },
                series: {
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
                shadow: true,
                reversed :true
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
                series: [
                {

                    name: '+2%',

                    data: {!! $range_plus_2 !!}
                },

            {
                name: '2% to 0%',

                data: {!! $range_0_to_plus_2 !!}
            },
            {
                name: '0% to -2%',

                data: {!! $range_0_to_minus_2 !!}
            },
            {
                name: '-2%',

                data: {!! $range_minus_2 !!}
            }

            ]
        });
        
})


</script>
@endpush