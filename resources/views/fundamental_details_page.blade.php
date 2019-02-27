@section('meta-title', ucwords(strtolower($instrumentInfo->name)) . ' Fundamental Details')
@section('meta-description', 'Easy representation of EPS, dividend history, shareholding chart as well as share holding history of '. $instrumentInfo->instrument_code)
@extends('layouts.metronic.default')

@section('page_heading')
Fundamental Insight of {{$instrumentInfo->name}} - Cat: {{$category}}
@endsection

@section('content')
<div class="row margin-bottom-20">


{{-- fundamental block --}}
<div id="fundamentalFull">
    @include('block.fundamental_full_block', array('instrument_id' => $instrumentInfo->id, 'instrument_code' => $instrumentInfo->instrument_code))
</div>

{{-- fundamental block --}}

@endsection

@push('scripts')

<script type="text/javascript">
   $( "#instruments" ).change(function() {
      var insId = $("#instruments").selectpicker("val");
      var url = "{{ url('/fundamental-details/') }}/"+insId;
      window.location = url;
    });

</script>
@endpush