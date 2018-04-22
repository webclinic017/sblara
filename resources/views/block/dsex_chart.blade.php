<div id="{{$render_to}}">

</div>
 <table class="table table-striped table-bordered table-advance table-hover">

                                                        <tbody>

                                                        <tr>

                                                            <td class="highlight">

                                                                <div class="success">

                                                                </div>

                                                                <a href="#">

                                                                    DSEX</a>

                                                            </td>

                                                            <td class="{{fontCss($last_index_change)}}">

                                                                {{$last_index}}


                                                            </td>
                                                            <td class="{{fontCss( $last_index_change)}}">

                                                             {{$last_index_change}}

                                                            </td>

                                                            <td class="{{fontCss($last_index_change)}}">

                                                              {{$last_index_change_per}}%

                                                            </td>





                                                        </tr>


                                                        </tbody>

                   </table>

<script>
        $("#{{$render_to}}").highcharts({
            chart: {
                zoomType: 'xy',

                height:{{$height}}

            },
            title: {
                text: null
            },
            subtitle: {

            },

            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    day: '%e of %b',
                    minute: '%H:%M',
                    hour: '%H:%M'
                },

                title: null
            },
            yAxis: [{ // Primary yAxis
                gridLineDashStyle: 'longdash',
                lineColor: '#d2d2d2',
                lineWidth: 1,
                tickInterval: 15,
                labels: {
                    format: '{value}',
                    rotation: -95,
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: null
            }, { // Secondary yAxis
                gridLineDashStyle: 'longdash',
                lineColor: '#d2d2d2',
                lineWidth: 1,
                tickInterval: 15,
                title: null,
                labels: {
                    format: '{value}',
                    rotation: -95,
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true,
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x: %H:%M} |  {point.y:.2f} m'
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
                    y: 295
                }
            },
            legend: {
                enabled: false

            },
            plotOptions: {
                series: {
                    pointWidth: 20,
                    groupPadding: 0
                }
            },
            series: [ {
                name: 'Volume',
                type: 'column',
                color: '#1BA39C',
                yAxis: 1,
                data: {{$trade_data}}

            }, {
                name: 'DSEX',
                type: 'spline',
                color: '#EF4836',
                marker: {
                    radius: 1
                },
                data: {{$index_data}}
            }]
        });


</script>

