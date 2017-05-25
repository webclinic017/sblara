<tr>
    <td>{{$transaction->instrument->instrument_code or 'N/A'}}</td>
    <td>{{$transaction->exchange->name or 'N/A'}}</td>
    <td>{{$transaction->no_of_shares or 'N/A'}}</td>
    <td>{{$transaction->buying_price or 'N/A'}}</td>
    <td>{{$buyCommission or 'N/A'}}</td>
    <td>{{$buyValue}}</td>
    <td>{{$transaction->buying_date or 'N/A'}}</td>
    <td>{{$transaction->sell_price}}</td>
    <td>{{$sellCommission}}</td>
    <td>{{$sellValue}}</td>
    <td>{{$transaction->sell_date or 'N/A'}}</td>
    <td class="{{$profit<0?'text-danger':'text-success'}}">{{$profit}}</td>
    <td><button class="btn btn-danger btn-sm deleteTransaction" itemId='{{$transaction->id}}'>Delete</button></td>
</tr>
