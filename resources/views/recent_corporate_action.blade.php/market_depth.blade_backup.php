@include('html.instrument_list_bs_select',['bs_select_id'=>'instruments'])
<div class="row">
    <div id='dseList' class="col-md-6">
    </div>
    <div class="col-md-6" >
        <div class="col-md-12" id="container">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" >
        <div class="btn-group text-center">
            <button id="refresh_btn" class="add btn green">
                Refresh <i class="fa fa-reload"></i>
            </button>
        </div>
    </div>

</div>


@push('scripts')
<script type="text/javascript">




        // console.log(test)

        $( "#instruments" ).change(function() {


            var insId = $("#instruments").selectpicker("val");

            callAjax(insId);

        });


        $('#refresh_btn').click(function (e) {

            var insId = $("#instruments").selectpicker("val");

            callAjax(insId);

        });


     function drawChart(buyPrice,sellPrice,buyVolume,sellVolume,code)
     {
                    Highcharts.chart('container', {
                   //$('#container').highcharts({
                                           chart: {
                                               type: 'bar'
                                           },
                                           title: {
                                               text: "Buyer Seller chart-"+code
                                           },
                                           subtitle: {
                                               text: ''
                                           },
                                           xAxis: [{
                                               categories: buyPrice,
                                               reversed: false,
                                               labels: {
                                                   step: 1
                                               }
                                           }, { // mirror axis on right side
                                               opposite: true,
                                               reversed: false,
                                               categories: sellPrice,
                                               linkedTo: 0,
                                               labels: {
                                                   step: 1
                                               }
                                           }],
                                           yAxis: {
                                               title: {
                                                   text: null
                                               },
                                               labels: {
                                                   formatter: function () {
                                                       return (Math.abs(this.value)) + '';
                                                   }
                                               }//,
                                               //    min: -4000000,
                                               //    max: 4000000
                                           },

                                           plotOptions: {
                                               series: {
                                                   stacking: 'normal'
                                               }
                                           },

                                           tooltip: {
                                               formatter: function () {
                                                   return '<b>' + this.series.name + ', Price ' + this.point.category + '</b><br/>' +
                                                   'Total order: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                                               }
                                           },
                                           credits: {
                                               enabled: true,
                                               href: "http://www.stockbangladesh.com",
                                               text: "stockbangladesh.com",
                                               style: {
                                                   color: '#4572A7'

                                               },
                                               position: {
                                                   align: 'right',
                                                   verticalAlign: 'bottom'
                                                   /*  x: 5,
                                                    y: 15*/
                                               }
                                           },

                                           series: [{
                                               name: 'Buyer',
                                               color: '#35AA47',
                                               data: buyVolume/*[-1746181, -1884428, -2089758, -2222362, -2537431, -2507081, -2443179,
                                                -2664537, -3556505, -3680231, -3143062, -2721122, -2229181, -2227768,
                                                -2176300, -1329968, -836804, -354784, -90569, -28367, -3878]*/
                                           }, {
                                               name: 'Seller',
                                               color: '#F3565D',
                                               data: sellVolume/*[1656154, 1787564, 1981671, 2108575, 2403438, 2366003, 2301402, 2519874,
                                                3360596, 3493473, 3050775, 2759560, 2304444, 2426504, 2568938, 1785638,
                                                1447162, 1005011, 330870, 130632, 21208]*/
                                           }]
                                       });


 var chart = $('#container').highcharts();
        var y_volume =chart.yAxis[0];
        var y_price =chart.yAxis[1];
        chart.redraw();
     }



        function callAjax(insId)
        {

           var ajaxUrl = "{{ url('/ajax/marketDepthData/') }}/"+insId;

            $.ajax({
                type: "GET",
                dataType: 'html',
                url: ajaxUrl

            }).done(function (data) {

                var data1=JSON.parse(data);

                $('#dseList').empty();
                $('#dseList').append(data1['dsePage']);

                $("table[bgcolor='#E8FFFB']").attr("id", "buybox");

                $('td[bgcolor="#FFFFFF"] table').attr("id", "sellbox");


                var buyPrice = [];
                var buyVolume = [];
                var sellPrice = [];
                var sellVolume = [];
                var i=0;


                $('td[bgcolor="#CCCCCC"]').each(function (index, element) {
                    var divtextWithHtml=$(this).html();
                    var onlyText=$(divtextWithHtml).text();
                    var floatVal=parseFloat(onlyText);

                    if(i%2==0)
                    {
                        buyPrice.push(floatVal);

                    }else
                    {
                        buyVolume.push(-1*floatVal);
                    }
                    i++;


                });

                for( j=i/2;j<10;j++)
                {

                    buyPrice.push(0);
                    buyVolume.push(0);
                }


                var i=0;
                $('td[bgcolor="#B2B2B2"]').each(function (index, element) {

                    var divtextWithHtml=$(this).html();
                    var onlyText=$(divtextWithHtml).text();
                    var floatVal=parseFloat(onlyText);
                    if(i%2==0)
                    {
                        sellPrice.push(floatVal);

                    }else
                    {
                        sellVolume.push(floatVal);
                    }
                    i++;

                });


                for(j=i/2;j<10;j++)
                {
                    sellPrice.push(0);
                    sellVolume.push(0);
                }

                var buyPrice=buyPrice.reverse();
                var buyVolume=buyVolume.reverse();
                var sellPrice=sellPrice.reverse();
                var sellVolume=sellVolume.reverse();


                var categories = sellPrice;
                //drawChart(buyPrice,sellPrice,buyVolume,sellVolume,data1['code']);







            });
        }




</script>
@endpush