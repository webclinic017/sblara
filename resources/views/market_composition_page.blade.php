@section('meta-title','Market Composition of DSE')
@section('meta-description', "Another tool of market overview for DSE ")
@section('page_heading')
Market Composition
@endsection


@extends('layouts.metronic.default')
@section('content')
<!-- following style is to solve highchart problem in hidden tab-->
<style>
    .tab-content > .tab-pane,
    .pill-content > .pill-pane {
        display: block;     /* undo display:none          */
        height: 0;          /* height:0 is also invisible */
        overflow-y: hidden; /* no-overflow                */
    }
    .tab-content > .active,
    .pill-content > .active {
        height: auto;       /* let the content decide it  */
    } /* bootstrap hack end */

</style>

    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
           <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-globe font-yellow-casablanca"></i>
                                <span class="caption-subject font-yellow-casablanca bold uppercase">Market Composition</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" class="active" data-toggle="tab" aria-expanded="true">Sector Wise(Value) </a>
                                </li>
                                <li class="">
                                    <a href="#tab_1_2" data-toggle="tab" aria-expanded="false"> Sector Wise(Volume) </a>
                                </li>
                                <li class="">
                                    <a href="#tab_1_3" data-toggle="tab" aria-expanded="false"> Bar chart (total value) </a>
                                </li>
                                <li class="">
                                    <a href="#tab_1_4" data-toggle="tab" aria-expanded="false"> Bar chart (%) </a>
                                </li>
                                <li class="">
                                    <a href="#tab_1_5" data-toggle="tab" aria-expanded="false"> Gainer/Loser depth </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <!--BEGIN TABS-->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                @include('block.market_composition_pie',['base'=>'total_value'])

                                </div>
                                <div class="tab-pane" id="tab_1_2">
                                    @include('block.market_composition_pie',['base'=>'total_volume'])
                                </div>
                                <div class="tab-pane" id="tab_1_3">
                                     @include('block.market_composition_bar_total',['base'=>'total_value','height'=>1000])
                                </div>
                                <div class="tab-pane" id="tab_1_4">
                                     @include('block.market_composition_bar_per',['base'=>'total_value','height'=>1000])
                                </div>
                                <div class="tab-pane" id="tab_1_5">
                                     @include('block.gain_loser_depth',['height'=>500])
                                     @include('block.sector_gain_loser_column',['height'=>500])
                                </div>
                            </div>
                            <!--END TABS-->
                        </div>
                    </div>
            <!-- END Portlet PORTLET-->





        </div>
    </div>

        <div class="row">

            <div class="col-md-12">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-graph font-yellow-casablanca"></i>
    								<span class="caption-subject bold font-yellow-casablanca uppercase">
    								Market Composition Data </span>
                            <span class="caption-helper">table of market composition</span>
                        </div>
                        <div class="tools">

                        <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_composition_table:base=total_value" class="reload"></a>

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


@endsection