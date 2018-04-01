@section('meta-title', ucwords(strtolower($instrumentInfo->name)) . ': Trade And Company Details')
@section('meta-description', 'Latest trade information, insight data and important statistics of '. $instrumentInfo->instrument_code)
@extends('layouts.metronic.default')
@section('page_heading')
{{$instrumentInfo->name}} Company & Trade Insight
@endsection

@section('content')
<div class="row margin-bottom-20">
<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
{{--<h4>Update: {{$lastTradeInfo->lm_date_time->format('d-m-Y H:i')}}</h4>--}}
<a target="_blank" href="{{ url('fundamental-details/') }}/{{$instrumentInfo->id}}" class="btn green-sharp btn-block btn-outline sbold uppercase">Fundamental details of {{$instrumentInfo->name}} </a>
</div>
<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
@include('html.instrument_list_bs_select',['bs_select_id'=>'instruments'])
</div>
</div>
<div class="mt-element-step">
    <div class="row step-thin margin-bottom-20">

        <div class="col-md-3 bg-grey mt-step-col ">
            <div class="mt-step-number bg-white font-grey">O</div>
            <div class="mt-step-title uppercase font-grey-cascade">{{$lastTradeInfo->open_price}}</div>
            <div class="mt-step-content font-grey-cascade">Open</div>
        </div>
        <div class="col-md-3 bg-grey mt-step-col">
            <div class="mt-step-number bg-white font-grey">H</div>
            <div class="mt-step-title uppercase font-grey-cascade">{{$lastTradeInfo->high_price}}</div>
            <div class="mt-step-content font-grey-cascade">High</div>
        </div>
        <div class="col-md-3 bg-grey mt-step-col">
            <div class="mt-step-number bg-white font-grey">L</div>
            <div class="mt-step-title uppercase font-grey-cascade">{{$lastTradeInfo->low_price}}</div>
            <div class="mt-step-content font-grey-cascade">Low</div>
        </div>

            @if($lastTradeInfo->price_change>0)
                    <div class="col-md-3 bg-grey done mt-step-col">
            @endif
            @if($lastTradeInfo->price_change<0)
                    <div class="col-md-3 bg-grey error mt-step-col">
            @endif
            @if($lastTradeInfo->price_change==0)
                    <div class="col-md-3 bg-grey active mt-step-col">
            @endif
            <div class="mt-step-number bg-white font-grey">C</div>
            <div class="mt-step-title uppercase font-grey-cascade">{{$lastTradeInfo->close_price}}</div>
            <div class="mt-step-content font-grey-cascade">Close </div>
        </div>
    </div>
</div>



<div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="dashboard-stat2 ">
                  <div class="display">
                      <div class="number">
                          <h3 class="{{fontCss($lastTradeInfo->price_change)}}">
                              <span data-counter="counterup" data-value="{{$lastTradeInfo->price_change_per}}">{{$lastTradeInfo->price_change_per}}</span> %
                              <small class="{{fontCss($lastTradeInfo->price_change)}}"></small>
                          </h3>
                          <small>Change ({{$lastTradeInfo->price_change}}) </small>
                      </div>
                      <div class="icon">
                          <i class="icon-pie-chart"></i>
                      </div>
                  </div>
                  <div class="progress-info">
                      <div class="progress">
                                              <span style="width: 76%;" class="progress-bar progress-bar-success {{barCss($lastTradeInfo->price_change)}}">
                                                  <span class="sr-only">76% progress</span>
                                              </span>
                      </div>
                      <div class="status">
                          <div class="status-title"> Total Change </div>
                          <div class="status-number">{{$lastTradeInfo->price_change}}</div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="dashboard-stat2 ">
                  <div class="display">
                      <div class="number">
                          <h3 class="{{fontCss($currentVolDiffThenYday)}}">
                              <span data-counter="counterup" data-value="{{$lastTradeInfo->total_volume}}">{{$lastTradeInfo->total_volume}} </span></span>
                          </h3>
                          <small>Trade Volume</small>
                      </div>
                      <div class="icon">
                          <i class="icon-like"></i>
                      </div>
                  </div>
                  <div class="progress-info">
                      <div class="progress">
                                              <span style="width: 85%;" class="progress-bar progress-bar-success {{barCss($currentVolDiffThenYday)}}">
                                                  <span class="sr-only">85% change</span>
                                              </span>
                      </div>
                      <div class="status">
                          <div class="status-title"> Compare with yesterday </div>
                          <div class="status-number"> {{$currentVolDiffThenYday}}
                              ({{$currentVolDiffThenYdayPer}}%)</div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="dashboard-stat2 ">
                  <div class="display">
                      <div class="number">
                          <h3 class="{{fontCss($avgVolCompareWithToday)}}">
                              <span data-counter="counterup" data-value="{{$avgVol}}">{{$avgVol}}</span>
                          </h3>
                          <small>Avg Vol(1 week)</small>
                      </div>
                      <div class="icon">
                          <i class="icon-basket"></i>
                      </div>
                  </div>
                  <div class="progress-info">
                      <div class="progress">
                                              <span style="width: 45%;" class="progress-bar progress-bar-success {{barCss($avgVolCompareWithToday)}}">
                                                  <span class="sr-only">45% grow</span>
                                              </span>
                      </div>
                      <div class="status">
                          <div class="status-title"> Comp to avg vol </div>
                          <div class="status-number"> {{$avgVolCompareWithToday}} ({{$avgVolCompareWithTodayPer}}%)</div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="dashboard-stat2 ">
                  <div class="display">
                      <div class="number">
                          <h3 class="{{fontCss($lastTradeInfo->price_change)}}">
                              <span data-counter="counterup" data-value="{{$lastTradeInfo->yday_close_price}}">{{$lastTradeInfo->price_change}}</span>
                          </h3>
                          <small>Y Close</small>
                      </div>
                      <div class="icon">
                          <i class="icon-user"></i>
                      </div>
                  </div>
                  <div class="progress-info">
                      <div class="progress">
                                              <span style="width: 57%;" class="progress-bar progress-bar-success {{barCss($lastTradeInfo->price_change)}}">
                                                  <span class="sr-only">56% change</span>
                                              </span>
                      </div>
                      <div class="status">
                          <div class="status-title"> Last updated </div>
                          <div class="status-number"> {{$lastTradeInfo->lm_date_time->format('d-m-Y H:i')}} </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>


