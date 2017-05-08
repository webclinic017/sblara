
@foreach($fundamental_filters as $fundamental)
@php
	$id = 0;
@endphp
	@foreach($fundamental->kind_filters as $kindfilters)
		<div class="col-md-2">
			<select id="fund-{{$id++}}" class="form-control select-filter" tabindex="-1" aria-hidden="true">
				<option value="0">
				    {{$kindfilters->name}}
				</option>
				@foreach($kindfilters->filters as $filter)
					<option value="{{$filter->value}}">{{$filter->name}}</option>
				@endforeach
			</select>
		</div>
	@endforeach
@endforeach
