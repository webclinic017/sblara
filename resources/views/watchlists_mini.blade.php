    <div class="form-group" style="position: absolute; display: inline-block; background: #fff; right: 0; top: 25px; border:1px solid #e1e1e1; padding: 10px;">

        <div class="input-group">
            <div class="icheck-list">
                @foreach($watchlists as $watchlist)
                <label>
                    <input type="checkbox" data-id="{{$watchlist->id}}" data-instrument_id = "{{request()->instrument_id}}" class="watchlist-selector" @if($watchlist->instrument_id) checked="true" @endif class="icheck"> {{$watchlist->name}} </label>
                @endforeach
            </div>
        </div>
    </div>