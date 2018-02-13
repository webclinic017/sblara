@extends('layouts.metronic.default')

@section('content')

@include('html.instrument_list_bs_select_with_sector',['bs_select_id'=>'shareList_sds', 'class' => 'bs-select', 'prepend' => true])
        {{--  New block Starts--}}
        <div class="row">
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
        </div>
        {{--  New block Ends--}}

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body">
{{--@include('block.sector_pe_details')--}}
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
{{--@include('block.sector_pe')--}}
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



@push('scripts')

<script>
$('#bsselect_ggf').selectpicker({
  size: 4
});


</script>
@endpush
