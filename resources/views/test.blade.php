@extends('layouts.default')

@section('content')


@include('block.price_tree',['base'=>'total_value'])
{{--@include('block.market_depth')--}}
{{--@include('block.market_frame_old_site',['base'=>'total_value'])--}}

{{--@include('block.advance_chart')--}}
{{--@include('block.market_summary')--}}
<div class="row">
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">

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
