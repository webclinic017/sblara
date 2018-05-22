<div class="wrapper row" >
	<div class="col-md-4">
		<h6>TA Chart</h6>
			<img src="/tooltip_chart/{{$id}}" alt="" class="img-responsive" style="height: 250px; !important">
	</div>
	<div class="col-md-4">
		<h6>Minute Chart</h6>
		@include('block.minute_chart', ['instrument_id' => $id, 'height' => 250])
	</div>
	<div class="col-md-4">
		<h6>Sector Chart</h6>
		@include('block.sector_minute_chart', ['instrument_id' => $id, 'height' => 250])
	</div>
	<div class="col-md-12" style="margin-top: 5px;">
		{{-- <a href="#" class="btn btn-success">Ta Chart</a> --}}
	</div>
</div>