@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
@include('admin_courses.menu')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">Edit participant:</span>
          </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          @include('admin_courses.message')
        </div>
        <div class="row">
          <div class="col-md-12" style="height:25px;">
          <a href="{{ route('participants_course.show', $participant->course_batch_id) }}">Back</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form action="{{route('participants_course.update', $participant->id )}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label for="p_name">Name:</label>
                <input type="text" class="form-control" id="p_name" name="p_name" value="{{ $participant->p_name }}">
              </div>
              <div class="form-group">
                <label for="p_identification_no">Participant Identification No. i.e: 04-005-01:</label>
                <input type="text" class="form-control" id="p_identification_no" name="p_identification_no" value="{{ $participant->p_identification_no }}">
              </div>

              <div class="form-group">
                <label for="p_email">Email:</label>
                <input type="text" class="form-control" id="p_email" name="p_email" value="{{ $participant->p_email }}">
              </div>
              <div class="form-group">
                <label for="p_phone">Phone:</label>
                <input type="text" class="form-control" id="p_phone" name="p_phone" value="{{ $participant->p_phone }}">
              </div>

              <div class="form-group">
                <label for="p_profession">Profession:</label>
                <input type="text" class="form-control" id="p_profession" name="p_profession" value="{{ $participant->p_profession }}">
              </div>
              <div class="form-group">
                <label for="p_organisation">Organisation:</label>
                <input type="text" class="form-control" id="p_organisation" name="p_organisation" value="{{ $participant->p_organisation }}">
              </div>


              <div class="form-group">
                <label for="p_designation">Designation:</label>
                <input type="text" class="form-control" id="p_designation" name="p_designation" value="{{ $participant->p_designation }}">
              </div>
              <div class="form-group">
                <label for="p_address">Address:</label>
                <textarea class="form-control" id="p_address" name="p_address">{{ $participant->p_address }}</textarea>
              </div>

              <div class="form-group">
                <label for="p_comments">Participant Comments:</label>
                <textarea class="form-control" id="p_comments" name="p_comments">{{ $participant->p_comments }}</textarea>
              </div>
              <div class="form-group">
                <label for="our_comments">Our Comments:</label>
                <textarea class="form-control" id="our_comments" name="our_comments">{{ $participant->our_comments }}</textarea>
              </div>

              <div class="form-group">
                <label for="p_certificate_status">Certificate Status:</label>
                <select id="p_certificate_status" name="p_certificate_status" class="bs-select form-control select-filter" data-live-search="true">
                  @foreach($certificate_status as $status)
                    <<option value="{{ $status }}"
                    @IF ($status==$participant->p_certificate_status)
                      selected
                    @ENDIF>{{ $status }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="batch_want">Batch Transfer:</label>
                <select id="batch_want" name="batch_want" class="bs-select form-control select-filter" data-live-search="true">
                  @foreach($batch_want as $want)
                    <<option value="{{ $want }}"
                    @IF ($want==$participant->batch_want)
                      selected
                    @ENDIF
                    >{{ $want }}</option>
                  @endforeach
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
  <script>
      CKEDITOR.replace( 'faci_profile' );
  </script>
@endpush
