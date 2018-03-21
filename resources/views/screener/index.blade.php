@extends('layouts.metronic.default')

@php
$screenerImageUrl = url('/img/stockbangladesh-dse-screeners.jpg');
$title = "Advanced Screener for DSE";
$description = "Advanced screener for Dhaka stock exchange. Build your own screeners with our powerful filters";
$slug = "";


@endphp
@section('title', $title)
@section('meta-title', "Advance screeners of DSE- 
".$title)
@section('meta-description', $description)

@section('og:image', $screenerImageUrl)
@section('og:url', url('/screener/'.$slug))

@section('og:title', $title)
@section('og:description', $description)


@section('content')


@if(\Auth::guest())
<div class="row">
	<div class="col-md-12">
		<div class="m-heading-1 border-green m-bordered" style="text-align: center; padding:40px 0 40px 0">
				
			<a href="?login">Sign In </a>to view your saved screeners <br>
			OR <br>
			<a href="/screeners/new" class="btn green"><i class="fa fa-plus"></i> Build New Screener</a>
		</div>
	</div>
</div>
@else

<div class="row">
	<div class="col-md-12 ">
		<div class="m-heading-1 border-green m-bordered">
					
				<h2 style="float: left;">My Screeners</h2>  <a href="/screeners/new" style="float: right;" class="btn btn-success"><i class="fa fa-plus"></i> Build New Screener</a>
				<table class="table table-responsive table-hover">
					@foreach(\Auth::user()->screeners as $screener)
					<tr >
						<td style="vertical-align: middle; min-width: 150px"> <a href="{{url('screeners/'.$screener->slug)}}"><strong>{{$screener->title}}</strong></a> </td>
						<td style="vertical-align: middle;">{{$screener->description}}</td>
						<td  style="text-align: center;"> <a href="/screeners/{{$screener->slug}}"> <strong> {{$screener->resultCount()}}</strong> <br> <small>Matches</small> </a></td>
						<td style="vertical-align: middle;">
							
									<a style="text-decoration: none" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url('/screeners/'.$screener->slug)}}" class="socicon-btn socicon-btn-circle socicon-solid bg-blue font-white bg-hover-grey-salsa socicon-facebook tooltips" data-original-title="Share on Facebook"></a>
							
						</td>
						<td>
							<i class="btn btn-xs blue fa fa-pencil" data-toggle="modal" data-target="#editModal_{{$screener->id}}"></i>
							<i class="btn btn-xs red fa fa-trash" data-toggle="modal" data-target="#deleteModal_{{$screener->id}}"></i>

<!-- Modal -->
<div id="editModal_{{$screener->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form action="/screeners/{{$screener->id}}/update" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Screener</h4>
      </div>
      <div class="modal-body">
          <input type="hidden" id="query" name="query">
          {{csrf_field()}}
            <div class="form-group form-md-line-input">
                <label for="" class="label-control">Screener Name</label>
                <input class="form-control"  type="text" value="{{$screener->title}}" placeholder="Enter name here" name="title" required="">
                <div class="form-control-focus"> </div> 
            </div>

            <div class="form-group form-md-line-input">
                <label for="" class="label-control">Description</label>
                <textarea placeholder="Enter descripton here" class="form-control" name="description">{!!$screener->description!!}</textarea>
                <div class="form-control-focus"> </div> 
            </div>

          
      </div>
      <div class="modal-footer">
              <input class="btn btn-success" value="Update" type="submit">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="deleteModal_{{$screener->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form action="/screeners/{{$screener->id}}/update" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Screener</h4>
      </div>
      <div class="modal-body">
          {{csrf_field()}}
          <input type="hidden" value="yes" name="delete">
			<h3>Are you sure?</h3>
          
      </div>
      <div class="modal-footer">
              <input class="btn btn-success" value="Yes" type="submit">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
        </form>
    </div>

  </div>
</div>


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