@section('meta-title', 'Upcoming Technical Analysis and Fundamental Analysis Courses')
@section('meta-description', 'Profitable Technical Analysis Masterclass - Your Critical Foundation to Trading Stocks In Bangladesh')

@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->
@section('page_heading')
List of Upcoming Courses:
@endsection

@section('content')
<!--<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">-->
            <div class="portlet-body">
                <div class="row">
                    @include('admin_courses.message')
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @foreach($batches as $batch)

                        @section('structured_data')

                        <script type="application/ld+json">
                        {
                          "@context": "http://schema.org",
                          "@type": "Event",
                          "name": "{{isset($batch->course_name)?$batch->course_name:$batch->course_id}} - {{$batch->batch_name}}",
                          "startDate": "{{date('Y-m-d',strtotime($batch->c_start_date))}}T15:00-18:00",
                          "location": {
                            "@type": "Place",
                            "name": "Head Office, Stock Bangladesh Ltd",
                            "address": {
                              "@type": "PostalAddress",
                              "streetAddress": "99 Kazi Nazrul Islam Avenue",
                              "addressLocality": "Kawran Bazar",
                              "postalCode": "1215",
                              "addressRegion": "Dhaka",
                              "addressCountry": "BD"
                            }
                          },
                          "image": [
                            "https://stockbangladesh.com/img/technical-analysis-01-300x300.jpg"
                           ],
                          "description": "Join us for an afternoon of Technical Analysis session. Complimentary tea break will be served.",
                          "endDate": "{{date('Y-m-d',strtotime($batch->c_end_time))}}T15:00-18:00",
                          "offers": {
                            "@type": "Offer",
                            "url": "https://stockbangladesh.com/courses/technical-analysis",
                            "price": "{{$batch->course_fees}}",
                            "priceCurrency": "BDT",
                            "availability": "http://schema.org/InStock",
                            "validFrom": "{{date('Y-m-d',strtotime($batch->c_start_date))}}T15:00-18:00"
                          },
                          "performer": {
                            "@type": "PerformingGroup",
                            "name": "R&D Department of StockBangladesh"
                          }
                        }
                        </script>

                        @endsection


                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs"></i><a href="{{url('/courses/upcoming-courses/batches/'.$batch->id)}}">{{isset($batch->course_name)?$batch->course_name:$batch->course_id}} - {{$batch->batch_name}}</a></div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
<!--                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="remove" data-original-title="" title=""> </a>-->
                                </div>
                            </div>
                            <div class="portlet-body flip-scroll">
                                <table class="table table-bordered table-striped table-condensed flip-content">
                                    <thead class="flip-content">
                                        <tr>
                                            <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 290px;">
                                                Course Name
                                            </th>
                                            <th class="sorting" tabindex="1" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                                                Duration
                                            </th>
                                            <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                                                Start Date
                                            </th>
                                            <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                                                Class Time
                                            </th>
                                            <th class="sorting" tabindex="2" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 100px;">
                                                Fees
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{isset($batch->course_name)?$batch->course_name:$batch->course_id}}</td>
                                            <td>{{$batch->course_duration}}</td>
                                            <td>{{$batch->c_start_date}}</td>
                                            <td>{{$batch->c_start_time}} - {{$batch->c_end_time}}</td>
                                            <td>{{$batch->course_fees}}</td>
                                        </tr>                
                                    </tbody>
                                </table>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a href="{{ route('registration.create', $batch->id) }}" class="btn btn-default">Register Online</a>
                                        </div>
                                        <div class="col-md-2 col-md-offset-3">
                                            <a href="" class="btn btn-default">Certificate will be awarded</a>
                                        </div>
                                        <div class="col-md-2 col-md-offset-3">
                                            <a href="{{url('/courses/upcoming-courses/batches/'.$batch->id)}}" class="btn btn-default">More detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
<!--        </div>
    </div>
</div>-->



@endsection
@push('scripts')

<script>
    $(document).ready(function () {
        $.ajaxSetup({

        });

        lots_of_stuff_already_done = false;

        $('.trashButton').click(function (event) {
            //.event.preventDefault();
            if (confirm("Do you want delete item?")) {
                var form = $(this).parents('form:first');
                form.submit();

            } else {

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
