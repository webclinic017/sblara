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
            @foreach($batches as $batch)
            <div class="panel panel-default">
              <div class="panel-heading">{{$batch->batch_name}}</div>
              <div class="panel-body">
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover" id="table_filter">
                        <thead>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 290px;">
                            Course Name
                          </th>
                          <th class="sorting" tabindex="1" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                            Duration
                          </th>
                          <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                            Start Date
                          </th>
                          <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                            Class Time
                          </th>
                          <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                            Fees
                          </th>
                        </thead>
                        <tbody id="">
                            <tr>
                              <td>{{isset($batch->course->course_name)?$batch->course->course_name:$batch->course_id}}</td>
                              <td>{{$batch->course_duration}}</td>
                              <td>{{$batch->c_start_date}}</td>
                              <td>{{$batch->c_start_time}} - {{$batch->c_end_time}}</td>
                              <td>{{$batch->course_fees}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-md-2">
                    <a href="{{ route('registration.create', $batch->id) }}" class="btn btn-default">Register Online</a>
                  </div>
                  <div class="col-md-2 col-md-offset-3">
                    <a href="" class="btn btn-default">Certificate will be awarded</a>
                  </div>
                  <div class="col-md-2 col-md-offset-3">
                    <a href="" class="btn btn-default">More detail</a>
                  </div>
                </div>
              </div>
            </div>

            @endforeach
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
