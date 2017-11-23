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

    {{--New row START--}}
        <div class="row">
            {{-- 1st column START--}}
            <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
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
                                <a href="" class="collapse">
                                </a>

                            </a>
                            <a href="" class="remove">
                            </a>
                        </div>

                    </div>
                    <div class="portlet-body">
                     {{--   @include('block.dsb_news') --}}
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
            {{-- 1st column END--}}

            {{-- 2nd column START--}}
            <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">

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
                                <a href="" class="collapse">
                                </a>

                            </a>
                            <a href="" class="remove">
                            </a>
                        </div>

                    </div>
                    <div class="portlet-body">

                     {{--    @include('block.dsb_news') --}}
                    </div>
                </div>
                <!-- END Portlet PORTLET-->


            </div>
            {{-- 2nd column END--}}
        </div>
        {{--New row END--}}





        {{--New row START--}}
        <div class="row">
            {{-- 1st column START--}}
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
        {{-- 1st column END--}}

        {{-- 2nd column START--}}
        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">

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
        {{-- 2nd column END--}}
    </div>
    {{--New row END--}}


    {{--New row START--}}
    <div class="row">
        {{-- 1st column START--}}
        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
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
        {{-- 1st column END--}}

        {{-- 2nd column START--}}
        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">

            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
                        <span class="caption-subject bold font-yellow-casablanca uppercase">
                            Sector Compare </span>
                            <span class="caption-helper"> last minute vs Previous minute</span>
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

                    @include('block.intraday_market_composition_bar_per',['base'=>'total_value','height'=>500])
                </div>
            </div>
            <!-- END Portlet PORTLET-->


        </div>
        {{-- 2nd column END--}}
    </div>
    {{--New row END--}}


    {{--New row START--}}
    <div class="row">
        {{-- 1st column START--}}
        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">

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
        {{-- 1st column END--}}

        {{-- 2nd column START--}}
        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">

            @include('block.significant_movement_trade')

        </div>
        {{-- 2nd column END--}}
    </div>
    {{--New row END--}}


    {{--New row START--}}
    <div class="row">
        {{-- 1st column START--}}
        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">

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
        {{-- 1st column END--}}

        {{-- 2nd column START--}}
        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">

            @include('block.significant_movement_value')

        </div>
        {{-- 2nd column END--}}
    </div>
    {{--New row END--}}


    {{--New row START--}}
    <div class="row">
        {{-- 1st column START--}}
        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">

        </div>
        {{-- 1st column END--}}

        {{-- 2nd column START--}}
        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">


        </div>
        {{-- 2nd column END--}}
    </div>
    {{--New row END--}}


    {{--New row START--}}
    <div class="row">
        {{-- 1st column START--}}
        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">

        </div>
        {{-- 1st column END--}}

        {{-- 2nd column START--}}
        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">


        </div>
        {{-- 2nd column END--}}
    </div>
    {{--New row END--}}


</div>
{{--Main content column: End--}}
{{--Ads column : Starts--}}
<div class="col-lg-2 col-md-10 col-sm-6 col-xs-12">

</div>
{{--Ads column : Ends--}}
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
