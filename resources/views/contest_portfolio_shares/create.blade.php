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
                <form role="form" class="form-horizontal" method="GET" action="{{ route('portfolios.shares.create', $portfolio) }}">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="single-append-text" class="col-md-2 control-label">Select Company</label>
                            <div class="col-md-10">
                                <div class="input-group select2-bootstrap-append">
                                    <select id="single-append-text" class="form-control basic-single-select2" name="company_info">
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
                        <span class="caption-subject bold uppercase"> Buy {{ $company_info->instrument_code }}</span>
                    </div>
                </div>

                <div class="portlet-body form">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Total Purchase Power:</th>
                                <th>{{ $portfolio->cash_amount }}</th>
                            </tr>

                            <tr>
                                <th>Purchase Power (this item):</th>
                                <th>{{ $purchase_power }}</th>
                            </tr>

                            <tr>
                                <th>Category:</th>
                                <th>
                                    {{-- @php
                                        $cat = explode('-', $company_info->data_banks_intraday->quote_bases);
                                    @endphp
                                    {{ $cat[0] }} --}}
                                    {{ $company_info->data_banks_intraday->quote_bases[0] }}
                                </th>
                            </tr>

                            <tr>
                                <th>Last Trade Price:</th>
                                <th>{{ $company_info->data_banks_intraday->close_price }}</th>
                            </tr>

                            <tr>
                                <th>Maximum Shares you can buy:</th>
                                <th>{{ $max_shares }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="icon-badge font-green-haze"></i>
                        <span class="caption-subject bold uppercase"> Market Price: 
                            <span class="text-danger">{{ $company_info->data_banks_intraday->close_price }}</span>
                        </span>
                    </div>
                </div>

                <div class="portlet-body form">
                    <form method="POST" action="{{ route('portfolios.shares.store', $portfolio) }}">
                        {{ csrf_field() }}
                        
                        <input type="hidden" class="form-control" name="instrument_id" value="{{ $company_info->id }}">

                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <div class="input-group-control">
                                    <input type="text" class="form-control" name="buy_quantity">
                                    <label for="buy_quantity">Buy Quantity (maximum no. of shares you can buy)</label>
                                </div>
                                <span class="input-group-btn btn-right">
                                    <button type="submit" class="btn blue">Confirm</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
      $(".basic-single-select2").select2({
        placeholder: "Select a company",
        allowClear: true
      });
    });
</script>
@endsection
