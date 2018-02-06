@extends('layouts.metronic.default')

@section('content')

                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase">Textile</span>
                                        </div>
                                        <div class="actions">
                                                                                    <a href="javascript:;" class="btn btn-circle red-sunglo ">
                                                                                        <i class="fa fa-plus"></i> Add </a>
                                                                                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                                                                        <i class="icon-cloud-upload"></i>
                                                                                    </a>
                                                                                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                                                                    <a href="" class="collapse" data-original-title="" title=""> </a>
                                                                                </div>
{{--
                                        <div class="tools">
                                         <a href="" class="collapse" data-original-title="" title=""> </a>
                                         <a href="" class="remove" data-original-title="" title=""></a>
                                        </div>
--}}
                                    </div>
                                    <div class="portlet-body">

                                    <div class="row">

                                    <div class="col-md-7">
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Name</th>
                                                                                        <th>Position</th>
                                                                                        <th>Office</th>
                                                                                        <th>Age</th>
                                                                                        <th>Start date</th>
                                                                                        <th>Salary</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tfoot>
                                                                                    <tr>
                                                                                        <th>Name</th>
                                                                                        <th>Position</th>
                                                                                        <th>Office</th>
                                                                                        <th>Age</th>
                                                                                        <th>Start date</th>
                                                                                        <th>Salary</th>
                                                                                    </tr>
                                                                                </tfoot>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>Tiger Nixon</td>
                                                                                        <td>System Architect</td>
                                                                                        <td>Edinburgh</td>
                                                                                        <td>61</td>
                                                                                        <td>2011/04/25</td>
                                                                                        <td>$320,800</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Garrett Winters</td>
                                                                                        <td>Accountant</td>
                                                                                        <td>Tokyo</td>
                                                                                        <td>63</td>
                                                                                        <td>2011/07/25</td>
                                                                                        <td>$170,750</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Ashton Cox</td>
                                                                                        <td>Junior Technical Author</td>
                                                                                        <td>San Francisco</td>
                                                                                        <td>66</td>
                                                                                        <td>2009/01/12</td>
                                                                                        <td>$86,000</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Cedric Kelly</td>
                                                                                        <td>Senior Javascript Developer</td>
                                                                                        <td>Edinburgh</td>
                                                                                        <td>22</td>
                                                                                        <td>2012/03/29</td>
                                                                                        <td>$433,060</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Airi Satou</td>
                                                                                        <td>Accountant</td>
                                                                                        <td>Tokyo</td>
                                                                                        <td>33</td>
                                                                                        <td>2008/11/28</td>
                                                                                        <td>$162,700</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Brielle Williamson</td>
                                                                                        <td>Integration Specialist</td>
                                                                                        <td>New York</td>
                                                                                        <td>61</td>
                                                                                        <td>2012/12/02</td>
                                                                                        <td>$372,000</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Herrod Chandler</td>
                                                                                        <td>Sales Assistant</td>
                                                                                        <td>San Francisco</td>
                                                                                        <td>59</td>
                                                                                        <td>2012/08/06</td>
                                                                                        <td>$137,500</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Rhona Davidson</td>
                                                                                        <td>Integration Specialist</td>
                                                                                        <td>Tokyo</td>
                                                                                        <td>55</td>
                                                                                        <td>2010/10/14</td>
                                                                                        <td>$327,900</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Colleen Hurst</td>
                                                                                        <td>Javascript Developer</td>
                                                                                        <td>San Francisco</td>
                                                                                        <td>39</td>
                                                                                        <td>2009/09/15</td>
                                                                                        <td>$205,500</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Sonya Frost</td>
                                                                                        <td>Software Engineer</td>
                                                                                        <td>Edinburgh</td>
                                                                                        <td>23</td>
                                                                                        <td>2008/12/13</td>
                                                                                        <td>$103,600</td>
                                                                                    </tr>

                                                                                </tbody>
                                                                            </table>
                                    </div>

                                    <div class="col-md-5">
                                    {{--<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.market_frame_old_site:height=400:base=total_value:instrument_id={{$instrumentInfo->id}}" class="reload"></a>--}}

                                    @include('block.market_frame_old_site', array('instrument_id' => 79,'base' =>'total_value'))
                                    </div>

                                    </div>

                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->

                            </div>
                        </div>


        {{--  New block Starts--}}
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

            </div>
        </div>
        {{--  New block Ends--}}

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body">
{{--@include('block.sector_pe_details')--}}
                            </div>
                        </div>
                        <!-- END Portlet PORTLET-->

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-body">
{{--@include('block.sector_pe')--}}
                            </div>
                        </div>
                        <!-- END Portlet PORTLET-->

            </div>
        </div>

{{--@include('block.price_matrix')--}}
{{--@include('block.data_matrix')--}}

{{--@include('block.news_chart',['instrument_id'=>13])--}}

{{--@include('block.sector_minute_chart',['sector_list_id'=>1])--}}

{{--@include('block.sector_gain_loser_column',['height'=>500])--}}

{{--@include('block.gain_loser_depth',['height'=>500])--}}

{{--@include('block.market_composition_bar_per',['base'=>'total_value','height'=>1000])--}}

{{--@include('block.market_composition_bar_total',['base'=>'total_value','height'=>1000])--}}

{{--@include('block.market_composition_pie',['base'=>'total_value'])--}}
{{--@include('block.market_composition_pie',['base'=>'total_volume','height'=>500])--}}

{{--@include('block.price_tree',['base'=>'total_value'])--}}
{{--@include('block.market_depth_single',['instrument_id'=>13])--}}
{{--@include('block.market_frame_old_site',['base'=>'total_value','instrument_id'=>13])--}}

{{--@include('block.advance_chart')--}}
{{--@include('block.market_summary')--}}

{{--@include('block.advance_chart')--}}
{{--@include('block.market_summary')--}}
{{--@include('block.dividend_history')--}}
{{--@include('block.fundamental_summary')--}}
{{--@include('block.share_holdings_chart')--}}
{{--@include('block.share_holdings_history_chart')--}}
{{--@include('block.eps_history_chart_quarter_to_quarter')--}}
{{--@include('block.eps_history_chart_up_to_quarter')--}}
{{--@include('block.net_profit_history_chart_quarter_to_quarter')--}}
{{--@include('block.net_profit_history_chart_up_to_quarter')--}}

{{--@include('block.dividend_possible')--}}

<div class="row">
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
{{--@include('block.top_by_price_change')--}}
     </div>
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
    {{--@include('block.significant_movement_trade')--}}
    {{--@include('html.instrument_list_bs_select',['bs_select_id'=>'bsselect_ggf'])--}}
     </div>
</div>
<div class="row">
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
     {{--@include('block.top_by_price_change')--}}
     </div>
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
     {{--@include('block.top_by_price_change_per')--}}
     </div>
</div>
<div class="row">
     <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
     {{--@include('block.minute_chart',['instrument_id'=>13])--}}

     </div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

     </div>
</div>
{{--@include('block.advance_chart')
@include('block.market_summary')
@include('block.market_summary')--}}


@endsection


@push('scripts')

{{--<script src="{{ asset('metronic/assets/global/scripts/datatable.js') }}"></script>--}}
<script src="{{ asset('metronic/assets/global/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
{{--<script src="{{ asset('metronic/assets/pages/scripts/table-datatables-fixedheader.js') }}"></script>--}}
{{--<script src="{{ asset('metronic/assets/pages/scripts/table-datatables-buttons.min.js') }}"></script>--}}

<script>
    $(document).ready(function () {


           var initTable1 = function (table_id) {
               var table = $('#'+table_id);

               var fixedHeaderOffset = 0;
               if (App.getViewPort().width < App.getResponsiveBreakpoint('md')) {
                   if ($('.page-header').hasClass('page-header-fixed-mobile')) {
                       fixedHeaderOffset = $('.page-header').outerHeight(true);
                   }
               } else if ($('body').hasClass('page-header-menu-fixed')) { // admin 3 fixed header menu mode
                   fixedHeaderOffset = $('.page-header-menu').outerHeight(true);
               } else if ($('body').hasClass('page-header-top-fixed')) { // admin 3 fixed header top mode
                   fixedHeaderOffset = $('.page-header-top').outerHeight(true);
               } else if ($('.page-header').hasClass('navbar-fixed-top')) {
                   fixedHeaderOffset = $('.page-header').outerHeight(true);
               } else if ($('body').hasClass('page-header-fixed')) {
                   fixedHeaderOffset = 64; // admin 5 fixed height
               }

               var oTable = table.dataTable({

                   // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                   "language": {
                       "aria": {
                           "sortAscending": ": activate to sort column ascending",
                           "sortDescending": ": activate to sort column descending"
                       },
                       "emptyTable": "No data available in table",
                       "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                       "infoEmpty": "No entries found",
                       "infoFiltered": "(filtered1 from _MAX_ total entries)",
                       "lengthMenu": "_MENU_ entries",
                       "search": "Search:",
                       "zeroRecords": "No matching records found"
                   },

                   // Or you can use remote translation file
                   //"language": {
                   //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                   //},

                   // setup rowreorder extension: http://datatables.net/extensions/fixedheader/
                   fixedHeader: {
                       header: true,
                       headerOffset: fixedHeaderOffset
                   },

                   // setup colreorder extension: http://datatables.net/extensions/colreorder/
                   colReorder: {
                       reorderCallback: function () {
                           console.log('callback');
                       }
                   },

                   "order": [
                       [0, 'asc']
                   ],

                   // setup responsive extension: http://datatables.net/extensions/responsive/
                   responsive: true,


                   "lengthMenu": [
                       [5, 10, 15, 20, -1],
                       [5, 10, 15, 20, "All"] // change per page values here
                   ],
                   // set the initial value
                   "pageLength": 20,
                   scrollY:        400,

                   // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                   // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                   // So when dropdowns used the scrollable div should be removed.
                   //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
             });
           }


       initTable1("sample_1");

    });
</script>


@endpush



@push('css')

<link href="{{ URL::asset('metronic/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endpush