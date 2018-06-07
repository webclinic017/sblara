<table class="table table-striped table-hover">
	<tr>
		<th>Meta key</th>
		<th>Meta Value</th>
		<th>Meta Date</th>
		<th>Is Latest</th>
	</tr>
	@foreach($fundamentals as $f)
	<tr>
		<td>{{$f->meta_key}}</td>
		<td>{{$f->meta_value}}</td>
		<td>{{$f->meta_date->format('Y-m-d')}}</td>
		<td>{{$f->is_latest}}</td>
	</tr>
	@endforeach
</table>