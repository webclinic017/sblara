@extends('layouts.metronic.default')

@section('page_heading')
TA HOME{{--: {{$trade_date_Info->trade_date->format('l, M d, Y')}}--}}
@endsection

@section('content')

{{--

<div class="row">

    <div class="col-md-4">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                            Market Radar: Paid up </span>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>

                    </a>
                    <a href="" class="remove">
                    </a>
                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_radar_paidup" class="reload"></a>
                </div>

            </div>
            <div class="portlet-body">

            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
    <div class="col-md-4">
        <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bordered">
                  <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                              Market Radar: PE</span>
                              <span class="caption-helper"></span>

                          </div>
                            <div class="tools">
                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_radar_pe:render_to=gainer_loser_whole_day_up_down_bar" class="reload"></a>

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
    <div class="col-md-4">
        <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bordered">
                  <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                              Market Radar: category</span>
                              <span class="caption-helper"></span>

                          </div>
                            <div class="tools">
                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_radar_category:render_to=gainer_loser_last_minute" class="reload"></a>

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


<div class="row">

    <div class="col-md-4">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                            Top Sector </span>
                    <span class="caption-helper">Most of the money there</span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>

                    </a>
                    <a href="" class="remove">
                    </a>
                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.top_sectors" class="reload"></a>
                </div>

            </div>
            <div class="portlet-body">
                --}}
{{--@include('block.top_sectors')--}}{{--

            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
    <div class="col-md-4">
        <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bordered">
                  <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                              Sectors (Day)</span>
                              <span class="caption-helper">Gainer Loser</span>

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
        <!-- END Portlet PORTLET-->
    </div>
    <div class="col-md-4">
        <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bordered">
                  <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                              Sectors (minute)</span>
                              <span class="caption-helper">Gainer Loser</span>

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

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                   @include('ads.google_responsive')
                </div>
            </div>
        </div>
    </div>
--}}


@endsection

@push('scripts')
<script src="{{ URL::asset('metronic//assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js') }}"></script>

@endpush


