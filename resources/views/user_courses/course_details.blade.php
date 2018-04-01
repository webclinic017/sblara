@section('structured_data')
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Course",
  "name": "{ ! $course_details->course_name ! }",
  "description": "{{strip_tags(str_limit($course_details->course_overview,200))}} ",
  "provider": {
    "@type": "Organization",
    "name": "Stock Bangladesh Limited",
  }
}
</script>
@endsection


@section('meta-title',$course_details->course_heading)
@section('meta-description', strip_tags(substr($course_details->course_overview,0,160)))
@extends('layouts.metronic.default')
@section('page_heading')
{{$course_details->course_name}}
@endsection
@section('content')


    <div class="row">
        <div class="col-md-6">
        <a href="{{url('/courses/upcoming-courses')}}" class="btn green default btn-block"> Check course schedule </a>
        </div>
        <div class="col-md-6">
        <a href="{{url('/courses/technical-analysis')}}" class="btn red default btn-block"> Technical Course Dashboard </a>
        </div>
    </div>

<div class="row">

    <div class="col-md-12">

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                Who Should Attend </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
    {!! $course_details->who_should_attend !!}
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                Course Overview </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
    {!! $course_details->course_overview !!}
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                Objectives of Course </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
    {!! $course_details->objectives_of_course !!}
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                We Know What You Need To Know </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
    {!! $course_details->course_benefit  !!}
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                 	Course curriculum  </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
    {!! $course_details->course_details   !!}
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>






    </div>
</div>



@endsection
