
@foreach($technical_filters as $technical)

@php
	$id = 0;
@endphp
	@foreach($technical->kind_filters as $kindfilters)
		<div class="col-md-2">
			<select id="teh-{{$id++}}" name="teh-{{$id++}}" class="form-control select-filter" tabindex="-1" aria-hidden="true" data-id="{{$kindfilters->id}}">
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
