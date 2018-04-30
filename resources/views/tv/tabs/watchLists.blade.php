@if(\Auth::guest())
<p style="padding: 10px">
Please <a href="/login">login</a> to see your watchlists.
</p>
@else
<table class="table table-striped table-hover">
	<thead>
		
	<tr style="background: #f5f5f5">
		<td>Add Share</td>
		<td>
			<select data-id="{{request()->panel}}"  class="watchlistsselect">
				<option >Select Share</option>
				@foreach(\App\Repositories\InstrumentRepository::getInstrumentsScripWithIndex() as $instrument)
				<option  value="{{$instrument->id}}" >{{$instrument->instrument_code}}</option>
				@endforeach
			</select>
		</td>
	</tr>
	</thead>
</table>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th > Symbol </th>
            <th> Last </th>
            <th colspan="2"> Change </th>
        </tr>
    </thead>
    <tbody>
        @foreach(\App\Instrument::listForTvById(\App\WatchlistItem::where('watchlist_id', request()->panel)->pluck('instrument_id')) as $instrument)
        <tr>
            <td style="color:@if($instrument->gain > 0) green @elseif($instrument->gain < 0) rgb(185, 27, 42) @else #58c3e5 @endif !important"> {{$instrument->instrument_code}} </td>
            <td style="color:@if($instrument->gain > 0) green @elseif($instrument->gain < 0) rgb(185, 27, 42) @else #58c3e5 @endif !important"> {{$instrument->close_price}} </td>
            <td style="color:@if($instrument->gain > 0) green @elseif($instrument->gain < 0) rgb(185, 27, 42) @else #58c3e5 @endif !important" > {{$instrument->gain}}% </td>
        	<td class="removeItem actionIcon" data-instrument="{{$instrument->instrument_id}}" data-id="{{request()->panel}}" style="color: rgb(185, 27, 42) !important"><i class="fa fa-times-circle"></i></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
