<tr>
    <th colspan="4">Cash</th>
    <th colspan="1"></th>
    <th colspan="3"></th>
    <th colspan="1"></th>
    <th colspan="1"></th>
    <th colspan="1"></th>
    <th colspan="1"></th>
    {{--<th colspan="1">100%</th>--}}
    <th colspan="1" class="{{$cash_amount<0?'text-danger':'text-success'}}">{{$cash_amount}}</th>
</tr>

<tr>
    <th colspan="4">Total</th>
    <th colspan="1" class="{{fontCss($gainLossToday)}}">{{$gainLossToday}}</th>
    <th colspan="3"></th>
    <th colspan="1"></th>
    <th colspan="1" class="{{$totalPurchaseWithCommission<0?'text-danger':'text-success'}}">{{$totalPurchaseWithCommission}}</th>
    <th colspan="1" class="{{$totalProfitSincePurchase<0?'text-danger':'text-success'}}">{{$totalProfitSincePurchase}}</th>
    <th colspan="1"class="{{$totalChangeSincePurchase<0?'text-danger':'text-success'}}">{{$totalChangeSincePurchase}}</th>
    {{--<th colspan="1">100%</th>--}}
    <th colspan="1" class="{{$totalSellDeductingCommission<0?'text-danger':'text-success'}}">{{$totalSellDeductingCommission}}</th>
</tr>