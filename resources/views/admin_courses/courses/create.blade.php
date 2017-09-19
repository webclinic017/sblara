@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
@include('admin_courses.menu')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">Create new category:</span>
          </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          @include('admin_courses.message')
        </div>
        <div class="row">
          <div class="col-md-12">
            <form action="{{route('courses.store')}}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="category">Course Category:</label>
                <select id="course_category_id" name="course_category_id" class="bs-select form-control select-filter" data-live-search="true">
          				@foreach($categories as $category)
          					<option value="{{$category->id}}" @if (old('course_category_id') == $category->id) selected="selected" @endif>{{$category->course_cat}}</option>
          				@endforeach
          			</select>
              </div>
              <div class="form-group">
                <label for="course_name">Course Name:</label>
                <input type="text" class="form-control" id="course_name" name="course_name" value="{{ old('course_name') }}">
              </div>
              <div class="form-group">
                <label for="course_heading">Course Heading:</label>
                <input type="text" class="form-control" id="course_heading" name="course_heading" value="{{ old('course_heading') }}">
              </div>
              <div class="form-group">
                <label for="who_should_attend_title">Alternate Title for "Who Should Attend":</label>
                <input type="text" class="form-control" id="who_should_attend_title" name="who_should_attend_title" value="{{ old('who_should_attend_title') }}">
              </div>
              <div class="form-group">
                <label for="who_should_attend">Who Should Attend:</label>
                <textarea class="form-control" id="who_should_attend" name="who_should_attend">{{ old('who_should_attend') }}</textarea>
              </div>
              <!--  -->
              <div class="form-group">
                <label for="special_notes_title">Alternate Title for "Special Notes":</label>
                <input type="text" class="form-control" id="special_notes_title" name="special_notes_title" value="{{ old('special_notes_title') }}">
              </div>
              <div class="form-group">
                <label for="special_notes">Special Notes:</label>
                <textarea class="form-control" id="special_notes" name="special_notes">{{ old('special_notes') }}</textarea>
              </div>
              <div class="form-group">
                <label for="course_overview_title">Alternate Title for "Course Overview":</label>
                <input type="text" class="form-control" id="course_overview_title" name="course_overview_title" value="{{ old('course_overview_title') }}">
              </div>
              <div class="form-group">
                <label for="course_overview">Course Overview:</label>
                <textarea class="form-control" id="course_overview" name="course_overview">{{ old('course_overview') }}</textarea>
              </div>

              <div class="form-group">
                <label for="objectives_of_course_title">Alternate Title for "Objectives of Course":</label>
                <input type="text" class="form-control" id="objectives_of_course_title" name="objectives_of_course_title" value="{{ old('objectives_of_course_title') }}">
              </div>
              <div class="form-group">
                <label for="objectives_of_course">Objectives of Course:</label>
                <textarea class="form-control" id="objectives_of_course" name="objectives_of_course">{{ old('objectives_of_course') }}</textarea>
              </div>
              <div class="form-group">
                <label for="course_benefit_title">Alternate Title for "Course Benefit":</label>
                <input type="text" class="form-control" id="course_benefit_title" name="course_benefit_title"value="{{ old('course_benefit_title') }}">
              </div>
              <div class="form-group">
                <label for="course_benefit">Course Benefit:</label>
                <textarea class="form-control" id="course_benefitcourse_benefit" name="course_benefit">{{ old('course_benefit') }}</textarea>
              </div>
              <div class="form-group">
                <label for="why_sb_title">Alternate Title for "Why StockBangladesh Ltd":</label>
                <input type="text" class="form-control" id="why_sb_title" name="why_sb_title" value="{{ old('why_sb_title') }}">
              </div>
              <div class="form-group">
                <label for="why_sb">Why StockBangladesh Ltd:</label>
                <textarea class="form-control" id="why_sb" name="why_sb">{{ old('why_sb') }}</textarea>
              </div>
              <div class="form-group">
                <label for="course_details_title">Alternate Title for "Course Details":</label>
                <input type="text" class="form-control" id="course_details_title" name="course_details_title" value="{{ old('course_details_title') }}">
              </div>
              <div class="form-group">
                <label for="course_details">Course Details:</label>
                <textarea class="form-control" id="course_details" name="course_details">{{ old('course_details') }}</textarea>
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
       $('textarea').ckeditor();
  </script>
@endpush
