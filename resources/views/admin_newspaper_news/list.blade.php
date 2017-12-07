@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('page_heading')
News List:
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <!--      <div class="portlet-title">
                      <div class="caption">
                        <span class="caption-subject font-green sbold uppercase">Courses List:</span>
                      </div>
                  </div>-->
            <div class="portlet-body">
                <div class="row">
                    @include('admin_newspaper_news.message')
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('news.create')}}">Add News</a>
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
                                <th class="sorting" tabindex="1" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 200px;">
                                    Title
                                </th>
                                <th class="sorting" tabindex="1" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 200px;">
                                    News Details
                                </th>
                                <th class="sorting" tabindex="1" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 200px;">
                                    Published Date
                                </th>
                                <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 90px;">
                                    Edit
                                </th>
                                <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 90px;">
                                    Remove
                                </th>
                                </thead>
                                <tbody id="">
                                    @foreach($news as $news)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $news->title }}</td>
                                        <td>{!! $news->details !!}</td>
                                        <td>{{ $news->published_date }}</td>
                                        <td>
                                            <a class="edithButton" href="{{ route('news.edit',$news->id ) }}" style="cursor: pointer;"> edit <i class="fa fa-pencil"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{ URL::route('news.destroy',$news->id )}}" method="POST">
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
@push('scripts')
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
