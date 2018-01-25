@extends('voyager::master')
@section('content')
@php 
$bugs = App\Bug::paginate(10);
@endphp

{{-- {{dump($data)}} --}}
<table class="table table-bordered">
@foreach($bugs as $bug)
@php $data = (json_decode($bug->content)); @endphp
	<tr>
		<td >{{$data->url}}</td>
		<td>{{$data->note}}</td>
	</tr>
@endforeach
</table>
{{$bugs->links()}}
@endsection