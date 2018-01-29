@section('meta-title','Category P/E Of Dhaka Stock Exchange, Market P/E')
@section('meta-description', 'Details of price earning ratio (P/E) of all category shares of Dhaka Stock Exchanges. Category P/E play a vital role to take investment decision. So check it before invest')
@extends('layouts.metronic.default')

@section('page_heading')
Sector P/E Chart And Table
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Sector P/E </span>
                        {{--<span class="caption-helper">Current share holdings</span>--}}
                    </div>
                    <div class="tools">

                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.category_pe" class="reload"></a>

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

    </div>

@endsection
