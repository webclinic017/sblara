@extends('layouts.metronic.default')

@section('content')


@if(\Auth::guest())
<div class="row">
	<div class="col-md-12">
		<div class="m-heading-1 border-green m-bordered" style="text-align: center; padding:40px 0 40px 0">
				
			<a href="?login">Sign In </a>to view your saved screeners <br>
			OR <br>
			<a href="/screeners/new" class="btn green"><i class="fa fa-plus"></i> Create New Screener</a>
		</div>
	</div>
</div>
@else

<div class="row">
	<div class="col-md-12 ">
		<div class="m-heading-1 border-green m-bordered">
					
				<h2 style="float: left;">My Screeners</h2>  <a href="/screeners/new" style="float: right;" class="btn btn-success"><i class="fa fa-plus"></i> Create New Screener</a>
				<table class="table table-responsive table-hover">
					@foreach(\Auth::user()->screeners as $screener)
					<tr >
						<td style="vertical-align: middle; min-width: 150px"> <a href="{{url('screeners/'.$screener->slug)}}"><strong>{{$screener->title}}</strong></a> </td>
						<td style="vertical-align: middle;">{{$screener->description}}</td>
						<td  style="text-align: center;"> <a href="/screeners/{{$screener->slug}}"> <strong> {{$screener->resultCount()}}</strong> <br> <small>Matches</small> </a></td>
						<td style="vertical-align: middle;">
							
									<a style="text-decoration: none" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url('/screeners/'.$screener->slug)}}" class="socicon-btn socicon-btn-circle socicon-solid bg-blue font-white bg-hover-grey-salsa socicon-facebook tooltips" data-original-title="Share on Facebook"></a>
							
						</td>
					</tr>
					@endforeach
				</table>
		</div>
	</div>
</div>

@endif


<div class="row">
	<div class="col-md-12 ">
		<div class="m-heading-1 border-green m-bordered">
					
				<h2>Stock Bangladesh Screeners</h2>
				<table class="table table-responsive table-hover">
					@foreach(\App\Screener::where('featured', 1)->get() as $screener)
					<tr >
						<td style="vertical-align: middle; min-width: 150px"> <a href="{{url('screeners/'.$screener->slug)}}"><strong>{{$screener->title}}</strong></a> </td>
						<td style="vertical-align: middle;">{{$screener->description}}</td>
						<td  style="text-align: center;"> <a href="/screeners/{{$screener->slug}}"> <strong> {{$screener->resultCount()}}</strong> <br> <small>Matches</small> </a></td>
						<td style="vertical-align: middle;">
							
									<a style="text-decoration: none" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url('/screeners/'.$screener->slug)}}" class="socicon-btn socicon-btn-circle socicon-solid bg-blue font-white bg-hover-grey-salsa socicon-facebook tooltips" data-original-title="Share on Facebook"></a>
							
						</td>
					</tr>
					@endforeach
				</table>
		</div>
	</div>
</div>

@endsection
@push('css')
<link rel="stylesheet" href="{{asset("metronic/assets/global/plugins/socicon/socicon.css")}}">

@endpush