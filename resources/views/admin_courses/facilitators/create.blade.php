@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
@include('admin_courses.menu')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">Create new facilitator:</span>
          </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          @include('admin_courses.message')
        </div>
        <div class="row">
          <div class="col-md-12">
            <form action="{{route('facilitators_course.store')}}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="faci_name">Facilitators Name:</label>
                <input type="text" class="form-control" id="faci_name" name="faci_name" value="{{ old('faci_name') }}">
              </div>
              <div class="form-group">
                <label for="faci_designation">Facilitator Designation:</label>
                <input type="text" class="form-control" id="faci_designation" name="faci_designation" value="{{ old('faci_designation') }}">
              </div>
              <div class="form-group">
                <label for="faci_profile">Facilitator Profile:</label>
                <textarea class="form-control" id="faci_profile" name="faci_profile">{{ old('faci_profile') }}</textarea>
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
  <script>
      CKEDITOR.replace( 'faci_profile' );
  </script>
@endpush
