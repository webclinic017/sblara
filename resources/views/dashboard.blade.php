@extends('layouts.metronic.default')

@section('content')

<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
     @include('block.home_page_index')
     </div>
</div>

<div class="row">
     <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
     @include('block.index_chart')
     </div>
     <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">

     <div class="portlet light bordered">
                                     <div class="portlet-title tabbable-line">
                                         <div class="caption">
                                                                 <i class="icon-graph font-yellow-casablanca"></i>
                                         								<span class="caption-subject bold font-yellow-casablanca uppercase">
                                         								Gainer Loser : Whole Day </span>

                                                             </div>
                                         <ul class="nav nav-tabs">
                                             <li class="active">
                                                 <a href="#tab_actions_pending" data-toggle="tab"> UP/DOWN BAR</a>
                                             </li>
                                             <li>
                                                 <a href="#tab_actions_completed" data-toggle="tab"> UP/DOWN FRAME </a>
                                             </li>
                                         </ul>
                                     </div>
                                     <div class="portlet-body">
                                         <div class="tab-content">
                                             <div class="tab-pane active" id="tab_actions_pending">
                                             @include('block.sector_gainer_loser')

                                             </div>
                                             <div class="tab-pane" id="tab_actions_completed">

                                             <div class="row">
                                                  <div class="col-lg-12 col-md-5 col-sm-6 col-xs-12">
                                             @include('block.market_frame_by_gainer_lose')
                                                  </div>

                                             </div>


                                             </div>
                                         </div>
                                     </div>
                                 </div>



     </div>

</div>
<div class="row">
     <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
    @include('block.minute_chart',['instrument_id'=>13])
     </div>
     <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
@include('block.minute_chart',['instrument_id'=>79])
     </div>

</div>
<div class="row">
     <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
    @include('block.significant_movement_trade')
     </div>
     <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
@include('block.top_by_price_change')
     </div>

</div>

<div class="row">
     <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
    @include('block.top_by_price_change_per')
     </div>
     <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
    {{--@include('block.advance_chart')--}}
     </div>

</div>


@endsection



