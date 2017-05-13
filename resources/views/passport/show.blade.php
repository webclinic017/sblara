@extends('layouts.metronic.default')

@section('content')
    <div id="app">
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
@endsection

@push('scripts')
<!-- Passport mixed components -->
<script src="{{ asset('js/passport-vue.js') }}"></script>
@endpush
