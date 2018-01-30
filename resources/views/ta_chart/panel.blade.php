@extends('layouts.metronic.default')
@section('content')
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                   @include('ads.google_responsive')
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    $(document).ready(function () {
        setTimeout(function() {   
                $('#shareList').val('10001');
                $('#shareList').trigger('change');
        }, 100);
    });
</script>
@endpush
@endsection



