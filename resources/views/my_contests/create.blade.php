@extends('layouts.metronic.default')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-badge font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> Create Contest</span>
                </div>
            </div>

            <div class="portlet-body form">
                <form role="form" class="form-horizontal" method="POST" action="{{ route('mycontests.store') }}">
                    {{ csrf_field() }}
                    <div class="form-body">
                        {{-- Todo: Contest Category? --}}

                        <div class="form-group form-md-line-input{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label" for="name">Contest Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Contest Name">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input{{ $errors->has('start_date') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label" for="start_date">Contest Start Date</label>
                            <div class="col-md-10">
                                <div class="input-group input-large date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                    <input type="text" class="form-control" name="start_date" value="{{ old('start_date') }}">
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

                        <div class="form-group form-md-line-input{{ $errors->has('end_date') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label" for="start_date">Contest End Date</label>
                            <div class="col-md-10">
                                <div class="input-group input-large date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                    <input type="text" class="form-control" name="end_date" value="{{ old('end_date') }}">
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

                        <div class="form-group form-md-line-input{{ $errors->has('access_level') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label" for="access_level">Access Level</label>
                            <div class="col-md-10">
                                <select class="btn-group bootstrap-select bs-select form-control" name="access_level">
                                    <option value="0">Public</option>
                                    <option value="1">Private</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input{{ $errors->has('contest_amount') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label" for="contest_amount">Contest Amount</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="contest_amount" name="contest_amount" value="{{ old('contest_amount') }}" placeholder="Enter Contest Amount">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input{{ $errors->has('max_amount') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label" for="max_amount">Max Amount (%)</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="max_amount" name="max_amount" value="{{ old('max_amount') }}" placeholder="Enter Max Amount">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input{{ $errors->has('max_member') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label" for="max_member">Max Member</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="max_member" name="max_member" value="{{ old('max_member') }}" placeholder="Enter Max Member">
                                <div class="form-control-focus"> </div>
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
