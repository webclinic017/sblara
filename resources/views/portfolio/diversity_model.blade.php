<div class="row">
        <div class="col-md-6">

                            <div class="portlet light bordered">
                                              <div class="portlet-title tabbable-line">
                                                    <div class="caption">
                                                        <i class="icon-graph font-yellow-casablanca"></i>
                                                        <span class="caption-subject bold font-yellow-casablanca uppercase">
                                                            Sector diversity</span>

                                                      </div>
                                                        <div class="tools">
                                                            <a href="" class="collapse">
                                                            </a>

                                                        </a>
                                                        <a href="" class="remove">
                                                        </a>
                                                    </div>
                                                </div>

                                            <div class="portlet-body">
                                            <div id="sector_diversity">

                                            </div>

                            </div>

                </div>
        </div>
             <div class="col-md-6">

                            <div class="portlet light bordered">
                                              <div class="portlet-title tabbable-line">
                                                    <div class="caption">
                                                        <i class="icon-graph font-yellow-casablanca"></i>
                                                        <span class="caption-subject bold font-yellow-casablanca uppercase">
                                                            Portfolio holdings</span>

                                                      </div>
                                                        <div class="tools">
                                                            <a href="" class="collapse">
                                                            </a>

                                                        </a>
                                                        <a href="" class="remove">
                                                        </a>
                                                    </div>
                                                </div>

                                            <div class="portlet-body">
  <div id="holding_diversity">

                                            </div>

                            </div>

                </div>
        </div>
</div>




<script>
$(function () {


Highcharts.chart('sector_diversity', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Sector diversity'
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
        name: 'Sector total',
        colorByPoint: true,

        data: {!! $sector_data !!}
    }]
});
Highcharts.chart('holding_diversity', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Portfolio holdings'
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
        name: 'Share holdings',
        colorByPoint: true,
        data: {!! $portfolio_holdings_data !!}
    }]
});



});

</script>