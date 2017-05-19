
@foreach($technical_filters as $technical)

@php
	$id = 0;
@endphp
	@foreach($technical->kind_filters as $kindfilters)
		<div class="col-md-2">
			<select id="teh-{{$id}}" name="teh-{{$id++}}" class="bs-select form-control select-filter" data-live-search="true">
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
