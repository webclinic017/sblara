@section('meta-title', 'Advance Technical Analysis Chart Of Bangladesh')
@section('meta-description', 'Highly configurable and nice looking technical analysis chart of Bangladesh')
@extends('layouts.metronic.default')

@section('content')

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

        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Advance Chart </span>
                        <span class="caption-helper">Enjoy both realtime intra-day and EOD TA chart</span>
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
                    @include('block.advance_chart')
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>

@endsection