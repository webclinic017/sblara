@extends('layouts.default')

@section('content')
{{-- @include('block.market_summary') --}}
<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     	@include('block.monitor_chart')
     </div>
</div>
{{-- @include('block.advance_chart')
@include('block.market_summary')
@include('block.market_summary') --}}
@endsection

