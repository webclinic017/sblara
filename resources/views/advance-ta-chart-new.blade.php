@section('title', ' Advance Technical Analysis Chart : '. $instrumentInfo->name)
@section('meta-title', ' Advance Technical Analysis Chart : '. $instrumentInfo->name)
@section('meta-description', $instrumentInfo->name.' High configurable and nice looking technical analysis chart of Bangladesh. From 5 minutes candle to 1 hour candle available as well as daily data')
@extends('layouts.metronic.default')
@section('content')

    <div class="row">

        <div class="col-md-12">
        


                                       <div id="advance-ta-chart-portlet" allowfullscreen="true" class="portlet light bordered advance-ta-chart-portlet" style="padding: 0 !important; margin:0; border: 0; margin-top:-15px">
                                         @include('tv.modals')
                                            <div class="portlet-body">
                                                <div class="tabbable tabbable-tabdrop advance-ta-chart">
                                                    <ul class="nav nav-tabs" style="margin-bottom: 1px !important; background-color: #EEF1F5">
                                                       <li class="active">
                                                            <a  href="#tab_1_1_1" data-toggle="tab" aria-expanded="true"> CHART </a>
                                                        </li>
                                                        <li class="">
                                                            <a data-url="/ajax/load_block/block_name=block.minute_chart:show_ads=1:instrument_id=" href="#tab_1_1_3" data-toggle="tab" aria-expanded="false"> MINUTE CHART </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#tab_1_1_3" data-toggle="tab" aria-expanded="false"  data-url="/ajax/load_block/block_name=block.market_depth_single:show_ads=1:instrument_id="> MARKET DEPTH </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#tab_1_1_3" data-toggle="tab"  data-url="/ajax/load_block/block_name=block.sector_minute_chart:show_ads=1:instrument_id="  aria-expanded="false"> SECTOR CHART </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#tab_1_1_3" data-toggle="tab"  data-url="https://dev.stockbangladesh.com/ajax/load_block/block_name=block.market_frame_old_site:height=500:base=total_value:instrument_id="  aria-expanded="false"> SECTOR COMPOSITION </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#tab_1_1_3" data-toggle="tab"  data-url="/ajax/load_block/block_name=block_parent.market_status?a="  aria-expanded="false"> MARKET STATUS </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#tab_1_1_3" data-toggle="tab" aria-expanded="false"  data-url="/ajax/load_block/block_name=block.fundamental_summary:show_ads=1:instrument_id=" > FUNDAMENTAL </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#tab_1_1_3" data-toggle="tab" aria-expanded="false"  data-url="/ajax/load_block/block_name=block.news_box:show_ads=1:instrument_id=" > NEWS </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#tab_1_1_3" data-toggle="tab" aria-expanded="false"  data-url="/ajax/load_block/block_name=block.dividend_history:show_ads=1:instrument_id=" > DIVIDEND HISTORY </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#tab_1_1_3"  data-url="/ajax/load_block/block_name=block.share_holdings_history_chart:show_ads=1:instrument_id=" data-toggle="tab" aria-expanded="false"> SHARE HOLDING HISTORY </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#tab_1_1_3" data-toggle="tab" aria-expanded="false"  data-url="/ajax/load_block/block_name=block.news_chart:show_ads=1:instrument_id=" > NEWS CHART </a>
                                                        </li>

                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tab_1_1_1" style="background-color: #EEF1F5">
                                                            <div class="row">
                                                                
                                                                <div class="col-md-12 chart-container" style="background-color: #EEF1F5">  
                                                                        <div id="tvChart" class="col-md-12" style="padding: 0">
                                                                            
                                                                        </div>
                                                                        <div id="TVsidebar" class="col-md-2" style="padding: 0; display: none;">
                                                                                <div class="tree">
                                                                                        <div class="panel-group accordion " id="topList">

                                                                                            <div class="panel panel-default" id="topGainer">
                                                                                                <div class="panel-heading">
                                                                                                    <h4 class="panel-title">
                                                                                                        <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#topList" href="#topGainer_1"> Top Gainer </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <div id="topGainer_1" class="panel-collapse in">
                                                                                                    <div class="panel-body">

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>


                                                                                            <div class="panel panel-default" id="topValue">
                                                                                                <div class="panel-heading">
                                                                                                    <h4 class="panel-title">
                                                                                                         <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#topList" href="#topValue_1"> Top Value </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <div id="topValue_1"  class="panel-collapse collapse">
                                                                                                    <div class="panel-body" >
                                                                                                      
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>


                                                                                            <div class="panel panel-default" id="topVolume">
                                                                                                <div class="panel-heading">
                                                                                                    <h4 class="panel-title">
                                                                                                         <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#topList" href="#topVolume_1"> Top Volume </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <div id="topVolume_1"  class="panel-collapse collapse">
                                                                                                    <div class="panel-body" >
                                                                                                        
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>


                                                                                            <div class="panel panel-default" id="topLoser">
                                                                                                <div class="panel-heading">
                                                                                                    <h4 class="panel-title">
                                                                                                         <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#topList" href="#topLoser_1"> Top Loser </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <div id="topLoser_1"  class="panel-collapse collapse">
                                                                                                    <div class="panel-body" >

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                        <!-- watch list -->
                                                                                        <div class="panel-group accordion " id="watchLists">
                                                                                          
                                                                                            @if(!\Auth::guest())
                                                                                            @php $i = 0; @endphp
                                                                                                @foreach(request()->user()->watchlists as $portfolio)
                                                                                                    <div class="panel panel-default" id="{{$portfolio->id}}" style="position: relative;">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled {{$i != 0?"collapsed":""}}" data-toggle="collapse" data-parent="#watchLists" href="#{{$portfolio->id}}_watchList">  {{$portfolio->name}} 
                                                                                                                 </a>
                                                                                                            </h4>

                                                                                                        </div>
                                                                                                                                                            <div class="btn-group watchlist-options">
                                                        <a class="btn-sm " href="javascript:;" data-toggle="dropdown">
                                                            <i class="fa fa-bars" ></i>
                                                        </a>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a href="javascript:;" class="rename-watchlist" data-name="{{$portfolio->name}}" data-id="{{$portfolio->id}}">
                                                                    <i class="icon-pencil"></i> Rename </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" data-id="{{$portfolio->id}}" class="delete-watchlist">
                                                                    <i class="icon-trash"></i> Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>         
                                                                                                        <div id="{{$portfolio->id}}_watchList" class="panel-collapse {{$i == 0?"in":"collapse"}}">
                                                                                                            @php $i++ ; @endphp
                                                                                                            <div class="panel-body" >

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                                @if($i != 0)

                                                                                                                
                                                                                                                    <a style="width: 100%; text-align: center;" href="#" data-toggle="modal" data-target="#createWatchlist">Create watchlist</a>
                                                                                                           
                                                                                                @endif
                                                                                                @if($i == 0)
                                                                                                    <div class="panel panel-default">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#watchLists" href="#collapse_3_1"> Watchlists </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="collapse_3_1" class="panel-collapse in">
                                                                                                            <div class="panel-body" >
                                                                                                                <p>Looks like you don't have any watchlist yet. <a href="#" data-toggle="modal" data-target="#createWatchlist">Create new watchlist</a>.</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>                                                                                                
                                                                                                @endif
                                                                                            @else
                                                                                            <div class="panel panel-default">
                                                                                                <div class="panel-heading">
                                                                                                    <h4 class="panel-title">
                                                                                                        <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> Watchlists </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <div id="collapse_3_1" class="panel-collapse in">
                                                                                                    <div class="panel-body" >
                                                                                                        <p> Please <a href="/login">login</a> to see your watchlists.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif

                                                                                        </div>       
                                                                                        <!-- watch list -->
                                                                                        
                                                                                        <!-- Portfolios -->

                                                                                        <div class="panel-group accordion " id="portfolios">
                                                                                          
                                                                                            @if(!\Auth::guest())
                                                                                            @php $i = 0; @endphp
                                                                                                @foreach(request()->user()->portfolios as $portfolio)
                                                                                                    <div class="panel panel-default" id="{{$portfolio->id}}">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled {{$i != 0?"collapsed":""}}" data-toggle="collapse" data-parent="#portfolios" href="#{{$portfolio->id}}_portfolio"> {{$portfolio->portfolio_name}} </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="{{$portfolio->id}}_portfolio" class="panel-collapse {{$i == 0?"in":"collapse"}}">
                                                                                                            @php $i++ ; @endphp
                                                                                                            <div class="panel-body" >

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                                @if($i == 0)
                                                                                                    <div class="panel panel-default">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> Portfolios </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="collapse_3_1" class="panel-collapse in">
                                                                                                            <div class="panel-body" >
                                                                                                                <p>Looks like you don't have any portfolio yet. <a href="/portfolio/create">Create new portfolio</a>.</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>                                                                                                
                                                                                                @endif
                                                                                            @else
                                                                                            <div class="panel panel-default">
                                                                                                <div class="panel-heading">
                                                                                                    <h4 class="panel-title">
                                                                                                        <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> Portfolios </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <div id="collapse_3_1" class="panel-collapse in">
                                                                                                    <div class="panel-body" >
                                                                                                        <p> Please <a href="/login">login</a> to see you portfolios.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif

                                                                                        </div>                                                                                        
                                                                                        <!-- Portfolios -->
                                                                                        <!-- screeners -->

                                                                                        <div class="panel-group accordion " id="screeners">
                                                                                            @php $i = 0; @endphp
                                                                                          

                                                                                                    @foreach(\App\Screener::where('featured', 1)->get() as $portfolio)
                                                                                                    <div class="panel panel-default" id="{{$portfolio->id}}sb">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled {{$i != 0?"collapsed":""}}" data-toggle="collapse" data-parent="#screeners" href="#{{$portfolio->id}}sb_screener"> {!!$portfolio->name!!} </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="{{$portfolio->id}}sb_screener" class="panel-collapse {{$i == 0?"in":"collapse"}}">
                                                                                                            @php $i++ ; @endphp
                                                                                                            <div class="panel-body" >

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                                @if($i == 0)
                                                                                                    <div class="panel panel-default">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> Portfolios </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="collapse_3_1" class="panel-collapse in">
                                                                                                            <div class="panel-body" >
                                                                                                                <p>Looks like you don't have any portfolio yet. <a href="/portfolio/create">Create new portfolio</a>.</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>                                                                                                
                                                                                                @endif




                                                                                        </div>                                                                                            
                                                                                        <!-- / screeners -->

                                                                                        <!-- myscreeners -->

                                                                                        <div class="panel-group accordion " id="myscreeners">
                                                                                            @php $i = 0; @endphp
                                                                                          
                                                                                            @if(!\Auth::guest())
                                                                                                    @foreach(request()->user()->screeners as $portfolio)
                                                                                                    <div class="panel panel-default" id="{{$portfolio->id}}">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled {{$i != 0?"collapsed":""}}" data-toggle="collapse" data-parent="#myscreeners" href="#{{$portfolio->id}}_screener"> {!!$portfolio->name!!} </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="{{$portfolio->id}}_screener" class="panel-collapse {{$i == 0?"in":"collapse"}}">
                                                                                                            @php $i++ ; @endphp
                                                                                                            <div class="panel-body" >

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                                @if($i == 0)
                                                                                                    <div class="panel panel-default">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> My Screeners </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="collapse_3_1" class="panel-collapse in">
                                                                                                            <div class="panel-body" >
                                                                                                                <p>Looks like you don't have any screener yet. <a href="/screeners/new">Create new screener</a>.</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>                                                                                                
                                                                                                @endif
                                                                                            @else
                                                                                            <div class="panel panel-default">
                                                                                                <div class="panel-heading">
                                                                                                    <h4 class="panel-title">
                                                                                                        <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> My Screeners </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <div id="collapse_3_1" class="panel-collapse in">
                                                                                                    <div class="panel-body" >
                                                                                                        <p> Please <a href="/login">login</a> to see you screeners.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif

                                                                                        </div>                                                                                            
                                                                                        <!-- / myscreeners -->

                                                                                </div>
                                                                                <div class="navigation">
                                                                                    
                                                                                </div>
                                                                        </div>
                                                                </div>  
                                                                <div class="tv-side-nav">
                                                                    <ul >
                                                                        <li><a   href="javascript:" style="font-size: 11px; padding:5px 0 5px 0; text-align: center; text-decoration:none ; ">Tools</a></li>
                                                                         <li><a data-toggle="tooltip" data-placement="left" title="Top Shares"  href="javascript:" data-tab="#topList"><i class="fa fa-fire"></i></a></li>
                                                                         <li><a data-toggle="tooltip" data-placement="left" title="Watch List"  href="javascript:" data-tab="#watchLists"><i class="fa fa-eye"></i></a></li>
                                                                        <li><a data-toggle="tooltip" data-placement="left" title="Portfolios"  href="javascript:" data-tab="#portfolios"><i class="fa fa-briefcase"></i></a></li>
                                                                        <li><a data-toggle="tooltip" data-placement="left" title="SB Screeners"  href="javascript:" data-tab="#screeners"><i class="fa fa-binoculars"></i></a></li>
                                                                        <li><a data-toggle="tooltip" data-placement="left" title="My Screeners"  href="javascript:" data-tab="#myscreeners"><i class="fa fa-search"></i></a></li>
                                                                        <li  ><a  href="javascript:"><svg height="300" width="100%">
  <text x="0" y="55" fill="#666" transform="rotate(90 20,40)">More tools coming!</text>
