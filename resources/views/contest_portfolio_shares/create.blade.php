@extends('layouts.metronic.default')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-badge font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> Buy Item</span>
                </div>
            </div>

            <div class="portlet-body form">
                <form role="form" class="form-horizontal" method="GET" action="{{ url('/portfolios/shares/create') }}">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="single-append-text" class="col-md-2 control-label">Select2 append</label>
                            <div class="col-md-10">
                                <div class="input-group select2-bootstrap-append">
                                    <select id="single-append-text" class="form-control select2-allow-clear" name="company">
                                        @foreach ($instruments as $id => $company)
                                            <option value="{{ $id }}">{{ $company }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                                </div>
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
