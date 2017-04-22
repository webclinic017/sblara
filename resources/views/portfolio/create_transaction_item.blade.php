<tr>
    <td>
        <input type="hidden" value="1" name="types[]">
    </td>
    <td>
        <select class="form-control" name="symbols[]">
            @foreach($instruments as $instrument)
            <option value="{{$instrument->id}}">{{$instrument->instrument_code}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select class="form-control" name="markets[]">
            @foreach($exchanges as  $exchange)
            <option value="{{$exchange->id}}">{{$exchange->name}}</option>
            @endforeach
        </select>

    </td>
    <td>
        <input type="text" name="shares[]" class="form-control">
    </td>
    <td>
        <input type="text" name="price_per_share[]" class="form-control">

    </td>
    <td>
        <input type="text" name="commissions[]" class="form-control" value="0.5">

    </td>
    <td>
        <input type="text" name="dates[]" class="form-control datepicker">

    </td>
</tr>