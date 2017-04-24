@extends('layouts.default')

@section('content')
@include('block.market_summary')
<div class="row">
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     @include('block.significant_movement')
     </div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     @include('block.index_chart')
     </div>
</div>
<div class="row">
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     @include('block.minute_chart')
     </div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

     </div>
</div>
@include('block.advance_chart')
@include('block.market_summary')
@include('block.market_summary')
@endsection

