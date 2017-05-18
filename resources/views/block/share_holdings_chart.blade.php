<div id="{{$render_to}}"></div>

@push('scripts')

<script>
    $(function () {

       Highcharts.chart('{{$render_to}}', {
                   chart: {
                       plotBackgroundColor: null,
                       plotBorderWidth: null,
                       plotShadow: false,
                       type: 'pie'
                   },
                   title: {
                       text: 'Share holdings as on {{$fundaData['share_percentage_director']->first()->meta_date->format('d-m-Y')}} '
                   },
                   tooltip: {
                       pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                   },
                   plotOptions: {
                       pie: {
                           allowPointSelect: true,
                           cursor: 'pointer',
                           dataLabels: {
                               enabled: true,
                               format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                               style: {
                                   color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                               }
                           }
                       }
                   },
                   series: [{
                       name: 'Holdings',
                       colorByPoint: true,
                       data: [{
                           name: 'Director',
                           y: {{$fundaData['share_percentage_director']->first()->meta_value}}
                            /*,sliced: true
                           ,selected: true*/
                       }, {
                           name: 'Govt',
                           y: {{$fundaData['share_percentage_govt']->first()->meta_value}}
                       }, {
                           name: 'Institue',
                           y: {{$fundaData['share_percentage_institute']->first()->meta_value}}
                        }, {
                           name: 'Foreign',
                           y: {{$fundaData['share_percentage_foreign']->first()->meta_value}}
                           }, {
                           name: 'Public',
                           y: {{$fundaData['share_percentage_public']->first()->meta_value}}
                         }]
                   }]
               });

    });



</script>
@endpush