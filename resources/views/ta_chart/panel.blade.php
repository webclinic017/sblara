@section('title', 'TA Chart : '.ucwords(strtolower($instrumentInfo->name)) .' ('.$instrumentInfo->instrument_code.')')
@section('meta-title', ucwords(strtolower($instrumentInfo->name)) .' ('.$instrumentInfo->instrument_code.') Technical Analysis Chart')
@section('meta-description', 'Analyze '. $instrumentInfo->instrument_code.' with our most accurate and well maintained dse data. A lot of indicators will let you know the probable trends of '.ucwords(strtolower($instrumentInfo->name)))

@extends('layouts.metronic.default')
@section('content')
@push('scripts')
<script>
    $(document).ready(function () {
        setTimeout(function() {
                $('#shareList').val('{{$instrumentInfo->id}}');
                $('#shareList').trigger('change');
        }, 100);
    });
</script>
@endpush
@endsection



