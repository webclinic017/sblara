<select id='{{$bs_select_id}}' class="bs-select form-control" data-live-search="true" title="Select share">
        @foreach($instrumentList as $instrument)
            {{--<option value="AL">Alabama</option>--}}
            <option value="{{$instrument->id}}" >{{$instrument->instrument_code}} </option>
        @endforeach
</select>

@push('scripts')

<script>
$('.bs-select').selectpicker({
  size: 10
});


</script>
@endpush