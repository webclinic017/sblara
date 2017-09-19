@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
@include('admin_courses.menu')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">Course Category List:</span>
          </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          @include('admin_courses.message')
        </div>
        <div class="row">
          <div class="col-md-12">
            <a href="{{route('categories_course.create')}}">Add Category</a>
            {{ csrf_field() }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover" id="table_filter">
                    <thead>
                      <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 10px;">
                        #
                      </th>
                      <th class="sorting" tabindex="1" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                        Category Name
                      </th>
                      <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 290px;">
                        Edit
                      </th>
                      <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 290px;">
                        Remove
                      </th>
                    </thead>
                    <tbody id="">
                      @foreach($course_categories as $category)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$category->course_cat}}</td>
                          <td>
                            <a class="edithButton" href="{{ route('categories_course.edit',$category->id ) }}" style="cursor: pointer;"> edit <i class="fa fa-pencil"></i></a>
                          </td>
                          <td>
                            <form action="{{ URL::route('categories_course.destroy',$category->id )}}" method="POST">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <a class="trashButton" style="cursor: pointer;"> delete <i class="fa fa-trash-o"></i></a>
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
