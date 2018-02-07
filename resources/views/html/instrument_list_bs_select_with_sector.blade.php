<select id="{{$bs_select_id}}"  class="{{isset($class)?$class:'bs-select'}} form-control" data-live-search="true" title="Select share">

		 <optgroup label="SECTOR LIST">
        @foreach($sectorList as $sector)
            <option value="sector_{{$sector->id}}" >{{$sector->name}} </option>
        @endforeach
        </optgroup>

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