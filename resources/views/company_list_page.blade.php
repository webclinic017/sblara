@section('meta-title','Latest Price List of Dhaka Stock Exchange')
@section('meta-description', 'A goto page for DSE listed companies. You can see latest price in a simple table with updated every minute')

@extends('layouts.metronic.default')
@section('page_heading')
Latest Share Price of Dhaka Stock Exchange
@endsection

@section('content')
{{--@include('block.company_list')--}}
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Listed Company of DSE</span>
                        <span class="caption-helper">Easy search and sortable list</span>
                    </div>
                    <div class="tools">
    <a href="#" data-load="false" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.company_list_table" class="reload"></a>
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
@include('block.company_list_table')

                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>


    </div>


@endsection


@push('scripts')

<script src="{{ asset('metronic_custom/datatable/jquery.dataTables.min.js') }}"></script>

@endpush



@push('css')

{{--
<style>
.color-down .irs-bar,
.color-down .irs-bar-edge {
    background: red;
}

.color-up .irs-bar,
.color-up .irs-bar-edge {
    background: green;
}
</style>
--}}

<link href="{{ URL::asset('metronic/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
{{--<link href="{{ URL::asset('metronic/assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ URL::asset('metronic/assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ URL::asset('metronic/assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ URL::asset('metronic/assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.skinModern.css') }}" rel="stylesheet" type="text/css" />--}}
@endpush

@push('scripts')
{{--
<script src="{{ URL::asset('metronic/assets/global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ URL::asset('metronic/assets/pages/scripts/components-ion-sliders.min.js') }}"></script>
--}}

@endpush


