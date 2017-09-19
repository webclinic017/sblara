@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
@include('admin_courses.menu')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">Create new batch:</span>
          </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          @include('admin_courses.message')
        </div>
        <div class="row">
          <div class="col-md-12">
            <form action="{{route('manage_course.store')}}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="course_id">Course Category:</label>
                <select id="course_id" name="course_id" class="bs-select form-control select-filter" data-live-search="true">
          				@foreach($courses as $course)
          					<option value="{{$course->id}}" @if (old('course_id') == $course->id) selected="selected" @endif>{{$course->course_name}}</option>
          				@endforeach
          			</select>
              </div>

              <div class="form-group">
                <label for="course_venue_id">Venue:</label>
                <select id="course_venue_id" name="course_venue_id" class="bs-select form-control select-filter" data-live-search="true">
          				@foreach($venues as $venue)
          					<option value="{{$venue->venue_id}}" @if (old('course_venue_id') == $venue->venue_id) selected="selected" @endif>{{$venue->venue_name}}</option>
          				@endforeach
          			</select>
              </div>
              <div class="form-group">
                <label for="course_facilitator_id">Facilitator:</label>
                <select id="course_facilitator_id" name="course_facilitator_id" class="bs-select form-control select-filter" data-live-search="true">
          				@foreach($facilitators as $facilitator)
          					<option value="{{$facilitator->id}}" @if (old('course_facilitator_id') == $facilitator->id) selected="selected" @endif>{{$facilitator->faci_name}}</option>
          				@endforeach
          			</select>
              </div>
              <div class="form-group">
                <label for="batch_name">Batch:</label>
                <select id="batch_name" name="batch_name" class="bs-select form-control select-filter" data-live-search="true">
          				@foreach($batches as $batch)
          					<option value="{{$batch}}" @if (old('batch_name') == $batch) selected="selected" @endif>{{$batch}}</option>
          				@endforeach
          			</select>
              </div>
              <!--  -->
              <div class="form-group">
                <label for="c_start_date">Start Date:</label>
                <input data-provide="datepicker" class="form-control datepicker" id="c_start_date" name="c_start_date" value="{{ old('c_start_date') }}">
              </div>
              <div class="form-group">
                <label for="c_end_date">End Date:</label>
                <input data-provide="datepicker" class="form-control datepicker" id="c_end_date" name="c_end_date" value="{{ old('c_end_date') }}">
              </div>
              <div class="form-group">
                <label for="course_days_oftheweek">Course Days of the Week i.e Friday:</label>
                <input class="form-control" id="course_days_oftheweek" name="course_days_oftheweek" value="{{ old('course_days_oftheweek') }}">
              </div>
              <div class="form-group">
                <label for="c_reg_last_date">Last Date of Registration:</label>
                <input data-provide="datepicker" class="form-control datepicker" id="c_reg_last_date" name="c_reg_last_date" value="{{ old('c_reg_last_date') }}">
              </div>
              <div class="form-group">
                <label for="c_start_time">Start Time:</label>
                <input data-provide="timepicker" class="form-control" id="c_start_time" name="c_start_time" value="{{ old('c_start_time') }}">
              </div>

              <div class="form-group">
                <label for="c_end_time">End Time:</label>
                <input data-provide="timepicker" class="form-control" id="c_end_time" name="c_end_time" value="{{ old('c_end_time') }}">
              </div>
              <div class="form-group">
                <label for="course_duration">Course Duration i.e 8 Hours / Day Long:</label>
                <input class="form-control" id="course_duration" name="course_duration" value="{{ old('course_duration') }}">
              </div>
              <div class="form-group">
                <label for="course_fees">Course Fees i.e 2500:</label>
                <input type="text" class="form-control" id="course_fees" name="course_fees" value="{{ old('course_fees') }}">
              </div>

              <div class="form-group">
                <label for="course_discount">Course Discount i.e 25 / 30 (No % sign need):</label>
                <input type="text" class="form-control" id="course_discount" name="course_discount" value="{{ old('course_discount') }}">
              </div>
              <div class="form-group">
                <label for="course_vat">VAT Included:</label>
                <select id="course_vat" name="course_vat" class="bs-select form-control select-filter">
          					<option value="Yes" @if (old('course_vat') == 'Yes') selected="selected" @endif>Yes</option>
                    <option value="No" @if (old('course_vat') == 'No') selected="selected" @endif>No</option>
          			</select>
              </div>
              <div class="form-group">
                <label for="discounted_course_fees">Course Fees After Discount:</label>
                <input type="text" class="form-control" id="discounted_course_fees" name="discounted_course_fees" value="{{ old('discounted_course_fees') }}">
              </div>
              <div class="form-group">
                <label for="batch_status">Batch Status:</label>
                <select id="batch_status" name="batch_status" class="bs-select form-control select-filter">
          					<option value="upcoming" @if (old('batch_status') == 'upcoming') selected="selected" @endif>upcoming</option>
                    <option value="running" @if (old('batch_status') == 'running') selected="selected" @endif>running</option>
                    <option value="completed" @if (old('batch_status') == 'completed') selected="selected" @endif>completed</option>
                    <option value="suspended" @if (old('batch_status') == 'suspended') selected="selected" @endif>suspended</option>
          			</select>
              </div>
              <div class="form-group">
                <label for="certificate_status">Is Certificate?</label>
                <select id="certificate_status" name="certificate_status" class="bs-select form-control select-filter">
          					<option value="Yes" @if (old('certificate_status') == 'Yes') selected="selected" @endif>Yes</option>
                    <option value="No" @if (old('certificate_status') == 'No') selected="selected" @endif>No</option>
          			</select>
              </div>

              <button type="submit" class="btn btn-default">Add</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>



@endsection
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
