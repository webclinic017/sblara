<select  class="{{isset($class)?$class:'bs-select'}} form-control" data-live-search="true" title="Select share">
		@if(isset($prepend))
		<option >Select Share or Sector</option>
		@endif
		 <optgroup label="SECTOR LIST">
        @foreach($sectorList as $sector)
            <option value="sector_{{$sector->id}}" >{{$sector->name}} </option>
        @endforeach
        </optgroup>

        @foreach($instrumentList as $sector=>$all_shares_of_this_sectors)
        <optgroup label="{{$sector}}">
        @foreach($all_shares_of_this_sectors as $instrument)
            <option value="{{$instrument->id}}" >{{$instrument->instrument_code}} </option>
        @endforeach
        </optgroup>
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