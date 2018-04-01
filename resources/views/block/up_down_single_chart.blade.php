
                     <div>
<div id="up_down_today"></div>

                     <div id="gainer_loser_frame"></div>




<table class="table table-striped table-bordered table-advance table-hover">

                <thead>

                <tr>

                    <th>



                    </th>
                    <th>

                        <i class="fa icon-equalizer"></i> Up

                    </th>

                    <th>

                        <i class="fa fa-bar-chart-o"></i> Down

                    </th>

                    <th>

                        <i class="fa fa-bar-chart-o"></i> Equal

                    </th>



                </tr>

                </thead>

                <tbody>

                <tr>

                    <td class="{{fontCss(1)}}">


                            Today

                    </td>
                    <td class="{{fontCss(1)}}">


                            {{$up_down_data_today->up}}

                    </td>

                    <td class="{{fontCss(-1)}}">

                        {{$up_down_data_today->down}}
                    </td>

                    <td>

                        {{$up_down_data_today->eq}}
                    </td>





                </tr>
                <tr>

                    <td class="{{fontCss(1)}}">


                            Prev day

                    </td>
                    <td class="{{fontCss(1)}}">


                            {{$up_down_data_prev->up}}

                    </td>

                    <td class="{{fontCss(-1)}}">

                        {{$up_down_data_prev->down}}
                    </td>

                    <td>

                        {{$up_down_data_prev->eq}}
                    </td>





                </tr>


                </tbody>

            </table>



                     </div>

<script>
$(function () {


Highcharts.chart('up_down_today', {
    chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            height: 120,
            type: 'pie'
        },
    title: {
        text: null
    },
     legend: false,
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        type: 'pie',
        name: 'Up Down',
        data: [
            {
                name: 'Up',
                y: {{$up_down_data_today->up}},
                color: '#26C281'
            },
            {
                name: 'Down',
                y: {{$up_down_data_today->down}},
                color: '#E43A45'
            },
            {
                name: 'Equal',
                y: {{$up_down_data_today->eq}},
                color: '#ACB5C3'
            }
        ]
    }]
});

new Highcharts.Chart({
            chart: {
                height:80,
                renderTo: 'gainer_loser_frame',
                defaultSeriesType: 'bar',
                zoomType:'x',
               // borderWidth :1,
                spacingRight :5
              //  backgroundColor: "#ECECEC"
            },
            title: {
                text:null
            },
            colors:['#50B432','#64E572','#FFB2B2','#FF0000'/*'#ED561B'*/],
            xAxis: {
                categories: [""],
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
            /*tooltip: {
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
            },*/
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
            legend: false,

                series: [
                {

                    name: '+2%',

                    data: [{{$range_plus_2}}]
                },

            {
                name: '2% to 0%',

                data: [{{$range_0_to_plus_2}}]
            },
            {
                name: '0% to -2%',

                data: [{{$range_0_to_minus_2}}]
            },
            {
                name: '-2%',

                data: [{{$range_minus_2}}]
            }

            ]
        });




});

</script>



