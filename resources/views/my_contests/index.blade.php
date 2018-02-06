@extends('layouts.metronic.default')
@section('title', "My Contest")
@section('content')
    @include('my_contests.block.index')

    @include('my_contests.block.competitor')
@endsection
