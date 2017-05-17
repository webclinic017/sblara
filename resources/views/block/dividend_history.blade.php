<div id="{{$render_to}}"></div>

@push('scripts')

<script>
    $(function () {

       Highcharts.chart('{{$render_to}}', {
                   chart: {
                       type: 'column'
                   },
                   title: {
                       text: 'Dividend history'
                   },
                   events: {
                           load: function() {
                               this.renderer.image('http://www.new.stockbangladesh.com/img/chart_logo.gif', this.chartWidth/2.5, this.chartHeight/2.5, 86, 63).add();  // add image(url, x, y, w, h)
                           }
                       },
                   xAxis: {
                       categories: {!! $category !!}
                       },
                   yAxis: {
                       min: 0,
                       title: {
                           text: 'dividend'
                       },
                       stackLabels: {
                           enabled: true,
                           style: {
                               fontWeight: 'bold',
                               color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                           }
                       }
                   },
                   legend: {
                       align: 'right',
                       x: -30,
                       verticalAlign: 'top',
                       y: 25,
                       floating: true,
                       backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                       borderColor: '#CCC',
                       borderWidth: 1,
                       shadow: false
                   },
                   tooltip: {
                       headerFormat: '<b>{point.x}</b><br/>',
                       pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                   },
                   plotOptions: {
                       column: {
                           stacking: 'normal',
                           dataLabels: {
                               enabled: true,
                               color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                           }
                       }
                   },
                   series: [{
                       name: 'Stock dividend',
                       color: '#8BBC21',
                       data: {!! $stock !!}
                       },
                       {
                       name: 'Cash dividend',
                       color: '#3598dc',
                       data: {!! $cash !!}
                       }]
               });

    });



</script>
@endpush