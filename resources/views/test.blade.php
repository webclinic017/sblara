@extends('layouts.default')

@section('content')
@include('block.market_summary')
<div class="row">
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
     @include('block.significant_movement_value')
     </div>
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
    @include('block.significant_movement_trade')
     </div>
</div>
<div class="row">
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
     @include('block.top_by_price_change')
     </div>
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
     @include('block.top_by_price_change_per')
     </div>
</div>
<div class="row">
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
     @include('block.minute_chart',['instrument_id'=>13])

     </div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        @include('block.index_chart')
     </div>
</div>
{{--@include('block.advance_chart')
@include('block.market_summary')
@include('block.market_summary')--}}


@endsection



