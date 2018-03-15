@section('meta-title','Most Popular Share Price List of Dhaka Stock Exchange')
@section('meta-description', "This is highly configurable price list of DSE. You can easily sort, filter and group by sector, category etc ")
@section('page_heading')
Data Matrix : DSE Share Price List
@endsection


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
								Data Matrix - Auto Update</span>
                        <span class="caption-helper">Easy sorting and searching of DSE data</span>
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
                    @include('block.data_matrix')
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>


@endsection