@extends('layouts.metronic.default')
@section('content')
@if(\Auth::guest())
<div class="row">
	<div class="col-md-12">
		<div class="m-heading-1 border-green m-bordered" style="text-align: center; padding:40px 0 40px 0">
				
			<a href="/login">Sign In </a>to view your saved screeners <br>
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
					<tr>
						<td style="vertical-align: middle;"> <a href="{{url('screeners/'.$screener->slug)}}"><strong>{{$screener->title}}</strong></a> </td>
						<td style="vertical-align: middle;">{{$screener->description}}</td>
						<td  style="text-align: center;"> <a href="/screeners/{{$screener->slug}}"> <strong> {{$screener->resultCount()}}</strong> <br> <small>Matches</small> </a></td>
						<td style="vertical-align: middle;">
							<ul class="social-icons social-icons-color">
								<li>
						 				<a data-original-title="facebook" class="facebook"></a> 
								</li>
							</ul>
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
					@foreach(\App\Screener::where('user_id', '')->get() as $screener)
					<tr>
						<td style="vertical-align: middle;"> <a href="{{url('screeners/'.$screener->slug)}}"><strong>{{$screener->title}}</strong></a> </td>
						<td style="vertical-align: middle;">{{$screener->description}}</td>
						<td style="text-align: center;"> <strong> 50+</strong> <br> <small>Matches</small></td>
						<td style="vertical-align: middle;"> <i class="fa fa-share-square-o"></i> </td>
					</tr>
					@endforeach
				</table>
		</div>
	</div>
</div>

@endsection