@extends('layouts.default')

@section('content')

<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
     @include('block.market_summary')
     </div>
</div>
<div class="row">
     <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
     @include('block.index_chart')
     </div>
     <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
     @include('block.sector_gainer_loser')
     </div>

</div>


@endsection



