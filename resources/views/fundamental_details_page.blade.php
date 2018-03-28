@section('meta-title', ucwords(strtolower($instrumentInfo->name)) . ' Fundamental Details')
@section('meta-description', 'Easy representation of EPS, dividend history, shareholding chart as well as share holding history of '. $instrumentInfo->instrument_code)
@extends('layouts.metronic.default')

@section('page_heading')
Fundamental Insight of {{$instrumentInfo->name}} - Cat: {{$category}}
@endsection

@section('content')
<div class="row margin-bottom-20">
<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
<a target="_blank" href="{{ url('company-details/') }}/{{$instrumentInfo->id}}" class="btn green-sharp btn-block btn-outline sbold uppercase">Company details of {{$instrumentInfo->name}} </a>
</div>
<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
@include('html.instrument_list_bs_select',['bs_select_id'=>'instruments'])
</div>

</div>

<div class="clearfix"></div>

@include('block.fundamental_summary', array('instrument_id' => $instrumentInfo->id,'show_ads' => 1))


    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Dividend history </span>
                        <span class="caption-helper">History of cash and stock dividend</span>
                    </div>
                    <div class="tools">
                      <a href="#" data-load="false" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.dividend_history:instrument_id={{ $instrumentInfo->id}}:render_to=divident_possible_{{$instrumentInfo->id}}" class="reload"></a>

                                                           
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
@include('block.dividend_history', array('instrument_id' => $instrumentInfo->id,'render_to' => "divident_possible_".$instrumentInfo->id))

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
    <div class="row">

        <div class="col-md-6">
                <div class="btn-group btn-group btn-group-justified">
                    <a target="_blank" href="{{'/news-chart/'.$instrumentInfo->id}}" class="btn red"> News Chart </a>
                    <a target="_blank" href="{{'/ta-chart?instrumentCode='.$instrumentInfo->instrument_code}}" class="btn blue"> TA Chart </a>
                    <a target="_blank" href="{{'/advance-ta-chart?instrumentCode='.$instrumentInfo->instrument_code}}" class="btn green"> Advance TA Chart </a>

                </div>

            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								SHARE HOLDINGS CHART </span>
                        <span class="caption-helper">Current share holdings</span>
                    </div>
                    <div class="tools">

                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.share_holdings_chart:instrument_id={{$instrumentInfo->id}}:render_to=share_holdings_chart_{{$instrumentInfo->id}}" class="reload"></a>

                        <a href="" class="collapse">
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
        <div class="btn-group btn-group btn-group-justified">
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
								DIVIDEND POSSIBLE </span>
                        <span class="caption-helper">Scope to pay dividend</span>
                    </div>
                    <div class="tools">

                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.dividend_possible:instrument_id={{$instrumentInfo->id}}:render_to=dividend_possible{{$instrumentInfo->id}}" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
                {{--@include('block.dividend_possible', array('instrument_id' => $instrumentInfo->id))--}}

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
								SHARE HOLDINGS HISTORY </span>
                        <span class="caption-helper">See how shares are dristributing over time</span>
                    </div>
                    <div class="tools">

                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.share_holdings_history_chart:instrument_id={{$instrumentInfo->id}}:render_to=share_holdings_history_chart{{$instrumentInfo->id}}" class="reload"></a>

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
								RECENT CORPORATE ACTION </span>
                        <span class="caption-helper">what happened recently</span>
                    </div>
                    <div class="tools">
                        <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.recent_corporate_actions:instrument_id={{$instrumentInfo->id}}:render_to=recent_corporate_action{{$instrumentInfo->id}}" class="reload"></a>

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
								EPS (QUARTER TO QUARTER)</span>
                        <span class="caption-helper">EPS tracking quarter to quarter</span>
                    </div>
                    <div class="tools">
                        <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.eps_history_chart_quarter_to_quarter:instrument_id={{$instrumentInfo->id}}:render_to=eps_quarter_to_quarter{{$instrumentInfo->id}}" class="reload"></a>
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
								EPS (UP TO QUARTER)</span>
                        <span class="caption-helper">EPS tracking up to quarter</span>
                    </div>
                    <div class="tools">
                        <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.eps_history_chart_up_to_quarter:instrument_id={{$instrumentInfo->id}}:render_to=eps_up_to_quarter{{$instrumentInfo->id}}" class="reload"></a>
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
								Yearly NAV</span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                        <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.yearly_nav:instrument_id={{$instrumentInfo->id}}:render_to=yearly_nav{{$instrumentInfo->id}}" class="reload"></a>
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
								Yearly EPS</span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                        <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.yearly_eps:instrument_id={{$instrumentInfo->id}}:render_to=yearly_eps{{$instrumentInfo->id}}" class="reload"></a>
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

@push('scripts')

<script type="text/javascript">
   $( "#instruments" ).change(function() {
      var insId = $("#instruments").selectpicker("val");
      var url = "{{ url('/fundamental-details/') }}/"+insId;
      window.location = url;
    });

</script>
@endpush