<div class="row">

        <div class="col-md-12">
                <div class="btn-group btn-group btn-group-justified">
                    <a target="_blank" href="{{'/news-chart/'.$instrumentInfo->id}}" class="btn red"> News Chart </a>
                    <a target="_blank" href="{{'/ta-chart?instrumentCode='.$instrumentInfo->instrument_code}}" class="btn blue"> TA Chart </a>
                    <a target="_blank" href="{{'/advance-ta-chart?instrumentCode='.$instrumentInfo->instrument_code}}" class="btn green"> Advance TA Chart </a>
                    <a target="_blank" href="{{'/minute-chart/'.$instrumentInfo->id}}" class="btn red"> Minute Chart  </a>
                    <a target="_blank" href="{{'/company-details/'.$instrumentInfo->id}}" class="btn blue"> Company Details </a>
                    <a target="_blank" href="{{'/fundamental-details/'.$instrumentInfo->id}}" class="btn green"> Fundamental Details </a>

                </div>

            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Trade Stats</span>
                        <span class="caption-helper">Stats</span>
                    </div>
                    <div class="tools">
                                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.trade_stats:limit=30:instrument_id={{$instrumentInfo->id}}" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
                  {{--   @include('block.news_box', array('instrument_id' => $instrumentInfo->id,'limit' =>30))--}}
                     {{--@include('block.news_box_today')--}}
                     {{--@include('block.news_box', array('instrument_id' => array(12,13),'limit' =>5))--}}
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>

</div>


<div class="row">
       <div class="portlet light bordered">
                       <div class="portlet-body">
                          @include('ads.google_responsive')
                       </div>
                   </div>
    </div>
<div class="row">
        <div class="col-md-6">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								52 Week Stats</span>
                        <span class="caption-helper">Yearly high low</span>
                    </div>
                    <div class="tools">
                                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.yearly_high_low:limit=30:instrument_id={{$instrumentInfo->id}}" class="reload"></a>

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
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Trade Activities</span>
                        <span class="caption-helper">Insight of trades</span>
                    </div>
                    <div class="tools">
                                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.trade_activity:limit=30:instrument_id={{$instrumentInfo->id}}" class="reload"></a>

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


 {{--@include('html.instrument_list_bs_select',['bs_select_id'=>'instruments'])--}}
    <div class="row">

        <div class="col-md-6">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Minute chart </span>
                        <span class="caption-helper">Watch every minute's price movement</span>
                    </div>
                    <div class="tools">
                                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.minute_chart:instrument_id={{$instrumentInfo->id}}:show_ads=0" class="reload"></a>

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
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Sector chart </span>
                        <span class="caption-helper">Watch every minute's sector movement</span>
                    </div>
                    <div class="tools">
                                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:show_ads=0:instrument_id={{$instrumentInfo->id}}" class="reload"></a>

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

@include('block.market_depth_single', array('instrument_id' => $instrumentInfo->id))


<div class="row">

        <div class="col-md-6">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								News chart </span>
                        <span class="caption-helper">Watch news impact on chart</span>
                    </div>
                    <div class="tools">
                    <a href="#" data-load="false" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.news_chart:instrument_id={{$instrumentInfo->id}}" class="reload"></a>
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
                @include('block.news_chart', array('instrument_id' => $instrumentInfo->id))
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
        <div class="col-md-6">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Sector detail chart </span>
                        <span class="caption-helper">Eagle view of the sector</span>
                    </div>
                    <div class="tools">
                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_frame_old_site:height=400:base=total_value:instrument_id={{$instrumentInfo->id}}" class="reload"></a>
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
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								News</span>
                        <span class="caption-helper">News by tag</span>
                    </div>
                    <div class="tools">
                                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.news_box:limit=30:instrument_id={{$instrumentInfo->id}}" class="reload"></a>
                                                
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
                  {{--   @include('block.news_box', array('instrument_id' => $instrumentInfo->id,'limit' =>30))--}}
                     {{--@include('block.news_box_today')--}}
                     {{--@include('block.news_box', array('instrument_id' => array(12,13),'limit' =>5))--}}
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>


    </div>


@endsection

@push('scripts')
<script type="text/javascript">

   $( "#instruments" ).change(function() {
      var insId = $("#instruments").selectpicker("val");
      var url = "{{ url('/company-details/') }}/"+insId;
      window.location = url;
     });


</script>
@endpush