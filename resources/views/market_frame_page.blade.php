@extends('layouts.metronic.default')

@section('content')

    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Market frame </span>
                        <span class="caption-helper">Eagle view of the market</span>
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
                    @include('block.market_frame_old_site',['base'=>'total_value'])
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>


@endsection