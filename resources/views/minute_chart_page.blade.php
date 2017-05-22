@extends('layouts.metronic.default')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bordered">

            <div class="portlet-body">
                @include('html.instrument_list_bs_select',['bs_select_id'=>'instruments'])
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>

<div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12">
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
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                        <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.minute_chart:instrument_id={{$instrument_id}}" class="reload"></a>
                    </div>

                </div>
                <div class="portlet-body">

                    {{--@include('block.minute_chart', array('instrument_id' => $instrument_id))--}}

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
      var url = "{{ url('/minute-chart/') }}/"+insId;
      window.location = url;
     });


</script>
@endpush