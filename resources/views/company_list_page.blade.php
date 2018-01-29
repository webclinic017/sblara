@section('meta-title','List of all companies of Dhaka Stock Exchange')
@section('meta-description', 'DSE listed companies ')

@extends('layouts.metronic.default')

@section('page_heading')
All Companies
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
								Listed Company </span>
                        <span class="caption-helper">List</span>
                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.company_list" class="reload"></a>
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

{{--
@push('scripts')

<script type="text/javascript">
   $( "#instruments" ).change(function() {
      var insId = $("#instruments").selectpicker("val");
      var url = "{{ url('/fundamental-details/') }}/"+insId;
      window.location = url;
    });

</script>
@endpush--}}
