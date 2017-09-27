@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
@include('admin_courses.menu')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">Participant List:</span>
          </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          @include('admin_courses.message')
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover" id="table_filter">
                    <thead>
                      <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 10px;">
                        #
                      </th>
                      <th class="sorting" tabindex="1" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 290px;">
                        Batch
                      </th>
                      <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                        Vanue
                      </th>
                      <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                        Start Date
                      </th>
                      <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                        Details
                      </th>
                    </thead>
                    <tbody id="">
                      @foreach($batches as $batch)
                        
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{isset($batch->course_name)?$batch->course_name:$batch->course_id}}- {{$batch->batch_name}} ( Participants: {{$batch->count}} , Paid: {{$batch->paid}} )</td>
                          <td>{{$batch->venue_name}}</td>
                          <td>{{$batch->c_start_date}}</td>
                          <td>
                            <a class="edithButton" href="{{ route('participants_course.show',$batch->id ) }}" style="cursor: pointer;"> detail <i class="fa fa-info"></i></a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
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

       $('table').DataTable();

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
