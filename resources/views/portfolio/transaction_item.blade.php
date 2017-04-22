<tr>
    <td>
        <input type="hidden" name="old_transaction_ids[]" value="{{$transaction->id}}">
        <select class="form-control transactionType" name="old_types[]">
            @foreach($types as  $type)
            <option value="{{$type->id}}">{{$type->description}}</option>
            @endforeach
        </select>
    </td>
    <td>
        {{$transaction->instrument->name or 'N/A'}}
    </td>
    <td>
        {{$transaction->exchange->name or 'N/A'}}

    </td>
    <td>
        <div class="type-buy">

            {{$transaction->shares or 'N/A'}}
        </div>
        <div class="type-sell type-edit hidden">
            <input type="text" name="old_shares[]" class="form-control" placeholder="Shares Sold..." value="{{$transaction->shares }}">
        </div>
    </td>
    <td>
        <div class="type-buy">

            {{$transaction->rate}}
        </div>
        <div class="type-sell type-edit hidden">
            <input type="text" name="old_price_per_share[]" class="form-control" placeholder="Price Sold..." value="{{$transaction->rate }}">
        </div>
    </td>
    <td>
        <div class="type-buy">

            {{$transaction->commission}}
        </div>
        <div class="type-sell type-edit hidden">
            <input type="text" name="old_commissions[]" class="form-control" placeholder="Sell Commission..." value="{{$transaction->commission }}">
        </div>

    </td>
    <td>
        <div class="type-buy">
            {{$transaction->transaction_time->format('Y-m-d')}}
        </div>
        <div class="type-sell type-edit hidden">
            <input type="text" name="old_dates[]" class="form-control datepicker" placeholder="Sell Date..." value="{{$transaction->transaction_time->format('Y-m-d') }}">
        </div>
    </td>
</tr>