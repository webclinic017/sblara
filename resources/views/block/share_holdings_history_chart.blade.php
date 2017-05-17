<div id="{{$render_to}}"></div>
<div class="btn-group btn-group-xs btn-group-justified">
    <a href="javascript:;" class="btn red" onclick="chartfunc('column')" id="column"> Column </a>
    <a href="javascript:;" class="btn blue" onclick="chartfunc('bar')" id="bar"> Stack </a>
    <a href="javascript:;" class="btn green" onclick="chartfunc('line')" id="line"> Line </a>
</div>

@push('scripts')

<script>
    $(function () {



       Highcharts.chart('{{$render_to}}', {
                   chart: {
                       zoomType: 'x',
                       type: 'column'
                   },
                   title: {
                       text: 'Share Holding History'
                   },
                   xAxis: {
                       categories: {!! $category !!},
                       crosshair: true
                   },
                   yAxis: {
                       title: {
                           text: 'Share Holding History'
                       }
                   },
                   tooltip: {
                       headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                       pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                       '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                       footerFormat: '</table>',
                       shared: true,
                       useHTML: true
                   },
                   plotOptions: {
                       column: {
                           pointPadding: 0.2,
                           borderWidth: 0
                       }
                   },
                   series: [{
                       name: 'Director',
                       data: {!! $director !!}
                   }, {
                       name: 'Public',
                       data: {!! $public !!}
                   }, {
                       name: 'Institute',
                       data: {!! $institute !!}
                   }, {
                       name: 'Foreign',
                       data: {!! $foreign !!}
                   }, {
                       name: 'Govt',
                       data: {!! $govt !!}
                   }]
               });



               chartfunc = function(type)
               {
                   var chart = $('#{{$render_to}}').highcharts();

                   if(type=='column')
                   {
                       chart.update({
                           chart: {
                               zoomType: 'x',
                               type: 'column'
                           },
                           title: {
                               text: 'Share Holding History-column chart'
                           },
                           plotOptions: {
                               column: {
                                   pointPadding: 0.2,
                                   stacking: false,
                                   borderWidth: 0
                               }
                           }
                       });


                   }
                   else if(type=='bar')
                   {
                       chart.update({
                           chart: {
                               zoomType: 'x',
                               type: 'column'
                           },
                           title: {
                               text: 'Share Holding History-stack chart'
                           },
                           plotOptions: {
                               column: {
                                   stacking: 'percent'
                               }
                           }
                       });
                   }

                   else
                   {

                       chart.update({
                           chart: {
                               zoomType: 'x',
                               type: 'line'
                           },
                           title: {
                               text: 'Share Holding History-line chart'
                           }
                       });


                   }

               }


    });



</script>
@endpush