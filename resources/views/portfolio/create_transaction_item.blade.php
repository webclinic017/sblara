<tr>
    <td>
        <input type="hidden" value="buy" name="share_status[]">
    </td>
    <td>
        <select class="form-control" name="instrument_id[]">
            @foreach($instruments as $instrument)
            <option value="{{$instrument->id}}">{{$instrument->instrument_code}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select class="form-control" name="exchange_id[]">
            @foreach($exchanges as  $exchange)
            <option value="{{$exchange->id}}">{{$exchange->name}}</option>
            @endforeach
        </select>

    </td>
    <td>
        <input type="text" name="no_of_shares[]" class="form-control">
    </td>
    <td>
        <input type="text" name="buying_price[]" class="form-control">

    </td>
    <td>
        <input type="text" name="commission[]" class="form-control" value="0.5">

    </td>
    <td>
        <input type="text" name="buying_date[]" class="form-control  portfolio_date">

    </td>
</tr>