@extends('layouts.metronic.default')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-badge font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> Search Company</span>
                </div>
            </div>

            <div class="portlet-body form">
                <form role="form" class="form-horizontal" method="GET" action="{{ url('/portfolios/shares/create') }}">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="single-append-text" class="col-md-2 control-label">Select Company</label>
                            <div class="col-md-10">
                                <div class="input-group select2-bootstrap-append">
                                    <select id="single-append-text" class="form-control select2-allow-clear" name="company_info">
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
                                <button type="submit" class="btn blue">Company Info</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (isset($company_info))
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="icon-badge font-green-haze"></i>
                        <span class="caption-subject bold uppercase"> Buy {{ $company_info->instrument->instrument_code }}</span>
                    </div>
                </div>

                <div class="portlet-body form">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Total Purchase Power:</th>
                                <th></th>
                            </tr>

                            <tr>
                                <th>Purchase Power (this item):</th>
                                <th></th>
                            </tr>

                            <tr>
                                <th>Category:</th>
                                <th></th>
                            </tr>

                            <tr>
                                <th>Last Trade Price:</th>
                                <th>{{ $company_info->close_price }} </th>
                            </tr>

                            <tr>
                                <th>Market Lot:</th>
                                <th></th>
                            </tr>

                            <tr>
                                <th>Maximum Shares you can buy:</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
