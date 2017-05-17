@extends('layouts.metronic.default')

@section('content')
<div class="row margin-bottom-20">
<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
<h4>{{$instrumentInfo->name}}</h4>
</div>
<div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
@include('html.instrument_list_bs_select',['bs_select_id'=>'instruments'])
</div>
</div>

<div class="clearfix"></div>

@include('block.fundamental_summary', array('instrument_id' => $instrumentInfo->id))


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
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">

                @include('block.dividend_history', array('instrument_id' => $instrumentInfo->id))

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
								SHARE HOLDINGS CHART </span>
                        <span class="caption-helper">Current share holdings</span>
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
                    @include('block.share_holdings_chart', array('instrument_id' => $instrumentInfo->id))

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
								DIVIDEND POSSIBLE </span>
                        <span class="caption-helper">Scope to pay dividend</span>
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
                @include('block.dividend_possible', array('instrument_id' => $instrumentInfo->id))

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
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
                    @include('block.share_holdings_history_chart', array('instrument_id' => $instrumentInfo->id))

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
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
                @include('block.eps_history_chart_quarter_to_quarter', array('instrument_id' => $instrumentInfo->id))
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
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
                @include('block.eps_history_chart_up_to_quarter', array('instrument_id' => $instrumentInfo->id))
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
								NET PROFIT AFTER TEX (QUARTER TO QUARTER)</span>
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

                @include('block.net_profit_history_chart_quarter_to_quarter', array('instrument_id' => $instrumentInfo->id))
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
								NET PROFIT AFTER TEX (UP TO QUARTER)</span>
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
                @include('block.net_profit_history_chart_up_to_quarter', array('instrument_id' => $instrumentInfo->id))
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