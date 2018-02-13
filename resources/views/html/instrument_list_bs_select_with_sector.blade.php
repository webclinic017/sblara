<select id="{{$bs_select_id}}"  class="{{isset($class)?$class:'bs-select'}} form-control" data-live-search="true" title="Select share">
        @foreach($instrumentList as $instrument)
            <option value="{{$instrument->id}}" >{{$instrument->instrument_code}} </option>
        @endforeach

     <optgroup label="SECTOR LIST">
        @foreach($sectorList as $sector)
            <option value="sector_{{$sector->id}}" >{{$sector->name}} </option>
        @endforeach
        </optgroup>

</select>


@push('scripts')

<script>
  if($(document).width() < 991)
  {
    $('.bs-select').selectpicker({
      dropupAuto: false,
      liveSearch: false,
      size: 10
    });
  }else{
    $('.bs-select').selectpicker({
      dropupAuto: false,
      size: 10
    });    
  }


</script>
@endpush