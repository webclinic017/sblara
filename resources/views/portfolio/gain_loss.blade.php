<table class="table table-striped" id="realized_gainloss">
    <thead>
        <tr>
            <th>Company Name</th>
            {{--<th>Market</th>--}}
            <th>Shares</th>
            <th>Buy Price</th>
            <th>Buy Comm.</th>
            <th>Total Buy Price</th>
            <th>Buy Date</th>
            <th>Sell Price</th>
            <th>Sell Comm.</th>
            <th>Total Sell Price</th>
            <th>Sell Date</th>
            <th>G/L</th>
            <th>G/L(%)</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

    @foreach($all_transaction as $transaction)
    <tr>
        <td><a target="_blank" href="{{url('/ta-chart?instrumentCode='.$transaction['instrument_code'])}}">{{$transaction['instrument_code'] or 'N/A'}}</a></td>
        
        {{--<td>{{$transaction['exchange'] or 'N/A'}}</td>--}}
        <td>{{$transaction['no_of_shares'] or 'N/A'}}</td>
        <td>{{$transaction['buying_price'] or 'N/A'}}</td>
        <td>{{$transaction['total_buy_commission_of_this_instrument'] or 'N/A'}}</td>
        <td>{{$transaction['total_buy_cost_with_commission_of_this_instrument']}}</td>
        <td>{{$transaction['buying_date'] or 'N/A'}}</td>
        <td>{{$transaction['sell_price']}}</td>
        <td>{{$transaction['total_sell_commission_of_this_instrument']}}</td>
        <td>{{$transaction['total_sell_cost_deducting_commission_of_this_instrument']}}</td>
        <td>{{$transaction['sell_date'] or 'N/A'}}</td>
        <td class="{{fontCss($transaction['profit'])}}">{{$transaction['profit']}}</td>
        <td class="{{fontCss($transaction['profit'])}}">{{$transaction['profit_per']}}</td>
        <td><button class="btn btn-danger btn-sm deleteTransaction" itemId='{{$transaction['id']}}'>Delete</button></td>
    </tr>
    @endforeach


        {{--@each('portfolio.gain_loss_item',$transactions,'transaction')--}}
        {{csrf_field()}}
    </tbody>
</table>

<table class="table table-striped" >
 <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>

        </tr>
    </thead>
<tr>
    <td colspan="12"><h3>Total Realized Gain/Loss</h3></td>
    <td colspan="1" class="{{fontCss($total_profit)}}"><h3>{{$total_profit}} Taka</h3></td>

</tr>

</tbody>
</table>

<script>
    $(".deleteTransaction").click(function () {
        var id = $(this).attr('itemId');
        var tr = $(this).closest('tr');
        $.ajax({
            url: '/portfolio_transaction/' + id,
            type: 'delete',
            data: {_token: $("[name=_token]").val()},
            success: function () {
                tr.remove();
            }
        })
        return false;
    })





</script>

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

              $.fn.dataTable.moment( 'MMM D, YY' );   // this is needed for sorting by date
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
                   scrollY:        400

                   // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                   // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                   // So when dropdowns used the scrollable div should be removed.
                   //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
             });
           }

initTable1("realized_gainloss");




    });
</script>