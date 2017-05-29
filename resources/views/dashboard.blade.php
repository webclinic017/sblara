@extends('layouts.metronic.default')

@section('page_heading')
DSE: {{$trade_date_Info->trade_date->format('l, M d, Y')}}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
    @include('block.market_summary')
    </div>
</div>
<div class="row">
    <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
    @include('block.index_chart')
    </div>
</div>
<div class="row">
    {{--Main content column: Start--}}
    <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
         <div class="row">

              {{-- 1st column START--}}
              <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">


                  {{--1st column: Block start--}}
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      {{--@include('block.index_chart')--}}
                      </div>
                  </div>
                  {{--1st column: Block ends--}}


                  {{--1st column: Block start--}}
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                  {{--1st column: Block ends--}}


                  {{--1st column: Block start--}}
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                       <!-- BEGIN Portlet PORTLET-->
                                  <div class="portlet light bordered">
                                      <div class="portlet-title">
                                          <div class="caption">
                                              <i class="icon-graph font-yellow-casablanca"></i>
                      								<span class="caption-subject bold font-yellow-casablanca uppercase">
                      								bar chart </span>
                                              <span class="caption-helper"></span>
                                          </div>
                                          <div class="tools">
                                              <a href="" class="collapse">
                                              </a>

                                              </a>
                                              <a href="" class="remove">
                                              </a>
                                          </div>

                                      </div>
                                      <div class="portlet-body">

                                      <div class="scroller" style="height:400px" data-rail-visible="1" data-always-visible="1"
                                               data-rail-color="yellow" data-handle-color="#a1b2bd">

                                        @include('block.market_composition_bar_per',['base'=>'total_value','height'=>1000])
                                      </div>
                                      </div>
                                  </div>
                                  <!-- END Portlet PORTLET-->
                      </div>
                  </div>
                  {{--1st column: Block ends--}}


                  {{--1st column: Block start--}}
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                       <!-- BEGIN Portlet PORTLET-->
                                  <div class="portlet light bordered">
                                      <div class="portlet-title">
                                          <div class="caption">
                                              <i class="icon-graph font-yellow-casablanca"></i>
                      								<span class="caption-subject bold font-yellow-casablanca uppercase">
                      								top price change(%) </span>
                                              <span class="caption-helper"></span>
                                          </div>
                                          <div class="tools">
                                              <a href="" class="collapse">
                                              </a>

                                              </a>
                                              <a href="" class="remove">
                                              </a>
                                          </div>

                                      </div>
                                      <div class="portlet-body">
                                        @include('block.top_by_price_change_per')
                                      </div>
                                  </div>
                                  <!-- END Portlet PORTLET-->
                      </div>
                  </div>
                  {{--1st column: Block ends--}}


                  {{--1st column: Block start--}}
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                       <!-- BEGIN Portlet PORTLET-->
                                  <div class="portlet light bordered">
                                      <div class="portlet-title">
                                          <div class="caption">
                                              <i class="icon-graph font-yellow-casablanca"></i>
                      								<span class="caption-subject bold font-yellow-casablanca uppercase">
                      								top price change(total) </span>
                                              <span class="caption-helper"></span>
                                          </div>
                                          <div class="tools">
                                              <a href="" class="collapse">
                                              </a>

                                              </a>
                                              <a href="" class="remove">
                                              </a>
                                          </div>

                                      </div>
                                      <div class="portlet-body">
                                        @include('block.top_by_price_change')
                                      </div>
                                  </div>
                                  <!-- END Portlet PORTLET-->
                      </div>
                  </div>
                  {{--1st column: Block ends--}}


                  {{--1st column: Block start--}}
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                      </div>
                  </div>
                  {{--1st column: Block ends--}}



              </div>
              {{-- 1st column END--}}




              {{-- 2nd column START--}}
              <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">


                {{--2nd column: Block start--}}
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-graph font-yellow-casablanca"></i>
                                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                                            Gainer/Loser (last minute) </span>
                                    <span class="caption-helper"></span>
                                </div>
                                <div class="tools">
                                    <a href="" class="collapse">
                                    </a>

                                    </a>
                                    <a href="" class="remove">
                                    </a>
                                </div>

                            </div>
                            <div class="portlet-body">
                              @include('block.sector_gainer_loser_last_minute')
                            </div>
                        </div>
                        <!-- END Portlet PORTLET-->
                      </div>

                  </div>
                  {{--2nd column: Block ends--}}

                  {{--2nd column: Block start--}}
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       @include('block.significant_movement_trade')

                      </div>
                  </div>
                  {{--2nd column: Block ends--}}

                  {{--2nd column: Block start--}}
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      @include('block.significant_movement_value')
                      </div>
                  </div>
                  {{--2nd column: Block ends--}}



                  {{--2nd column: Block start--}}
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                      </div>
                  </div>
                  {{--2nd column: Block ends--}}

              </div>
              {{-- 2nd column END--}}
         </div>

    </div>
    {{--Main content column: End--}}
    {{--Ads column : Starts--}}
    <div class="col-lg-2 col-md-10 col-sm-6 col-xs-12">

    </div>
    {{--Ads column : Ends--}}
</div>





@endsection
