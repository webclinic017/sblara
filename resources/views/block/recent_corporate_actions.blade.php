<div id="{{$renderTo}}"></div>
<script>
    $(function () {

       var  groupingUnits = [[
            'week',                         // unit name
            [1]                             // allowed multiples
        ], [
            'month',
            [1, 2, 3, 4, 6]
        ]]




        Highcharts.stockChart('{{$renderTo}}', {
             plotOptions: {
                candlestick: {
                    color: 'red',
                    upColor: '#36C6D3'
                }
            },
            rangeSelector: {
                selected: 1
            },

            title: {
                text: 'Recent Corporate Actions-{{$instrument_code}}'
            },

            yAxis: [{
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'OHLC'
                },
                height: '60%',
                lineWidth: 2
            }, {
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Volume'
                },
                top: '65%',
                height: '35%',
                offset: 0,
                lineWidth: 2
            }],


            series: [{
                type: 'candlestick',
                name: '{{$instrument_code}}',
                id: 'ohlc',
                dataGrouping: {
                					enabled:false
                		        },
                data: {{$ohlc}}

            }, {
                type: 'column',
                name: 'Volume',
                id: 'volume',
                color:'#36C6D3',
                data: {{$volume}},
                dataGrouping: {
                					enabled:false
                		        },
                yAxis: 1
            },{
                             type: 'flags',
                             data: {!! $news_flags2 !!},
                             onSeries: 'volume',
                             shape: 'squarepin',
                         }]
        });

    });



</script>
