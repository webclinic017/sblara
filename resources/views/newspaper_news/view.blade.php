@section('meta-title', $newspaperNews->title . ' | Share Market News')
@section('meta-description',str_limit($newspaperNews->details,160))

@extends('layouts.metronic.default')
@section('page_heading')
{{ $newspaperNews->title }} 
@endsection


@section('content')

<div class="portlet light bordered" id="blockui_sample_1_portlet_body">
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-newspaper-o"></i>STOCK BANGLADESH NEWS gfhgf
            </div>
        </div>
        <div class="search-page search-content-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-container bordered ">
                        <div class="search-content" style="margin-left: 15px; margin-right: 15px">
                            <h2 class="search-title">
                                <a href="javascript:;">{{ $newspaperNews->title }}</a>
                                <label class="pull-right">{{ $newspaperNews->published_date }}</label>
                            </h2>
                            <p class="search-desc">{!! $newspaperNews->details !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
<script>
    @if (old('instrument_id'))
            document.getElementById("instrument_id").value = "{{old('instrument_id')}}";
    @endif
</script>
@endsection