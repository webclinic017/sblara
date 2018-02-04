@section('meta-title','An Investment Control Room')
@section('meta-description', 'Seat and relax !!! Watch the market and take the best investment decision from our all in one Bangladesh share market cockpit ')
@extends('layouts.metronic.default')

@section('page_heading')
Cockpit of share market
@endsection

@section('content')

<div class="row">
<div class="col-md-12">
<!-- BEGIN Portlet PORTLET-->
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption font-green-sharp">
            <i class="icon-speech font-green-sharp"></i>
            <span class="caption-subject"> Portlet</span>
            <span class="caption-helper">more samples...</span>
        </div>
        <div class="actions">
            <div class="btn-group">
                <a class="btn btn-circle btn-default " href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user"></i> User
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-pencil"></i> Edit </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-trash-o"></i> Delete </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-ban"></i> Ban </a>
                    </li>
                    <li class="divider"> </li>
                    <li>
                        <a href="javascript:;"> Make admin </a>
                    </li>
                </ul>
            </div>
            <a href="javascript:;" class="btn btn-circle red-sunglo ">
                <i class="fa fa-plus"></i> Add </a>
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-cloud-upload"></i>
            </a>
            <a id="cockpit_main" class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body" style="height: auto;">


 {{--//////////////////////   1st row  \\\\\\\\\\\\\\\\\\\\\\\\\--}}

           <div class="row">
               <div class="col-md-4">
                @include('block.minute_chart',['instrument_id'=>13,'height'=>300])
               </div>
               <div class="col-md-4">
                @include('block.minute_chart',['instrument_id'=>10001,'height'=>300])
               </div>
               <div class="col-md-4">
                @include('block.sector_minute_chart',['instrument_id'=>11,'height'=>300])
               </div>
           </div>


 {{--//////////////////////   2nd  row  \\\\\\\\\\\\\\\\\\\\\\\\\--}}


           <div class="row">
               <div class="col-md-4">
                @include('block.news_box', array('instrument_id' => 13,'limit' =>30))

               </div>
               <div class="col-md-6">
{{--@include('block.market_depth_single', array('instrument_id' => 13))--}}
               </div>
           </div>










        </div>

    </div>
</div>
<!-- END Portlet PORTLET-->
</div>
</div>
@endsection

@push('scripts')
{{--<script src="{{ URL::asset('metronic/assets/global/plugins/jquery-ui/jquery-ui.min.js') }}"></script>--}}

<script type="text/javascript">

$(document).ready(function () {
       $('#cockpit_main').click();


                   /* if (!jQuery().sortable) {
                       return;
                   }

                   $("#sortable_portlets").sortable({
                       connectWith: ".portlet",
                       items: ".portlet",
                       opacity: 0.8,
                       handle : '.portlet-title',
                       coneHelperSize: true,
                       placeholder: 'portlet-sortable-placeholder',
                       forcePlaceholderSize: true,
                       tolerance: "pointer",
                       helper: "clone",
                       tolerance: "pointer",
                       forcePlaceholderSize: !0,
                       helper: "clone",
                       cancel: ".portlet-sortable-empty, .portlet-fullscreen", // cancel dragging if portlet is in fullscreen mode
                       revert: 250, // animation in milliseconds
                       update: function(b, c) {
                           if (c.item.prev().hasClass("portlet-sortable-empty")) {
                               c.item.prev().before(c.item);
                           }
                       }
                   });
*/



    });



</script>
@endpush
