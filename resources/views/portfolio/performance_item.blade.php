<tr class='{{$isChild?"hidden transactionChild":"normalTransaction"}}'>
    <td>
        @if($isParent)
        <i class="fa fa-plus showTransactionChildren"></i>
        <i class="fa fa-minus hideTransactionChildren hidden"></i>
        @endif
        @if($isChild)
        <i class="fa fa-chevron-right"></i>
        {{$transaction->transaction_time->format('Y-m-d')}}
        <div>
            {{$transaction->shares}} @ TK{{$transaction->rate}}
        </div>
        @else
        {{$transaction->instrument->instrument_code or 'N/A'}}
        <small class="instrument-name">

            {{$transaction->instrument->name or 'N/A'}}
        </small>
        @endif
    </td>
    <td>
        @if($isChild)
        ...
        @else
        {{$transaction->exchange->name or 'N/A'}}
        @endif
    </td>
    <td>
        @if($isChild)
        ...
        @else
        {{$lastTradePrice or 'N/A'}}
        <small class="last-trade-date">
            ({{$lastTradeDate or 'N/A'}})

        </small>
        @endif
    </td>
    <td class="{{$changeToday<0 ?'text-danger': 'text-success'}}">
        @if($isChild)
        ...
        @else
        {{$changeToday or 'N/A'}}
        ({{$changeTodayPercent}}%)
        @endif
    </td>
    <td class="{{$gainLossToday<0?'text-danger': 'text-success'}}">{{$gainLossToday or 'N/A'}}</td>
    <td>{{$shares}}</td>
    <td>{{$rate}}</td>
    <td>
        @if($isParent)
        Multiple
        @else
        {{$transaction->transaction_time->format('Y-m-d')}}
        @endif
    </td>
    <td>{{$commission}}</td>
    <td>{{$purchaseTotal or 'N/A'}}</td>
    <td class="{{$gainLossTotal<0?'text-danger': 'text-success'}}">{{$gainLossTotal or 'N/A'}}</td>
    <td class="{{$percentChange<0?'text-danger': 'text-success'}}">{{$percentChange or 'N/A'}}</td>
    <td>
        @if($isChild)

        @else
        {{$percentPortfolio or 'N/A'}}
        @endif
    </td>
    <td>{{$sellValue or 'N/A'}}</td>
</tr>
@foreach($childTransactions as $transaction)
@include('portfolio.performance_item',['isChild'=>true])
@endforeach