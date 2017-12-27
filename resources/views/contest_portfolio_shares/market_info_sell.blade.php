<div class="col-md-12">
            <div class="portlet-body form">
                <div class="portlet-title center">
                    <div class="caption font-green-haze">
                        <span class="caption-subject bold uppercase">{{ $company_info->instrument_code }}</span>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category:</th>
                            <th>

                                {{ $company_info->data_banks_intraday->quote_bases[0] }}
                            </th>
                        </tr>
                        <tr>
                            <th>Last Trade Price:</th>
                            <th>{{ $company_info->data_banks_intraday->close_price }}</th>
                        </tr>

                        <tr>
                            <th>Quantity:</th>
                            <th>{{ $saleableQty }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="fa fa-money font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> Sell Price: 
                        <span class="text-danger">{{ $company_info->data_banks_intraday->close_price }}</span>
                    </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="sellForm" method="POST" action="{{ route('portfolios.shares.store', $portfolio) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="type" value="sell">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label" for="buy_quantity">Sell Quantity:</label>      
                            <div class="form-group">
                                <div class="input-icon right">
                                    <input type="number" max="{{ $saleableQty }}" name="buy_quantity" value="{{ $saleableQty }}" class="form-control"> 
                                    <input type="hidden" class="form-control" name="instrument_id" value="{{ $company_info->id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>