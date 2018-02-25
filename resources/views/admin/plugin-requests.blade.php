@extends('voyager::master')
@php
$users = \App\User::where('group_id',  0)->where('plugin_apply', '!=', 0)->get();
@endphp
@section('content')
<table class="table table-responsive">
	<tr>
		<th>Name</th>
		<th>Username</th>
		<th>Email</th>
		<th>Mobile</th>
		<th>Plan</th>
		<th>Action</th>
	</tr>
	@foreach($users as $user)
	<tr>
		<td>{{$user->name}}</td>
		<td>{{$user->username}}</td>
		<td>{{$user->email}}</td>
		<td>{{$user->contact_no}}</td>
		<td>
			@switch($user->plugin_apply)
			@case(1)
			Free
			@break
			@case(2)	
			Paid
			@break
			@case(3)
			Corporate
			@break
			@case(4)
			Course
			@break
			@endswitch
			<td>
				<button class="btn btn-success btn-sm approve">Approve</button>
			</td>
		</td>
	</tr>
	@endforeach
</table>
@endsection