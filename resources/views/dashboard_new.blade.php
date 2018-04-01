@section('meta-title','Share Market Analysis Portal For Dhaka Stock Exchange (DSE)')
@section('meta-description', "First and oldest financial portal based on share markets of Bangladesh. Pioneer in technical analysis of Bangladesh. Our mission is simple - to make you a better investor so that you can invest conveniently at Dhaka stock exchange. Our Stock Bangladesh tool lets you create the web's best looking financial charts for technical analysis. Our Scan Engine shows you the Bangladesh share market's best investing opportunities")

@extends('layouts.metronic.default')

@section('page_heading')
DSE: {{$trade_date_Info->trade_date->format('l, M d, Y')}}
@endsection

@section('content')

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        @include('block.index_chart')
    </div>


    <div class="col-md-4">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                            Up down </span>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>

                    </a>
                    <a href="" class="remove">
                    </a>
                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.up_down_single_chart" class="reload"></a>
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
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                            Projected Trade </span>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>

                    </a>
                    <a href="" class="remove">
                    </a>
                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.projected_trade_chart" class="reload"></a>
                </div>

            </div>
            <div class="portlet-body">

            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>

{{--
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            @include('block.index_mover')

     </div>

--}}


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
                {{--@include('block.top_sectors')--}}
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
                              Sectors</span>
                              <span class="caption-helper">Total Value (%)</span>

                          </div>
                            <div class="tools">
                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_composition_bar_per:render_to=market_composition_bar_per:base=total_value:height=400:legend=0" class="reload"></a>

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
                            Market Radar: Share price </span>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>

                    </a>
                    <a href="" class="remove">
                    </a>
                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_radar_share_price" class="reload"></a>
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
                              Market Radar: Public share</span>
                              <span class="caption-helper"></span>

                          </div>
                            <div class="tools">
                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_radar_public_holdings" class="reload"></a>

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
                              Market Radar: Institute share</span>
                              <span class="caption-helper"></span>

                          </div>
                            <div class="tools">
                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_radar_institute_holdings" class="reload"></a>

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
{{--

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                   @include('ads.redmas_responsive')
                </div>
            </div>
        </div>
    </div>
--}}

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                   @include('ads.google_responsive')
                </div>
            </div>
        </div>
    </div>



<div class="row">

    <div class="col-md-4">
     @include("block.top_by_price_change_per")
    </div>

    <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet light bordered">
                      <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-graph font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                  Market Mover</span>
                                  <span class="caption-helper">Top 10 by value</span>

                              </div>
                                <div class="tools">
                                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.top_by_trade_value:render_to=gainer_loser_last_minute" class="reload"></a>

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

         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    @include('block.index_mover')

             </div>

{{--    <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet light bordered">
                      <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-graph font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                  Most Active</span>
                                  <span class="caption-helper">Top 10 by trades</span>

                              </div>
                                <div class="tools">
                                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.top_by_no_of_trades" class="reload"></a>

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
        </div>--}}

</div>
<div class="row">

    <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet light bordered">
                      <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-graph font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                  Big buyer/seller</span>
                              </div>
                                <div class="tools">
                                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.top_by_big_buyer" class="reload"></a>

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
                                  Courses</span>
                                  <span class="caption-helper">Upcoming courses</span>

                              </div>
                                <div class="tools">
                                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.upcoming_courses:render_to=upcoming_courses" class="reload"></a>

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
                                  Curated news</span>
                                  <span class="caption-helper">Curated share news</span>

                              </div>
                                <div class="tools">
                                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.recent_news:render_to=recent_news" class="reload"></a>

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

    <div class="col-md-6">
            <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet light bordered">
                      <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-graph font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                  Significant Trades</span>
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
            <!-- END Portlet PORTLET-->
        </div>
    <div class="col-md-6">
            <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet light bordered">
                      <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-graph font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                  Significant Value</span>
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
            <!-- END Portlet PORTLET-->
        </div>

</div>
<div class="row">

    <div class="col-md-6">
            <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bordered">
                  <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                              Daily Stock Bangladesh</span>

                          </div>
                            <div class="tools">
                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.dsb_news:render_to=dsbnews" class="reload"></a>

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
    <div class="col-md-6">
            <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bordered">
                  <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-graph font-yellow-casablanca"></i>
                            <span class="caption-subject bold font-yellow-casablanca uppercase">
                              Stock Bangladesh TV </span>

                          </div>
                            <div class="tools">
                                {{--<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_gainer_loser:render_to=gainer_loser_whole_day_up_down_bar" class="reload"></a>--}}

                                <a href="" class="collapse">
                                </a>

                            </a>
                            <a href="" class="remove">
                            </a>
                        </div>
                    </div>

                <div class="portlet-body">
                @include("html.youtube",array("embed"=>"xYK4Ni385nQ","height"=>200))
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>

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
                        Market Announcement of Dhaka Stock Exchange </span>
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
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-graph font-yellow-casablanca"></i>
                    <span class="caption-subject bold font-yellow-casablanca uppercase">
                       Welcome to StockBangladesh.com </span>
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
                <div style="padding:15px;">
                                <p><span class="label label-primary">Our mission</span> is simple - to make you a better investor so that you can invest conveniently at Bangladesh stock exchange. Our Stock Bangladesh tool lets you create the web's best looking financial charts for technical analysis. Our Scan Engine shows you the Bangladesh share market's best investing opportunities.              </p>
                              <p>In today's world, if you rely on fundamental analysis, brokers advise, share price information, newspaper articles or business channels for your investing or trading decisions, you are asking for a painful experience in the markets.              </p>
                                <p>Whether you are a first time investor, a seasoned pro, an "in and out" day trader or a long term investor at Dhaka stock exchange, StockBangladesh.com will provide you with the necessary information you need for maximum profits and success in today's dynamic markets.Initially we are covering Dhaka share market.              </p>
                                <p><span class="label label-primary">Our goal</span> is to help traders and investors of Bangladesh share market to achieve above-average returns from the markets by providing them with profitable trading signals and at the same time protect their trading capital from large drawdowns with our sound money management principles.              </p>
                              <p>The methods used to analyze securities and make investment decisions fall into two very broad categories: fundamental analysis and technical analysis. Fundamental analysis involves analyzing the characteristics of a company in order to estimate its value. Technical analysis takes a completely different approach; it doesn't care one bit about the "value" of a company or a commodity. Technicians (sometimes called chartists) are only interested in the price movements in the market.            </p>
                            <p>Despite all the fancy and exotic tools it employs, technical analysis really just studies supply and demand in a market in an attempt to determine what direction, or trend, will continue in the future. In other words, technical analysis attempts to understand the emotions in the market by studying the market itself, as opposed to its components. If you understand the benefits and limitations of technical analysis, it can give you a new set of tools or skills that will enable you to be a better trader or investor. </p>
                        </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>
{{-- full row at the bottom END--}}


@endsection

@push('scripts')
<script src="{{ URL::asset('metronic//assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js') }}"></script>

@endpush


