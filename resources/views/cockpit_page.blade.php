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
        <div class="inputs">
                                                    <div class="portlet-input input-inline input-small">
                                                        <div class="input-icon right">
                                                            <i class="icon-magnifier"></i>
                                                            <input id="demo_q" type="text" class="form-control input-circle" placeholder="search..."> </div>
                                                    </div>
                                                </div>
        <div class="actions">
{{--            <div class="btn-group">
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
            </div>--}}
            <a href="javascript:;" class="btn btn-circle red-sunglo ">
                <i class="fa fa-plus"></i> Add </a>
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-cloud-upload"></i>
            </a>
            <a id="cockpit_main" class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body" style="height: auto;">


 <div class="row">
               <div class="col-md-10">

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
                               {{--@include('block.news_box', array('instrument_id' => 13,'limit' =>30))--}}

                              </div>
                              <div class="col-md-6">
               @include('block.market_depth_single', array('instrument_id' => 13))
                              </div>
                          </div>










               </div>
               <div class="col-md-2">

<div id="tree_3" class="tree-demo"> </div>


               </div>
</div>




        </div>

    </div>
</div>
<!-- END Portlet PORTLET-->
</div>
</div>
@endsection



@push('css')

<link href="{{ URL::asset('metronic/assets/global/plugins/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" type="text/css" />
@endpush





@push('scripts')
{{--<script src="{{ URL::asset('metronic/assets/global/plugins/jquery-ui/jquery-ui.min.js') }}"></script>--}}
<script src="{{ URL::asset('metronic/assets/global/plugins/jstree/dist/jstree.min.js') }}"></script>

<script type="text/javascript">

$(document).ready(function () {
       $('#cockpit_main').click();

       							var to = false;
       							$('#demo_q').keyup(function () {
       								if(to) { clearTimeout(to); }
       								to = setTimeout(function () {
       									var v = $('#demo_q').val();
       									$('#tree_3').jstree(true).search(v);
       								}, 250);
       							});


$("#tree_3").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                },
                // so that create works
                "check_callback" : true,
                'data': [{
                        "text": "Parent Node",
                        "children": [{
                            "text": "Initially selected",
                            "state": {
                                "selected": true
                            }
                        }, {
                            "text": "Custom Icon",
                            "icon": "fa fa-warning icon-state-danger"
                        }, {
                            "text": "Initially open",
                            "icon" : "fa fa-folder icon-state-success",
                            "state": {
                                "opened": true
                            },
                            "children": [
                                {"text": "Another node", "icon" : "fa fa-file icon-state-warning"}
                            ]
                        }, {
                            "text": "Another Custom Icon",
                            "icon": "fa fa-warning icon-state-warning"
                        }, {
                            "text": "Disabled Node",
                            "icon": "fa fa-check icon-state-success",
                            "state": {
                                "disabled": true
                            }
                        }, {
                            "text": "Sub Nodes",
                            "icon": "fa fa-folder icon-state-danger",
                            "children": [
                                {"text": "Item 1", "icon" : "fa fa-file icon-state-warning"},
                                {"text": "Item 2", "icon" : "fa fa-file icon-state-success"},
                                {"text": "Item 3", "icon" : "fa fa-file icon-state-default"},
                                {"text": "Item 4", "icon" : "fa fa-file icon-state-danger"},
                                {"text": "Item 5", "icon" : "fa fa-file icon-state-info"}
                            ]
                        }]
                    },
                    "Another Node"
                ]
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "state" : { "key" : "demo2" },
            "plugins" : [ "contextmenu", "dnd", "search", "state", "types" ]
        });

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
