@extends('layouts.admin')
@section('custom')
<table class="table table-responsive table-hover">
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

<!-- Modal -->
<div id="{{$user->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form >
    	
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm Approval</h4>
      </div>
      <div class="modal-body">
		<input type="hidden" name="approve" value="{{$user->id}}">
		<div class="form-group">	
			<label for="">Expire Date</label>
				<input class="form-control" type="date" name="expired_at" @if($user->plugin_apply != '1') required @endif>
		</div>
      </div>
      <div class="modal-footer">
      	<button class="btn btn-success">Confirm</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
    </form>

  </div>
</div>		
				<button data-toggle="modal" data-target="#{{$user->id}}" class="btn btn-success btn-sm approve">Approve</button>
			</td>
		</td>
	</tr>
	@endforeach
</table>
@endsection