@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">List of Upcoming Courses:</span>
          </div>
      </div>
      <div class="portlet-body">

          <div class="row">
            @include('admin_courses.message')
          </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">{{$batch->batch_name}}</div>
              <div class="panel-body">

              </div>
              <div class="panel-footer">

                  <form action="{{ route('registration.store') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="course_batch_id" value="{{$batch->id}}" value="{{ old('course_batch_id') }}">
                    <div class="form-group">
                      <label for="p_name">Full Name:</label>
                      <input type="text" class="form-control" id="p_name" name="p_name" value="{{ old('p_name') }}">
                    </div>
                    <div class="form-group">
                      <label for="p_email">Email:</label>
                      <input type="text" class="form-control" id="p_email" name="p_email" value="{{ old('p_email') }}">
                    </div>
                    <div class="form-group">
                      <label for="p_phone">Contact No:</label>
                      <input type="text" class="form-control" id="p_phone" name="p_phone" value="{{ old('p_phone') }}">
                    </div>
                    <div class="form-group">
                      <label for="p_address">Address:</label>
                      <textarea class="form-control" id="p_address" name="p_address">{{ old('p_address') }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="p_profession">Profession:</label>
                      <input type="text" class="form-control" id="p_profession" name="p_profession" value="{{ old('p_profession') }}">
                    </div>
                    <div class="form-group">
                      <label for="p_organisation">Organization:</label>
                      <input type="text" class="form-control" id="p_organisation" name="p_organisation" value="{{ old('p_organisation') }}">
                    </div>
                    <div class="form-group">
                      <label for="p_designation">Designation:</label>
                      <input type="text" class="form-control" id="p_designation" name="p_designation" value="{{ old('p_designation') }}">
                    </div>
                    <div class="form-group">
                      <label for="where_heard">Where have you heard about us:</label>
                      <input type="text" class="form-control" id="where_heard" name="where_heard" value="{{ old('where_heard') }}">
                    </div>
                    <div class="form-group">
                      <label for="p_comments">Comment:</label>
                      <textarea class="form-control" id="p_comments" name="p_comments">{{ old('p_comments') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>



@endsection
@push('scripts')

  <script>
     $( document ).ready(function() {
       $.ajaxSetup({

       });

        lots_of_stuff_already_done = false;

        $('.trashButton').click(function(event){
          //.event.preventDefault();
          if (confirm("Do you want delete item?")) {
            var form = $(this).parents('form:first');
            form.submit();

          }
          else {

          }

    //     alert('sadf');
    //     // $.ajax({
    //     //     url: '/user/4',
    //     //     type: 'DELETE',  // user.destroy
    //     //     success: function(result) {
    //     //         // Do something with the result
    //     //     }
    //     // });
       });
    });
  </script>
@endpush
