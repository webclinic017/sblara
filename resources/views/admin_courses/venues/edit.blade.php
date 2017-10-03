@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
@include('admin_courses.menu')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">Edit venue:</span>
          </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          @include('admin_courses.message')
        </div>
        <div class="row">
          <div class="col-md-12">
            <form action="{{route('venues_course.update', $venues->venue_id )}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label for="venue_name">Venu Name:</label>
                <input type="text" class="form-control" id="venue_name" name="venue_name" value="{{ $venues->venue_name }}">
              </div>
              <div class="form-group">
                <label for="venue_phone">Venu Phone:</label>
                <input type="text" class="form-control" id="venue_phone" name="venue_phone" value="{{ $venues->venue_phone }}">
              </div>
              <div class="form-group">
                <label for="venue_mobile">Venu Mobile:</label>
                <input type="text" class="form-control" id="venue_mobile" name="venue_mobile" value="{{ $venues->venue_mobile }}">
              </div>
              <div class="form-group">
                <label for="venue_email">Venu Email:</label>
                <input type="text" class="form-control" id="venue_email" name="venue_email" value="{{ $venues->venue_email }}">
              </div>
              <div class="form-group">
                <label for="venue_address">Venu Address:</label>
                <textarea class="form-control" id="venue_address" name="venue_address">{{ $venues->venue_address }}</textarea>
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

  <script>

  </script>
@endpush
