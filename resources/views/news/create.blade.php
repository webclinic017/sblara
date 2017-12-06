@extends('layouts.metronic.default')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-badge font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> Add News</span>
                </div>
            </div>

            <div class="portlet-body form">
                <form role="form" class="form-horizontal" method="POST" action="{{ route('mycontests.store') }}">
                    {{ csrf_field() }}
                    <div class="form-body">
                        {{-- Todo: Contest Category? --}}

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="name">Title</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter News Title">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>                      
                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="name">News Details</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="name" name="news_details" placeholder="Enter News Title">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="start_date">Published Date</label>
                            <div class="col-md-10">
                                <div class="input-group input-large date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                    <input type="text" class="form-control" name="published_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                                <span class="help-block"> Select date </span>
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" class="btn blue">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
