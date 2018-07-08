<div id="{{$renderTo}}"></div>
@push('scripts')
<script>
$(function () {
      var colors = Highcharts.getOptions().colors;
        pie_chart = new Highcharts.Chart({
            chart: {
                height:{{$height}},
                renderTo: '{{$renderTo}}',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
               // backgroundColor: "#ECECEC",
               // borderWidth :1
            },
            title: {
                text: 'Sectorwise Market Composition'
            },
            subtitle: {
                text: '<b>Inner Circle</b>: {{$prevDate}} <br /> <b>Outer Circle</b>: {{$todayDate}}'
            },
            credits:{
                enabled:true,
                href:"http://www.stockbangladesh.com",
                text:"stockbangladesh.com",
                style:
                {
                color: '#4572A7',
                //left: '15px',
                bottom:'5px'
                },
                position: {
                    align: 'left'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage *100)/100 +'% on '+this.series.name;
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    /*dataLabels: {
                        enabled: false
                    },*/
                    showInLegend: true,
                    shadow: false,
                    center :['40%', '50%']

                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                floating: true,
                align: 'right',
                verticalAlign: 'top',
                //x: 670,
                y: 30,
                labelFormatter: function() {
                    if(this.name=='Bank')
                        return '<b>'+this.series.name+'</b><br />'+this.name;
                    else
                    return this.name;
                }
            },
            series: [{
                type: 'pie',
                name: '{{$prevDate}}',
                size: '60%',
                dataLabels: false,
                legend: {
                    layout: 'vertical',
                    backgroundColor: '#000000',
                    floating: true,
                    align: 'right',
                    verticalAlign: 'top',
                    //x: 670,
                    y: 30,
                    labelFormatter: function() {
                        if(this.name=='Bank')
                            return '<b>'+this.series.name+'</b><br />'+this.name;
                        else
                        return this.name;
                    }
                },
                data: {!! $prevDay !!}
            },
            {
                type: 'pie',
                name: '{{$todayDate}}',
                innerSize: '72%',
                dataLabels: {
                    formatter: function() {
                        // display only if larger than 1
                        return Math.round(this.percentage *100)/100 +' %';
                    },
                    color: 'black',
                },

                data: {!! $today !!}

            }
            ]
        });

})
  
        </script>
@endpush