@php
$max_shares = round($max_shares);
$max_shares = $max_shares > 0 ?$max_shares:'0';  
$purchase_power = $purchase_power > 0 ?$purchase_power:'0';                            
@endphp                                        
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
                                                                <th>Total Purchase Power:</th>
                                                                <th>{{ number_format($portfolio->cash_amount, 2) }}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Purchase Power (this item):</th>
                                                                <th>{{ $purchase_power }}</th>
                                                            </tr>
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
                                                                <th>Maximum Shares you can buy:</th>
                                                                <th>{{ $max_shares }}</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div class="portlet-title">
                                                    <div class="caption font-green-haze">
                                                        <i class="fa fa-money font-green-haze"></i>
                                                        <span class="caption-subject bold uppercase"> Market Price: 
                                                            <span class="text-danger">{{ $company_info->data_banks_intraday->close_price }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body form">
                                                    <form method="POST" action="{{ route('portfolios.shares.store', $portfolio) }}">
                                                        {{ csrf_field() }}
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="control-label" for="buy_quantity">Buy Quantity (Maximum No. of shares you can buy)</label>
                                                                <div class="col-md-12">      
                                                                    <div class="form-group">
                                                                        <div class="input-icon right">
                                                                            <input type="number" max="{{ $max_shares }}" name="buy_quantity" class="form-control" required=""> 
                                                                            <input type="hidden" class="form-control" name="instrument_id" value="{{ $company_info->id }}">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>