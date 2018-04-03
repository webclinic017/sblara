@extends('layouts.metronic.default')

@section('content')

{{--@include('html.instrument_list_bs_select_with_sector',['bs_select_id'=>'shareList_sds', 'class' => 'bs-select', 'prepend' => true])--}}
        {{--  New block Starts--}}
{{--        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								php</span>
                        <span class="caption-helper">testing</span>
                    </div>
                    <div class="tools">
                                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_radar_paidup:limit=30:instrument_id={{$instrument_id}}" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								php</span>
                        <span class="caption-helper">testing</span>
                    </div>
                    <div class="tools">
                                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_radar_pe:limit=30:instrument_id={{$instrument_id}}" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Sql</span>
                        <span class="caption-helper">testing</span>
                    </div>
                    <div class="tools">
                                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_radar_category:limit=30:instrument_id={{$instrument_id}}" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
                </div>
            </div>
            </div>
        </div>--}}
        {{--  New block Ends--}}
        {{--@include('block.sectorwise-share-price-list-dse')--}}

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body">
{{--@include('block.sectorwise-share-price-list-dse')--}}
<div id="example-table"></div>
                            </div>
                        </div>
                        <!-- END Portlet PORTLET-->

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body">
<table id="example-table2" class="table table-striped table-bordered table-hover dataTable">
    <thead>
        <tr>
            <th width="200" filter="input">Name</th>
            <th tabulator-align="center">Age</th>
            <th>Gender</th>
            <th>Height</th>
            <th width="150">Favourite Color</th>
            <th>Date of Birth</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Billy Bob</td>
            <td>12</td>
            <td>male</td>
            <td>1</td>
            <td>red</td>
            <td>22/04/1994</td>
        </tr>
        <tr>
            <td colspan="5">Billy Bob</td>
        </tr>
        <tr>
            <td>Mary May</td>
            <td>1</td>
            <td>female</td>
            <td>2</td>
            <td>blue</td>
            <td>14/05/1982</td>
        </tr>
    </tbody>
</table>
                            </div>
                        </div>
                        <!-- END Portlet PORTLET-->

            </div>
        </div>

{{--@include('block.price_matrix')--}}
{{--@include('block.data_matrix')--}}

{{--@include('block.news_chart',['instrument_id'=>13])--}}

{{--@include('block.sector_minute_chart',['sector_list_id'=>1])--}}

{{--@include('block.sector_gain_loser_column',['height'=>500])--}}

{{--@include('block.gain_loser_depth',['height'=>500])--}}

{{--@include('block.market_composition_bar_per',['base'=>'total_value','height'=>1000])--}}

{{--@include('block.market_composition_bar_total',['base'=>'total_value','height'=>1000])--}}

{{--@include('block.market_composition_pie',['base'=>'total_value'])--}}
{{--@include('block.market_composition_pie',['base'=>'total_volume','height'=>500])--}}

{{--@include('block.price_tree',['base'=>'total_value'])--}}
{{--@include('block.market_depth_single',['instrument_id'=>13])--}}
{{--@include('block.market_frame_old_site',['base'=>'total_value','instrument_id'=>13])--}}

{{--@include('block.advance_chart')--}}
{{--@include('block.market_summary')--}}

{{--@include('block.advance_chart')--}}
{{--@include('block.market_summary')--}}
{{--@include('block.dividend_history')--}}
{{--@include('block.fundamental_summary')--}}
{{--@include('block.share_holdings_chart')--}}
{{--@include('block.share_holdings_history_chart')--}}
{{--@include('block.eps_history_chart_quarter_to_quarter')--}}
{{--@include('block.eps_history_chart_up_to_quarter')--}}
{{--@include('block.net_profit_history_chart_quarter_to_quarter')--}}
{{--@include('block.net_profit_history_chart_up_to_quarter')--}}

{{--@include('block.dividend_possible')--}}

<div class="row">
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
{{--@include('block.top_by_price_change')--}}
     </div>
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
    {{--@include('block.significant_movement_trade')--}}
    {{--@include('html.instrument_list_bs_select',['bs_select_id'=>'bsselect_ggf'])--}}
     </div>
</div>
<div class="row">
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
     {{--@include('block.top_by_price_change')--}}
     </div>
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
     {{--@include('block.top_by_price_change_per')--}}
     </div>
</div>
<div class="row">
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
     {{--@include('block.minute_chart',['instrument_id'=>13])--}}

     </div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

     </div>
</div>
{{--@include('block.advance_chart')
@include('block.market_summary')
@include('block.market_summary')--}}


@endsection



@push('css')


<link href="{{ URL::asset('metronic_custom/tabulator-3.4.6/dist/css/bootstrap/tabulator_bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
{{--<link href="{{ URL::asset('metronic_custom/tabulator-3.4.6/dist/css/tabulator_simple.min.css') }}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ URL::asset('metronic_custom/tabulator-3.4.6/dist/css/semantic-ui/tabulator_semantic-ui.min.css') }}" rel="stylesheet" type="text/css" />--}}

@endpush

@push('scripts')

<script src="{{ URL::asset('metronic/assets/global/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('metronic_custom/tabulator-3.4.6/dist/js/tabulator.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {

//create Tabulator on DOM element with id "example-table"
$("#example-table").tabulator({
    height:205, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
    layout:"fitColumns", //fit columns to width of table (optional)
    columns:[ //Define Table Columns
        {title:"Name", field:"name", width:150,headerFilter:"input"},
        {title:"Age", field:"age", align:"left", headerFilter:"number"},
        {title:"Favourite Color", field:"col"},
        {title:"Date Of Birth", field:"dob", sorter:"date", align:"center"},
    ],
    rowClick:function(e, row){ //trigger an alert message when the row is clicked
        alert("Row " + row.getData().id + " Clicked!!!!");
    }
});


//define some sample data
var tabledata = [
    {id:1, name:"Oli Bob", age:"12", col:"red", dob:""},
    {id:2, name:"Mary May", age:"-10", col:"blue", dob:"14/05/1982"},
    {id:3, name:"Christine Lobowski", age:"42", col:"green", dob:"22/05/1982"},
    {id:4, name:"Brendon Philips", age:"125", col:"orange", dob:"01/08/1980"},
    {id:5, name:"Margret Marmajuke", age:"16", col:"yellow", dob:"31/01/1999"},
];

//load sample data into the table
$("#example-table").tabulator("setData", tabledata);


    });

$("#example-table2").tabulator({
    height:205, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
    layout:"fitColumns" //fit columns to width of table (optional)

});

</script>

@endpush






