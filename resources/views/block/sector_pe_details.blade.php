{{--<div class="row">
<div class="row widget-row">
                            <div class="col-md-4">
                                <!-- BEGIN WIDGET THUMB -->
                                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                    <h4 class="widget-thumb-heading">Market Earnings</h4>
                                    <div class="widget-thumb-wrap">
                                        <i class="widget-thumb-icon bg-green icon-wallet"></i>
                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-subtitle">BDT</span>
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
                                            <span class="widget-thumb-subtitle">BDT</span>
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
</div>--}}
<div class="row">

<div class="col-lg-6 col-xs-12 col-sm-12">
<div id="{{$render_to1}}"></div>

</div>
<div class="col-lg-6 col-xs-12 col-sm-12">
<div id="{{$render_to2}}"></div>
</div>
</div>
<span class="label label-info">* Mutual fund excluded</span>
<span class="label label-info">* Z category excluded</span>
<span class="label label-info">* OTC excluded</span>
<span class="label label-info">* Annualized EPS used  </span>

<script>
    $(function () {


// Create the chart
Highcharts.chart('{{$render_to1}}', {
    chart: {
        type: 'pyramid'
    },
    title: {
        text: 'Sales pyramid',
        x: -50
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b> ({point.y:,.0f})',
                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                softConnector: true
            },
            center: ['40%', '50%'],
            width: '80%'
        }
    },
    legend: {
        enabled: false
    },
    series: [{
        name: 'Unique users',
        data: [
            ['Website visits',      15654],
            ['Downloads',            4064],
            ['Requested price list', 1987],
            ['Invoice sent',          976],
            ['Finalized',             846]
        ]
    }]
});






    });

</script>
