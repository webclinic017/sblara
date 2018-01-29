<div class="row">
<div class="col-lg-6 col-xs-12 col-sm-12">

                                        <div class="table-scrollable table-scrollable-borderless">

                                            <table class="table table-hover table-light">
                                                <thead>
                                                    <tr class="uppercase">
                                                        <th> Category </th>
                                                        <th> Category Earnings </th>
                                                        <th> Category Cap </th>
                                                        <th> Category P/E </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 @foreach($category_pe_data as $cat=>$data)
                                                <tr>

                                                    <td> {{$cat}} </td>
                                                    <td> {{$data['earnings']}} </td>
                                                    <td> {{$data['cap']}} </td>
                                                    <td>
                                                        <span class="bold theme-font">{{$data['pe']}}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                        </div>
</div>
<div class="col-lg-6 col-xs-12 col-sm-12">
<div id="{{$render_to}}"></div>
</div>
</div>
<span class="label label-info">* Mutual fund excluded</span>
<span class="label label-info">* Life insurance excluded</span>
<span class="label label-info">* OTC excluded</span>
<span class="label label-info">* Annualized EPS used  </span>


<script>
    $(function () {


// Create the chart
Highcharts.chart('{{$render_to}}', {
    chart: {
    height:{{$height}},
        type: 'bar'
    },
    title: {
        text: 'Category P/E'
    },
    subtitle: {
        text: 'Lowest is better'
    },
    xAxis: {
        categories: {!! $category !!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'P/E'
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
        name: 'Category P/E',
        data: {!! $bar !!}

    }]
});




    });

</script>
