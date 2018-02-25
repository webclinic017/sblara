@extends('voyager::master')
@section('content')
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
  {{session()->get("success")}}
</div>
@endif
@yield('custom')
@endsection