@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
@include('admin_courses.menu')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">Edit category:</span>
          </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          @include('admin_courses.message')
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
                        <td>{{ $participant->paid_status }}</td>
                        <td>{{ $participant->our_comments }}</td>
                        <td>Action</td>
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

</script>
@endpush
