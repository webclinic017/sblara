<tr>
    <td>
        {{$transaction->instrument->instrument_code or 'N/A'}}
        <small class="instrument-name">

            {{$transaction->instrument->name or 'N/A'}}
        </small>
    </td>
    <td>
        {{$transaction->exchange->name or 'N/A'}}
    </td>
    <td>
        {{$lastTradePrice or 'N/A'}}
        <small class="last-trade-date">
            ({{$lastTradeDate or 'N/A'}})

        </small>
    </td>
    <td class="{{$changeToday<0 ?'text-danger': 'text-success'}}">
        {{$changeToday or 'N/A'}}
        ({{$changeTodayPercent}}%)
    </td>
    <td class="{{$gainLossToday<0?'text-danger': 'text-success'}}">{{$gainLossToday or 'N/A'}}</td>
    <td>{{$transaction->shares}}</td>
    <td>{{$transaction->rate}}</td>
    <td>{{$transaction->transaction_time->format('Y-m-d')}}</td>
    <td>{{$transaction->commission}}</td>
    <td>{{$purchaseTotal or 'N/A'}}</td>
    <td class="{{$gainLossTotal<0?'text-danger': 'text-success'}}">{{$gainLossTotal or 'N/A'}}</td>
    <td class="{{$percentChange<0?'text-danger': 'text-success'}}">{{$percentChange or 'N/A'}}</td>
    <td>{{$percentPortfolio or 'N/A'}}</td>
    <td>{{$sellValue or 'N/A'}}</td>
</tr>
