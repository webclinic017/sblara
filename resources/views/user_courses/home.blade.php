@section('meta-title', 'Amibroker Data Plugin for Dhaka Stock Exchange')
@section('meta-description', 'As a part of continuous support to the community Stock Bangladesh announcing real time data feed of amibroker.')
@extends('layouts.metronic.default')
@section('page_heading')
Amibroker Data plugin for DSE
@endsection
@section('content')


<div class="row">
                            <div class="col-md-12">
<img src="/img/course_banner4.jpg" />
                            </div>
                        </div>

@endsection

@push('css')
<link href="{{ URL::asset('metronic/assets/pages/css/pricing.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
{{--
@push('scripts')
<script src="{{ URL::asset('metronic/assets/global/plugins/ladda/spin.min.js') }}"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/ladda/ladda.min.js') }}"></script>
<script>
$(document).ready(function () {
    $('.plugin-signup').click(function () {
    var l = Ladda.create(this);
        l.start();
        var gid = $(this).data('group');
        $.get('?gid='+gid, function () {
            swal('Request submitted', ' Please wait for approval. Once we approve your request you will get a mail with instructions', 'success');
            l.stop();
        });
    });
});
</script>
@endpush
--}}
