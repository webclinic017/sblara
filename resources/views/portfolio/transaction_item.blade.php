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

            {{$transaction->no_of_shares or 'N/A'}}
        </div>
        <div class="type-sell type-edit hidden">
            <input type="text" name="old_shares[]" class="form-control" placeholder="Shares Sold..." value="{{$transaction->no_of_shares }}">
        </div>
    </td>
    <td>
        <div class="type-buy">

            {{$transaction->buying_price}}
        </div>
        <div class="type-sell type-edit hidden">
            <input type="text" name="old_price_per_share[]" class="form-control" placeholder="Price Sold..." value="{{$transaction->buying_price }}">
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
            {{$transaction->buying_date->format('Y-m-d')}}
        </div>
        <div class="type-sell type-edit hidden">
            <input type="text" name="old_dates[]" class="form-control datepicker" placeholder="Sell Date..." value="{{$transaction->buying_date->format('Y-m-d') }}">
        </div>
    </td>
</tr>