
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Sector Gainer Loser </span>
                        <span class="caption-helper">Sectorwise gainer loser</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="#" data-url="#" id="minute_chart" class="reload"></a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">

                    <div id="sector_gainer_loser">

                </div>
            </div>

@push('scripts')

<script>

Highcharts.chart('sector_gainer_loser', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Stacked bar chart'
    },
    xAxis: {
        categories: {!! $category !!}

    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total fruit consumption'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [ {
             name: 'Eq',
             color: "#ACB5C3",
             data: {{$eqArr}}
             },{
                    name: 'Down',
                    color: "#EF4836",
                    data: {{$downArr}}
                },
                {
                 name: 'Up',
                 color: "#1BA39C",
                 data: {{$upArr}}

             }
             ]
});


</script>



@endpush


