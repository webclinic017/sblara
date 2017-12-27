@extends('layouts.metronic.default')

@section('page_heading')
DSE: {{$trade_date_Info->trade_date->format('l, M d, Y')}}
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">

        @include('block.market_summary')
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
        @include('block.index_chart')
    </div>
</div>


<div class="row">

    {{--Main content 1st column: Start--}}
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">


        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                                Live news </span>
                                <span class="caption-helper"> share market news</span>
                            </div>
                            <div class="tools">
                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.dsb_news:render_to=live_news" class="reload"></a>

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
                <!-- END Portlet PORTLET-->

            </div>
        </div>
        {{--  New block Ends--}}



        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="portlet light bordered">
                  <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                              Gainer Loser : Whole Day (UP/DOWN BAR) </span>

                          </div>
                            <div class="tools">
                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_gainer_loser:render_to=gainer_loser_whole_day_up_down_bar" class="reload"></a>

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


        {{--  New block Starts--}}
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
                            <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_gainer_loser_last_minute:render_to=gainer_loser_last_minute" class="reload"></a>

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
            <!-- END Portlet PORTLET-->

            </div>
        </div>
        {{--  New block Ends--}}


        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
                        <span class="caption-subject bold font-yellow-casablanca uppercase">
                            Sector Compare </span>
                            <span class="caption-helper"> Today vs Previous day</span>
                        </div>
                        <div class="tools">
                            <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_composition_bar_per:render_to=sector_compare:base=total_value:height=500" class="reload"></a>

                            <a href="" class="collapse">
                            </a>
                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">

                    @include('block.market_composition_bar_per',['base'=>'total_value','height'=>500])
                </div>
            </div>
            <!-- END Portlet PORTLET-->

            </div>
        </div>
        {{--  New block Ends--}}


        {{--  New block Starts--}}
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
                            <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.top_by_price_change_per:render_to=top_price_change" class="reload"></a>

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
            <!-- END Portlet PORTLET-->

            </div>
        </div>
        {{--  New block Ends--}}


        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-graph font-yellow-casablanca"></i>
                                    <span class="caption-subject bold font-yellow-casablanca uppercase">
                                        Top Price Change(total) </span>
                                        <span class="caption-helper"></span>
                                    </div>
                                    <div class="tools">
                                         <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.top_by_price_change:render_to=top_price_change_total" class="reload"></a>

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
                        <!-- END Portlet PORTLET-->

            </div>
        </div>
        {{--  New block Ends--}}



        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            </div>
        </div>
        {{--  New block Ends--}}



        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            </div>
        </div>
        {{--  New block Ends--}}



    </div>
    {{--Main 1st content column: End--}}

    {{--Main content 2nd column: Start--}}
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">


        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                                Course </span>
                                <span class="caption-helper"> upcoming course</span>
                            </div>
                            <div class="tools">
                                {{--<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.courses:render_to=course" class="reload"></a>--}}

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
                <!-- END Portlet PORTLET-->


            </div>
        </div>
        {{--  New block Ends--}}


        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="portlet light bordered">
                  <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                              Gainer Loser : Whole Day (UP/DOWN FRAME) </span>

                          </div>
                            <div class="tools">
                                {{--<a href="#" data-load="false" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_frame_by_gainer_lose:render_to=gainer_loser_whole_day_up_down_frame" class="reload"></a>--}}

                                <a href="" class="collapse">
                                </a>

                            </a>
                            <a href="" class="remove">
                            </a>
                        </div>
                    </div>

                <div class="portlet-body">
                    @include('block.market_frame_by_gainer_lose')
                </div>
            </div>
            </div>
        </div>
        {{--  New block Ends--}}


        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
                        <span class="caption-subject bold font-yellow-casablanca uppercase">
                            Sector Compare </span>
                            <span class="caption-helper"> last minute vs Previous minute</span>
                        </div>
                        <div class="tools">
                            <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.intraday_market_composition_bar_per:render_to=sector_compare:base=total_value:height=500" class="reload"></a>

                            <a href="" class="collapse">
                            </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">

                    @include('block.intraday_market_composition_bar_per',['base'=>'total_value','height'=>500])
                </div>
            </div>
            </div>
        </div>
        {{--  New block Ends--}}


        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
                        <span class="caption-subject bold font-yellow-casablanca uppercase">
                            Significant Trade  </span>
                            <span class="caption-helper"></span>
                        </div>
                        <div class="tools">
                            <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.significant_movement_trade:render_to=significant_trade" class="reload"></a>

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


        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
                        <span class="caption-subject bold font-yellow-casablanca uppercase">
                            Significant Value </span>
                            <span class="caption-helper"></span>
                        </div>
                        <div class="tools">
                             <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.significant_movement_value:render_to=significant_value" class="reload"></a>

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


        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            </div>
        </div>
        {{--  New block Ends--}}



    </div>
    {{--Main 2nd content column: End--}}

</div>

{{-- full row at the bottom START--}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-graph font-yellow-casablanca"></i>
                    <span class="caption-subject bold font-yellow-casablanca uppercase">
                        Today news </span>
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
                @include('block.news_box_today')
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>
{{-- full row at the bottom END--}}




@endsection
