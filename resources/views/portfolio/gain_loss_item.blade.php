<tr>
    <td>{{$transaction->instrument->name or 'N/A'}}</td>
    <td>{{$transaction->exchange->name or 'N/A'}}</td>
    <td>{{$transaction->shares or 'N/A'}}</td>
    <td>{{$parentTransaction->rate or 'N/A'}}</td>
    <td>{{$buyCommission or 'N/A'}}</td>
    <td>{{$parentTransaction->amount or 'N/A'}}</td>
    <td>{{$parentTransaction?$parentTransaction->transaction_time->format('Y-m-d') : 'N/A'}}</td>
    <td>{{$transaction->rate}}</td>
    <td>{{$sellCommission}}</td>
    <td>{{$transaction->amount}}</td>
    <td>{{$transaction->transaction_time?$transaction->transaction_time->format('Y-m-d'):'N\A'}}</td>
    <td class="{{$profit<0?'text-danger':'text-success'}}">{{$profit}}</td>
    <td>Delete</td>
</tr>
