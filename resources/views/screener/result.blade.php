  @php
 // dd($screener->getColumns());
 $i = 0;
 @endphp

     <div class="row">

         <div class="col-md-12">
             <!-- BEGIN Portlet PORTLET-->
             <div class="portlet light bordered">
                 <div class="portlet-title">
                     <div class="caption">
                         <i class="icon-graph font-yellow-casablanca"></i>
 								<span class="caption-subject bold font-yellow-casablanca uppercase">

 								<small style="margin-left:10px"></small> {{count($screener->getInstruments())}} <small>matches</small></span>
                         <span class="caption-helper"></span>
                     </div>
                     <div class="tools">
                             <a href="" class="collapse">
                         </a>

                         </a>
                         <a href="" class="fullscreen">
                         </a>
                     </div>

                 </div>
                 <div class="portlet-body">

<table class="table table-striped table-bordered table-hover" id="sample_1">
	<thead>
		<tr>
			<th>Instrument</th>
			<th>Ltp</th>
			<th>High</th>
			<th>Low</th>
			<th>Volume</th>
			@foreach($screener->getConditions() as $condition)
				@foreach($condition as $col => $v)
					<th>{{$col}}</th>
				@endforeach
			@endforeach
		</tr>
	</thead>

	<tbody>
		@foreach($screener->getInstruments() as $instrument)
		<tr>
			<td><a target="_blank" href="/ta-chart?instrumentCode={{$instrument->instrument_code}}">{{$instrument->instrument_code}}</a></td>
			<td>{{$instrument->close_price}}</td>
			<td>{{$instrument->high_price}}</td>
			<td>{{$instrument->low_price}}</td>
			<td>{{$instrument->total_volume}}</td>

			@foreach($screener->getConditions() as $condition=>$cols)
				@foreach($cols as $col=>$v)
					<td>{!!$screener->getData($instrument->instrument_id, $condition, $col)!!}</td>
				@endforeach
			@endforeach			
		</tr>
		@php $i++; @endphp
		@endforeach
	</tbody>
</table>

                 </div>
             </div>
             <!-- END Portlet PORTLET-->
         </div>


     </div>


<script>
	@if($i != 0)
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
                       [5, 'asc']
                   ],

                   // setup responsive extension: http://datatables.net/extensions/responsive/
                   responsive: true,


                   "lengthMenu": [
                       [5, 10, 15, 20, -1],
                       [5, 10, 15, 20, "All"] // change per page values here
                   ],
                   // set the initial value
                     scrollY:        400,
                   "pageLength": 500

                   // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                   // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                   // So when dropdowns used the scrollable div should be removed.
                   //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
             });
           }


       initTable1("sample_1");

    });
    @endif
</script>