</svg></a></li>
                                                                    </ul>
                                                                </div>   


                                                            </div>         
                                                        </div>

                                                        <div class="tab-pane" id="tab_1_1_3">

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
   
{{--http://demo_chart.tradingview.com/--}}

<div id="tv_chart_container"></div>
@push('css')
<link rel="stylesheet" href="/metronic/assets/global/plugins/jstree/dist/themes/default/style.min.css">
<link rel="stylesheet" href="/css/tv.css">
@endpush
@push('scripts')
<script src="/metronic/assets/global/plugins/jstree/dist/jstree.min.js"></script>
<script src="/metronic/assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/vendor/chart_lib/charting_library/charting_library.min.js"></script>

<script type="text/javascript" src="/vendor/chart_lib/datafeeds/udf/dist/polyfills.js"></script>
<script type="text/javascript" src="/vendor/chart_lib/datafeeds/udf/dist/bundle.js"></script>
<script type="text/javascript" src="/metronic/assets/global/plugins/clipboardjs/clipboard.min.js"></script>


        <script type="text/javascript">
$(document).ready(function () {

$('.rename-watchlist').click(function () {
    var id = $(this).data('id')
    var name = $(this).data('name')
    $('#watchlistName').val(name);
    $('#watchlistid').val(id);
    $('#renameModal').modal();
})

$('.delete-watchlist').click(function () {
    var id = $(this).data('id')
    $('#watchlistName').val(name);
    $('#watchlistid').val(id);
    $('#deleteModal').modal();
})
$('.deletewatchlist').click(function () {
    var id = $('#watchlistid').val();
    $.get('/watchlist/delete', {id: id}, function () {
        location.reload()
    });
})

$('.save-watchlist').click(function () {
  var id = $('#watchlistid').val();
    var name = $('#watchlistName').val();
    $.get('/watchlist/rename', {id:id, name: name}, function (data) {
        location.reload();
    })
})
      new ClipboardJS('.btn-copy')
        $('[data-toggle="tooltip"]').tooltip(); 
})            
            @php 
                $data = \App\ChartLayout::find(1);
             @endphp
                var data 
                 $.get('/1.1/charts?chart={{$data->id}}', function (d) {
                    data = d;
                 })

            function getParameterByName(name) {
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                        results = regex.exec(location.search);
                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }

             TradingView.onready(function()
            {                
                var h = $(window).height() - 70;
                h = h+"px";
                var widget = window.tvWidget = new TradingView.widget({
                    // debug: true, // uncomment this line to see Library errors and warnings in the console
                    // fullscreen: true,
                    // autosize: true,
                    height: h,
                    width: "100%",
                    symbol: 'DSEX',
                    interval: 'D',
                    container_id: "tvChart",
                    disable_logo: !0,
                    hideideas: !0,
                    disabled_features: ["use_localstorage_for_settings", "header_fullscreen_button", "show_dialog_on_snapshot_ready"],
                    //  BEWARE: no trailing slash is expected in feed URL
                    datafeed: new Datafeeds.UDFCompatibleDatafeed("{{ url('/') }}"),
                    library_path: "/vendor/chart_lib/charting_library/",
                    locale: getParameterByName('lang') || "en",
                    load_last_chart: true,
                    timezone: "Asia/Almaty",
                    // saved_data: data,
                    //  Regression Trend-related functionality is not implemented yet, so it's hidden for a while
                    drawings_access: { type: 'black', tools: [ { name: "Regression Trend" } ] },
                    enabled_features: ["snapshot_trading_drawings"],
                    charts_storage_url: '{{url('/')}}',
                    charts_storage_api_version: "1.1",
                    snapshot_url: "{{url('/advance-ta-chart/snapshot')}}",
                    client_id: 'stockbangladesh',
                    user_id: 'sb',
                     overrides: {
                            "symbolWatermarkProperties.color": "rgba(0, 0, 0, .1)"
                        }
                });
                //custom code

 
  function toggleFullScreen() {
  var videoElement = document.getElementById("advance-ta-chart-portlet");
    if (!window.fstatus) {
        window.fstatus = true;
      if (videoElement.mozRequestFullScreen) {
        videoElement.mozRequestFullScreen();
      } else {
        videoElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
      }
    } else {
        window.fstatus = false;
      if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else {
        document.webkitCancelFullScreen();
      }
    }
  }
  
              
                function fullscreen(t, widget){
                       toggleFullScreen();
                       t.preventDefault();
                   }
                widget.onChartReady(function() {
                    @if(isset($ticker))
                tvWidget.activeChart().setSymbol("{{strtoupper($ticker)}}")
                @endif
                widget.subscribe('onScreenshotReady', function (data) {
                    // console.log(data);
                    $('#imageurl').val(data);
                    $('#imageshare').attr('href', "https://facebook.com/share.php?u="+data);
                    $('#imagedownload').attr('href', data+"?download=true");
                    $('#shareModal').modal();
                    // window.open("https://facebook.com/share.php?u="+data);

                })  

                    widget.addCustomCSSFile("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css");
                    widget.addCustomCSSFile("/css/charting-library.css");
                    widget.createButton()
                        .attr('title', "Fullscreen")
                        .on('click', function (e) { fullscreen(e, widget); })
                        .append("<i class='fa fa-expand'></i>")

                    // widget.createButton({align:"right"})
                    //     .attr('title', "Screenshot/Share/Save as Image")
                    //     .on('click', function (e) { 
                    //         //share on facebook
                    //         widget.chart().executeActionById('takeScreenshot');
                    //      })
                    //     .addClass(" button first apply-common-tooltip")
                    //     .append("<i class='fa fa-camera'></i>")
                 
// widget.takeScreenshot();
                });             
                //custom code
                $('.advance-ta-chart ul li').click(function () {
                    var instrument = widget.activeChart().symbolExt().symbol
                    var url =  $(this).find('a').data('url');
                    if(!url){return;}
                    <?php $instuments = []; ?>
                    @foreach(\App\Instrument::all() as $instrument)
                        <?php $instruments[$instrument->instrument_code] = $instrument->id; ?>
                    @endforeach
                    var instruments = {!! json_encode($instruments) !!}
                    instrument = instruments[instrument];
                    $.get(url+instrument, function (html) {
                        $('#tab_1_1_3').html(html);
                    })
                })
            });
//functions
function getContent(e = false, panel = false) {
    if(e== false){
        e = $('.tv-side-nav a.active');
    }
    // panel-collapse in
    if(panel != false){
        var panel = panel;
    }else{

        var panel = $(e.data('tab')+" .panel-collapse.in").parents('.panel-default').attr('id');
    }
    if(!panel){return }
    $.get('/tv/tab/'+e.data('tab').replace('#', ''), {panel: panel}, function(data){
        setTimeout(function() {
            $(e.data('tab')+" .panel-collapse.in .panel-body").html(data);
        }, 100);
        
    });
}
$('.tree').on('click', '.accordion-toggle.accordion-toggle-styled', function () {

    var e = $("[data-tab='"+$(this).data('parent')+"']");

    getContent(e, $(this).attr('href').split('_')[0].replace('#', ''));
});
function loadSidebar(e, elem) {
    if(!elem.data('tab')){return }
    $('.tree .accordion').removeClass('active');
    $(elem.data('tab')).addClass('active');
    $('.tv-side-nav ul li a').removeClass('active');
    elem.addClass('active');
    if(elem.attr('loaded') == "true"){
    $('.tv-side-nav ul li a').removeClass('active');
        $('#TVsidebar').hide();
        $('#tvChart').removeClass('col-md-10');
        $('#tvChart').addClass('col-md-12');
        elem.attr('loaded', "false")
    }else{
        getContent(elem);
        $('#TVsidebar').show();
        $('#tvChart').removeClass('col-md-12');
        $('#tvChart').addClass('col-md-10');

    $('.tv-side-nav ul li a').attr('loaded', 'false');
        elem.attr('loaded', "true")
    }
}
// $.get('/sidebar-tree', function (data) {
//     $('#TVsidebar .tree').jstree({ 'core' : {
//         'data' : data
//     } });

// });
$('.tv-side-nav ul li a').click(function (e) {
    loadSidebar(e, $(this));
})

$('.tree').on('click', '.removeItem', function (e) {
    var id = $(this).data('id');
    var instrument_id = $(this).data('instrument');
    $.get('/watchlist/remove', {id: id, instrument_id: instrument_id}, function (data) {
        getContent();
    });
    event.isImmediatePropagationStopped();
})
$('.tree').on('click', 'table tbody tr:not(.removeItem)', function (e) {
    var symbol = $($(this).find('td')[0]).text().trim()
    tvWidget.chart().setSymbol(symbol);
})
$('.tree').on('change', '.watchlistsselect', function (e) {
    var elem = $(this)
    var id = elem.data('id');
    var instrument = elem.val();
    $.post('/watchlist/'+id+'/add', { _token: token, instrument_id: instrument}, function (data) {
        getContent();
    })
})

setInterval(function(){
    getContent()}, 30000)

        </script>


@endpush


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


@endsection