@foreach ($all_transaction_array as $transaction)

<tr class='{{$transaction['is_child']?"hidden transactionChild":"normalTransaction"}}'>

     <td class="highlight">
    
            @if($transaction['has_child'])
            <i class="fa fa-plus showTransactionChildren"></i>
            <i class="fa fa-minus hideTransactionChildren hidden"></i>
            @endif
            @if($transaction['is_child'])
    
            <i class="fa fa-chevron-right"></i>
            {{$transaction['buying_date_of_this_instrument']}}
            <div>
                {{$transaction['total_shares_of_this_instrument']}} @ TK{{$transaction['avg_buy_cost_of_this_instrument']}}
            </div>
            @else
            {{$transaction['instrument_code'] or 'N/A'}}
            @endif
    
        </td>
    <td>
        @if($transaction['is_child'])
        ...
        @else
        {{$transaction['exchange'] or 'N/A'}}
        @endif
    </td>
    <td>
        @if($transaction['is_child'])
        ...
        @else
        {{$transaction['last_traded_price_of_this_instrument'] or 'N/A'}}
        <small class="last-trade-date">
            ({{$transaction['last_traded_datetime_of_this_instrument'] or 'N/A'}})

        </small>
        @endif
    </td>
    <td class="{{$transaction['change_today_of_this_instrument']<0 ?'text-danger': 'text-success'}}">
        @if($transaction['is_child'])
        ...
        @else
        {{$transaction['change_today_of_this_instrument'] or 'N/A'}}
        ({{$transaction['change_today_per_of_this_instrument']}}%)
        @endif
    </td>
    <td class="{{$transaction['gain_loss_today_for_this_instrument']<0?'text-danger': 'text-success'}}">{{$transaction['gain_loss_today_for_this_instrument'] or 'N/A'}}</td>
    <td>{{$transaction['total_shares_of_this_instrument']}}</td>
    <td>{{$transaction['avg_buy_cost_of_this_instrument']}}</td>
    <td>
        @if($transaction['has_child'])
        Multiple
        @else
        {{$transaction['buying_date_of_this_instrument']}}
        @endif
    </td>
    <td>{{$transaction['total_buy_commission_of_this_instrument']}}</td>
    <td>{{$transaction['total_buying_cost_including_commission_of_this_instrument'] or 'N/A'}}</td>
    <td class="{{$transaction['gain_loss_since_purchased_for_this_instrument']<0?'text-danger': 'text-success'}}">{{$transaction['gain_loss_since_purchased_for_this_instrument'] or 'N/A'}}</td>
    <td class="{{$transaction['gain_loss_per_since_purchased_for_this_instrument']<0?'text-danger': 'text-success'}}">{{$transaction['gain_loss_per_since_purchased_for_this_instrument'] or 'N/A'}}%</td>
    <td>
        @if($transaction['is_child'])

        @else
        {{$transaction['percent_of_portfolio_holding_by_this_instrument'] or 'N/A'}}
        @endif
    </td>
    <td>
        {{$transaction['sell_value_deducting_commission_of_this_instrument'] or 'N/A'}}
    </td>
</tr>
@endforeach

<tr>
    <th colspan="4">Cash</th>
    <th colspan="1"></th>
    <th colspan="3"></th>
    <th colspan="1"></th>
    <th colspan="1"></th>
    <th colspan="1"></th>
    <th colspan="1"></th>
    <th colspan="1" class="{{$cash_amount<0?'text-danger':'text-success'}}">{{$cash_amount_per}}</th>
    <th colspan="1" class="{{$cash_amount<0?'text-danger':'text-success'}}">{{$cash_amount}}</th>
</tr>

<tr>
    <th colspan="4">Total</th>
    <th colspan="1" class="{{fontCss($gainLossToday)}}">{{$gainLossToday}}</th>
    <th colspan="3"></th>
    <th colspan="1"></th>
    <th colspan="1" class="{{$totalPurchaseWithCommission<0?'text-danger':'text-success'}}">{{$totalPurchaseWithCommission}}</th>
    <th colspan="1" class="{{$totalProfitSincePurchase<0?'text-danger':'text-success'}}">{{$totalProfitSincePurchase}}</th>
    <th colspan="1"class="{{$totalChangeSincePurchase<0?'text-danger':'text-success'}}">{{$totalChangeSincePurchase}}%</th>
    <th colspan="1">100%</th>
    <th colspan="1" class="{{$totalSellDeductingCommission<0?'text-danger':'text-success'}}">{{$totalSellDeductingCommission}}</th>
</tr>

