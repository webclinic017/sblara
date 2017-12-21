@extends('layouts.metronic.default-opt')

@section('content')


<div class="row">
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
@include('block.top_by_price_change')
     </div>
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
    @include('block.significant_movement_trade')
    {{--@include('html.instrument_list_bs_select',['bs_select_id'=>'bsselect_ggf'])--}}
     </div>
</div>

@endsection