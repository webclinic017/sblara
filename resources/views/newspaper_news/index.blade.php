@section('meta-title', 'Important Share Market News Curated From Various Sources Of Bangladesh')
@section('meta-description', 'Regularly updated news from various newspaper related to stock exchange of Bangladesh')
@extends('layouts.metronic.default')
@section('content')


<div class="portlet light bordered" id="blockui_sample_1_portlet_body">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-bubble font-green-sharp"></i>
            <span class="caption-subject font-green-sharp sbold">News Details</span>
        </div>
    </div>
    @foreach($news as $news)
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-newspaper-o"></i>{{ $news->title }}
            </div>
            <div class="actions">
                <div class="btn-group">
                    <a class="btn btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> {{ $news->published_date }}
                    </a>
                </div>
            </div>
        </div>
        <div class="portlet-body flip-scroll">

            <div class="row">
                <div class="col-md-12">
                    <p>{!! $news->details !!}</p>
                </div>
            </div>

        </div>
    </div>
    @endforeach
</div>


@endsection
@section('js')

@endsection