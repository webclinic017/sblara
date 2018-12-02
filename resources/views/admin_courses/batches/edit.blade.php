@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
@include('admin_courses.menu')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">Edit Batch:</span>
          </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          @include('admin_courses.message')
        </div>
        <div class="row">
          <div class="col-md-12">
            <form action="{{route('batches.update', $course_batch->id )}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label for="course_id">Course Category:</label>
                <select id="course_id" name="course_id" class="bs-select form-control select-filter" data-live-search="true">
          				@foreach($courses as $course)
          					<option value="{{$course->id}}"
                      @if ($course->id==$course_batch->course_id)
                        selected
                      @endif>{{$course->course_name}}</option>
          				@endforeach
          			</select>
              </div>
              <div class="form-group">
                <label for="course_venue_id">Venue:</label>
                {{-- {!!dump($venues)!!} --}}
                <select id="course_venue_id" name="course_venue_id" class="bs-select form-control select-filter" data-live-search="true">
          				@foreach($venues as $venue)
          					<option value="{{$venue->venue_id}}"
                      @if ($venue->venue_id==$course_batch->course_venue_id)
                        selected
                      @endif>{{$venue->venue_name}}</option>
          				@endforeach
          			</select>
              </div>
              <div class="form-group">
                <label for="course_facilitator_id">Facilitator:</label>
                <select id="course_facilitator_id" name="course_facilitator_id" class="bs-select form-control select-filter" data-live-search="true">
          				@foreach($facilitators as $facilitator)
          					<option value="{{$facilitator->id}}"
                      @if ($facilitator->id==$course_batch->course_facilitator_id)
                        selected
                      @endif
                      >{{$facilitator->faci_name}}</option>
          				@endforeach
          			</select>
              </div>
              <div class="form-group">
                <label for="batch_name">Batch:</label>
                <select id="batch_name" name="batch_name" class="bs-select form-control select-filter" data-live-search="true">
          				@foreach($batches as $batch)
          					<option value="{{$batch->batch_name}}"
                    @if ($batch->batch_name==$course_batch->batch_name)
                      selected
                    @endif
                    >{{$batch->batch_name}}</option>
          				@endforeach
          			</select>
              </div>
              <!--  -->
              <div class="form-group">
                <label for="c_start_date">Start Date:</label>
                <input data-provide="datepicker" class="form-control datepicker" id="c_start_date" name="c_start_date" value="{{$course_batch->c_start_date}}">
              </div>
              <div class="form-group">
                <label for="c_end_date">End Date:</label>
                <input data-provide="datepicker" class="form-control datepicker" id="c_end_date" name="c_end_date" value="{{$course_batch->c_end_date}}">
              </div>
              <div class="form-group">
                <label for="course_days_oftheweek">Course Days of the Week i.e Friday:</label>
                <input class="form-control" id="course_days_oftheweek" name="course_days_oftheweek" value="{{$course_batch->course_days_oftheweek}}">
              </div>
              <div class="form-group">
                <label for="c_reg_last_date">Last Date of Registration:</label>
                <input data-provide="datepicker" class="form-control datepicker" id="c_reg_last_date" name="c_reg_last_date" value="{{$course_batch->c_start_date}}">
              </div>
              <div class="form-group">
                <label for="c_start_time">Start Time:</label>
                <input data-provide="timepicker" class="form-control" id="c_start_time" name="c_start_time" value="{{$course_batch->c_start_time}}">
              </div>

              <div class="form-group">
                <label for="c_end_time">End Time:</label>
                <input data-provide="timepicker" class="form-control" id="c_end_time" name="c_end_time" value="{{$course_batch->c_end_time}}">
              </div>
              <div class="form-group">
                <label for="course_duration">Course Duration i.e 8 Hours / Day Long:</label>
                <input class="form-control" id="course_duration" name="course_duration" value="{{$course_batch->course_duration}}">
              </div>
              <div class="form-group">
                <label for="course_fees">Course Fees i.e 2500:</label>
                <input type="text" class="form-control" id="course_fees" name="course_fees" value="{{$course_batch->course_fees}}">
              </div>

              <div class="form-group">
                <label for="course_discount">Course Discount i.e 25 / 30 (No % sign need):</label>
                <input type="text" class="form-control" id="course_discount" name="course_discount" value="{{$course_batch->course_discount}}">
              </div>
              <div class="form-group">
                <label for="course_vat">VAT Included:</label>
                <select id="course_vat" name="course_vat" class="bs-select form-control select-filter">
                  <option value="Yes"
                  @if ($course_batch->course_vat=="Yes")
                    selected
                  @endif>Yes</option>
                  <option value="No"
                  @if ($course_batch->course_vat=="No")
                    selected
                  @endif>No</option>
          			</select>
              </div>

              <div class="form-group">
                <label for="discounted_course_fees">Course Fees After Discount:</label>
                <input type="text" class="form-control" id="discounted_course_fees" name="discounted_course_fees" value="{{$course_batch->discounted_course_fees}}">
              </div>
              <div class="form-group">
                <label for="batch_status">Batch Status:</label>
                <select id="batch_status" name="batch_status" class="bs-select form-control select-filter">
              		<option value="upcoming"
                    @if ("upcoming"==$course_batch->batch_status)
                      selected
                    @endif>upcoming</option>
                  <option value="running"
                    @if ("running"==$course_batch->batch_status)
                      selected
                    @endif
                  >running</option>
                  <option value="completed"
                    @if ("completed"==$course_batch->batch_status)
                      selected
                    @endif
                  >completed</option>
                  <option value="suspended"
                    @if ("suspended"==$course_batch->batch_status)
                      selected
                    @endif
                  >suspended</option>
                </select>
              </div>
              <div class="form-group">
                <label for="certificate_status">Is Certificate?</label>
                <select id="certificate_status" name="certificate_status" class="bs-select form-control select-filter">
              		<option value="Yes"
                    @if ("Yes"==$course_batch->certificate_status)
                      selected
                    @endif
                  >Yes</option>
                  <option value="No"
                    @if ("No"==$course_batch->certificate_status)
                      selected
                    @endif
                    >No</option>
                  </select>
                </div>
              <button type="submit" class="btn btn-default">Update</button>
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
