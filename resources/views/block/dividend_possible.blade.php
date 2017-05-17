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
                       text: 'Scope to pay dividend'
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
                       name: 'Dividend Possible',
                       colorByPoint: true,
                       data: [{
                           name: 'Paid up',
                           y: {{$paid_up_capital}}

                       }, {
                           name: 'Dividend possible',
                           y: {{$gap}}
                       }]
                   }]
               });

    });



</script>
@endpush