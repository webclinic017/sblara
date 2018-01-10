@extends('layouts.metronic.default')

@section('page_heading')
DSE: {{$trade_date_Info->trade_date->format('l, M d, Y')}}
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
        @include('block.index_chart2')
    </div>
</div>



@endsection
