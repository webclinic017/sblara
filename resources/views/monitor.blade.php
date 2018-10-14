@section('meta-title','Share Market Analysis Portal For Dhaka Stock Exchange (DSE)')
@section('meta-description', "First and oldest financial portal based on share markets of Bangladesh. Pioneer in technical analysis of Bangladesh. Our mission is simple - to make you a better investor so that you can invest conveniently at Dhaka stock exchange. Our Stock Bangladesh tool lets you create the web's best looking financial charts for technical analysis. Our Scan Engine shows you the Bangladesh share market's best investing opportunities")

@extends('layouts.metronic.default')

@section('page_heading')
Market Monitor
@endsection

@section('content')

<div id="app" style="min-height: 400px" >
	<monitor></monitor>
</div>


<script src="{{ url('/js/html2canvas.js')}}"></script>

@endsection