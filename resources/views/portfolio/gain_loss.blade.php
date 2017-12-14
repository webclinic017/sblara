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

    @foreach($all_transaction as $transaction)
    <tr>
        <td>{{$transaction['instrument_code'] or 'N/A'}}</td>
        <td>{{$transaction['exchange'] or 'N/A'}}</td>
        <td>{{$transaction['no_of_shares'] or 'N/A'}}</td>
        <td>{{$transaction['buying_price'] or 'N/A'}}</td>
        <td>{{$transaction['total_buy_commission_of_this_instrument'] or 'N/A'}}</td>
        <td>{{$transaction['total_buy_cost_with_commission_of_this_instrument']}}</td>
        <td>{{$transaction['buying_date'] or 'N/A'}}</td>
        <td>{{$transaction['sell_price']}}</td>
        <td>{{$transaction['total_sell_commission_of_this_instrument']}}</td>
        <td>{{$transaction['total_sell_cost_deducting_commission_of_this_instrument']}}</td>
        <td>{{$transaction['sell_date'] or 'N/A'}}</td>
        <td class="{{$transaction['profit']<0?'text-danger':'text-success'}}">{{$transaction['profit_per']}}</td>
        <td><button class="btn btn-danger btn-sm deleteTransaction" itemId='{{$transaction['id']}}'>Delete</button></td>
    </tr>
    @endforeach
<tr>
    <th colspan="11">Total</th>
    <th colspan="1" class="{{$total_profit<0?'text-danger':'text-success'}}">{{$total_profit}}</th>
    <th colspan="1">Total</th>
</tr>

        {{--@each('portfolio.gain_loss_item',$transactions,'transaction')--}}
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
            }
        })
        return false;
    })

</script>