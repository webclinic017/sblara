@section('title', 'TA Chart : '.ucwords(strtolower($instrumentInfo->name)) .' ('.$instrumentInfo->instrument_code.')')
@section('meta-title', ucwords(strtolower($instrumentInfo->name)) .' ('.$instrumentInfo->instrument_code.') Technical Analysis Chart')
@section('meta-description', 'Analyze '. $instrumentInfo->instrument_code.' with our most accurate and well maintained dse data. A lot of indicators will let you know the probable trends of '.ucwords(strtolower($instrumentInfo->name)))

@section('og:image',url('/tooltip_chart').'/'.$instrumentInfo->id)
@section('og:url',url('/ta-chart').'?instrumentCode='.$instrumentInfo->instrument_code)
@section('og:title', 'TA Chart : '.ucwords(strtolower($instrumentInfo->name)) .' ('.$instrumentInfo->instrument_code.')')
@section('og:description', 'Analyze '. $instrumentInfo->instrument_code.' with our most accurate and well maintained dse data. A lot of indicators will let you know the probable trends of '.ucwords(strtolower($instrumentInfo->name)))
@extends('layouts.metronic.default')
@section('content')


@include("html.fb_comment",array("url"=>url('/ta-chart').'?instrumentCode='.$instrumentInfo->instrument_code))

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



