@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
@include('admin_courses.menu')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">Detail of batch:</span>
          </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          @include('admin_courses.message')
        </div>
        <div class="row">
          <div class="col-md-12 item" style="height:25px;">
          <a href="{{ route('participants_course.index') }}">Back</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 item">
            Course Name: {{$batches->course->course_name}}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 item">
            Venu Name: {{$batches->venue->venue_name}}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 item">
            Start Date: {{$batches->c_start_date}}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 item">
            End Date: {{$batches->c_end_date}}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 item">
            Class Time: {{$batches->c_start_time}} - {{$batches->c_end_time}}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover" id="table_filter">
                    <thead>
                      <th class="sorting" tabindex="1" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 290px;">
                        Participant Name
                      </th>
                      <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                        Email
                      </th>
                      <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                        Phone
                      </th>
                      <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                        Paid Status
                      </th>
                      <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                        Our Comments
                      </th>
                      <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                        Action
                      </th>
                    </thead>
                    <tbody id="">
                      @foreach($participants as $participant)
                      <tr>
                        <td>{{ $participant->p_name }}</td>
                        <td>{{ $participant->p_email }}</td>
                        <td>{{ $participant->p_phone }}</td>
                        <td>

                          @if(isset($participant->payment[0]))
                            @if($participant->payment[0]->payment_due == 0)
                              paid
                            @elseif($participant->payment[0]->payment_due > 0)
                              partialy paid
                            @endif
                          @else
                            {{ $participant->paid_status }}
                          @endif
                        </td>
                        <td>{{ $participant->our_comments }}</td>
                        <td>
                            <a href="{{ route('participants_course.edit', $participant->id) }}">Edit</a> / 
                            <a href="{{ route('participant_payment.index', $participant->id) }}">Payment</a> / 
                            <form action="{{ URL::route('participants_course.destroy',$participant->id )}}" method="POST">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <a class="trashButton" style="cursor: pointer;"> Delete <i class="fa fa-trash-o"></i></a>
                            </form>
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
@push('css')
<style>
  .item{
    margin-top:10px;
    margin-bottom: 10px;
    font-weight: bold;
  }
</style>
@endpush
@push('scripts')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    // CKEDITOR.replace( 'texarea' );
     //$('textarea').ckeditor();
     $('.datepicker').datepicker({
         format: 'yyyy-mm-dd'
     });
    $('.timepicker').datepicker({
       format: 'LT'
    });

    $('table').DataTable();

</script>

<script>
     $( document ).ready(function() {

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
      
       $('table').DataTable();

       $.ajaxSetup({

       });


    });
  </script>
@endpush
