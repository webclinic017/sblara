<h1>{{count($screener->getInstruments())}} </h1>
<table class="table table-border table-hover table-responsive">
	<thead>	
		<tr>
			<th>Instrument</th>
			<th>Ltp</th>
			<th>High</th>
			<th>Low</th>
			<th>Volume</th>
			@foreach($screener->getColumns() as $col)
			<th>{{$col}}</th>
			@endforeach
		</tr>
	</thead>

	<tbody>	
		@foreach($screener->getInstruments() as $instrument)
		<tr>
			<td>{{$instrument->instrument_code}}</td>
			<td>{{$instrument->close_price}}</td>
			<td>{{$instrument->high_price}}</td>
			<td>{{$instrument->low_price}}</td>
			<td>{{$instrument->total_volume}}</td>

			@foreach($screener->getColumns() as $col)
			<td>{{$screener->getData($instrument->instrument_id, $col)}}</td>
			@endforeach
		</tr>
		@endforeach
	</tbody>
</table>