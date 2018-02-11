{{-- This block cant be used as ajax. As we need some js inclusion --}}

<style>
.popover{
    max-width:600px;
    height:350px;

}
</style>

<table class="table table-striped table-bordered table-hover" id="sample_1">
    <thead>
        <tr>
            <th>Company</th>
            <th>LTP</th>
            <th>Dividend Yield</th>
            <th>Payout Ratio</th>
            <th>Declaration(C)</th>
            <th>Declaration Date</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Company</th>
            <th>LTP</th>
            <th>Dividend Yield</th>
            <th>Payout Ratio</th>
            <th>Declaration(C)</th>
            <th>Declaration Date</th>
        </tr>
    </tfoot>
    <tbody>
       @foreach($return_arr as $instrumentId=>$instrument)
        <tr>
            <td>@include('html.tooltip_chart',array('instrumentId'=>$instrumentId,'instrument_code'=>$instrument['instrument_code']))</td>
            <td>{{$instrument['ltp']}}</td>
            <td>{{$instrument['dividend_yield']}}%</td>
            <td>{{$instrument['payout_ratio']}}%</td>
            <td>{{$instrument['declaration']}}%</td>
            <td>{{$instrument['declaration_date']}}</td>

        </tr>
        @endforeach

    </tbody>
</table>

* Calculation includes companies which declared cash dividend.

* EPS has been taken as per the last audited report.

* For undetermined result due to information unavailability we use N/A.

* We use real data for the calculation.

* Both the ratios presented as percentage.



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
/*
                   fixedHeader: {
                       header: true,
                       headerOffset: fixedHeaderOffset
                   },

*/
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