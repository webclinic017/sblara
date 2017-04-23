<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="2"></th>
            <th colspan="3">Today</th>
            <th colspan="3"></th>
            <th colspan="4">Since Purchased</th>
            <th colspan="2"></th>
        </tr>
        <tr>
            <th>Company Code</th>
            <th>Market</th>
            <th>Last Trade Price</th>
            <th>Change</th>
            <th>Gain/Loss</th>
            <th>Shares</th>
            <th>Buy Price</th>
            <th>Purchase Date</th>
            <th>Buy Commission</th>
            <th>Total Purchase</th>
            <th>Gain/Loss</th>
            <th>%Change</th>
            <th>%Portfolio</th>
            <th>Sell Value</th>
        </tr>
    </thead>
    <tbody>
        @each('portfolio.performance_item',$transactions,'transaction')
        @include('portfolio.performance_total_item',['portfolio'=>$portfolio])


    </tbody>
</table>
<script>
    $(".showTransactionChildren").click(function () {
        $(this).addClass('hidden');
        var tr = $(this).closest('tr');
        tr.nextUntil('.normalTransaction').removeClass('hidden');
        tr.find('.hideTransactionChildren').removeClass('hidden');
    })
    $(".hideTransactionChildren").click(function () {
        $(this).addClass('hidden');
        var tr = $(this).closest('tr');
        tr.nextUntil('.normalTransaction').addClass('hidden');
        tr.find('.showTransactionChildren').removeClass('hidden');
    })
</script>