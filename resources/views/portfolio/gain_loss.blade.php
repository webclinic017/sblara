<table class="table table-striped">
    <thead>
        <tr>
            <th>Company Name</th>
            <th>Market</th>
            <th>Shares</th>
            <th>Buy Price</th>
            <th>Buy Comm.</th>
            <th>Total Buy Price</th>
            <th>Buy Date</th>
            <th>Sell Price</th>
            <th>Sell Comm.</th>
            <th>Total Sell Price</th>
            <th>Sell Date</th>
            <th>Gain/Loss</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @each('portfolio.gain_loss_item',$transactions,'transaction')
        {{csrf_field()}}
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
            },
        })
        return false;
    })

</script>