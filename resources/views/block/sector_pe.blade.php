<div class="row">
<div class="row widget-row">
                            <div class="col-md-4">
                                <!-- BEGIN WIDGET THUMB -->
                                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                    <h4 class="widget-thumb-heading">Market Earnings</h4>
                                    <div class="widget-thumb-wrap">
                                        <i class="widget-thumb-icon bg-green icon-wallet"></i>
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-subtitle">MN</span>
                                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$sector_pe_data['total_market_earnings']}}">{{$sector_pe_data['total_market_earnings']}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- END WIDGET THUMB -->
                            </div>
                            <div class="col-md-4">
                                <!-- BEGIN WIDGET THUMB -->
                                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                    <h4 class="widget-thumb-heading">Market Cap</h4>
                                    <div class="widget-thumb-wrap">
                                        <i class="widget-thumb-icon bg-red icon-layers"></i>
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-subtitle">MN</span>
                                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$sector_pe_data['total_market_capital']}}">{{$sector_pe_data['total_market_capital']}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- END WIDGET THUMB -->
                            </div>
                            <div class="col-md-4">
                                <!-- BEGIN WIDGET THUMB -->
                                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                    <h4 class="widget-thumb-heading">Market P/E</h4>
                                    <div class="widget-thumb-wrap">
                                        <i class="widget-thumb-icon bg-purple icon-shuffle"></i>
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-subtitle">P/E</span>
                                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$sector_pe_data['market_pe']}}">{{$sector_pe_data['market_pe']}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- END WIDGET THUMB -->
                            </div>

                        </div>
</div>
<div class="row">

<div class="col-lg-6 col-xs-12 col-sm-12">

                                        <div class="table-scrollable table-scrollable-borderless">

                                            <table class="table table-hover table-light">
                                                <thead>
                                                    <tr class="uppercase">
                                                        <th> Sector </th>
                                                        <th> Sector Earnings </th>
                                                        <th> Sector Cap </th>
                                                        <th> Sector P/E </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 @foreach($sector_pe_data['sector_pe_arr'] as $sector_id=>$data)
                                                <tr>

                                                    <td> {{$data['sector']}} </td>
                                                    <td> {{$data['sector_earning']}} </td>
                                                    <td> {{$data['sector_cap']}} </td>
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
<span class="label label-info">* Z category excluded</span>
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
        text: 'Sector P/E'
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
        name: 'Sector P/E',
        data: {!! $bar !!}

    }]
});




    });

</script>
