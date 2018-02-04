<select id='{{$bs_select_id}}' class="{{isset($class)?$class:'bs-select'}} form-control" data-live-search="true" title="Select share">
		@if(isset($prepend))
		<option >Select Share</option>
		@endif

        @foreach($sectorList as $sector)
            <option value="sector_{{$sector->id}}" >{{$sector->name}} </option>
        @endforeach

        @foreach($instrumentList as $instrument)
            <option value="{{$instrument->id}}" >{{$instrument->instrument_code}} </option>
        @endforeach
</select>

@push('scripts')

<script>
$('.bs-select').selectpicker({
  dropupAuto: false,
  size: 10
});


</script>
@endpush