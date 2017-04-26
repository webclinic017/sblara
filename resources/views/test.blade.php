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
     @include('block.minute_chart',['instrument_id'=>13])

     </div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

     </div>
</div>
{{--@include('block.advance_chart')
@include('block.market_summary')
@include('block.market_summary')--}}

<div class="clearfix">
                                                                        <h4 class="block">Justified Link Variation</h4>
                                                                        <div class="btn-group btn-group-justified">
                                                                            <a href="javascript:;" class="btn btn-default"> Left </a>
                                                                            <a href="javascript:;" class="btn btn-default"> Middle </a>
                                                                            <a href="javascript:;" class="btn btn-default"> Right </a>
                                                                        </div>
                                                                        <div class="clearfix margin-bottom-10"> </div>
                                                                        <div class="btn-group btn-group-xs btn-group-justified">
                                                                            <a href="javascript:;" class="btn red"> Left </a>
                                                                            <a href="javascript:;" class="btn blue"> Middle </a>
                                                                            <a href="javascript:;" class="btn green"> Right </a>
                                                                        </div>
                                                                    </div>
@endsection



