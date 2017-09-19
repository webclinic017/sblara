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
            <form action="{{route('categories_course.store')}}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="category">New category:</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}">
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

  <script>

  </script>
@endpush
