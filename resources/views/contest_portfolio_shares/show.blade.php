@extends('layouts.metronic.default')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-badge font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> 
                        <a href="">
                            <span class="text-primary"></span>
                        </a>
                        Portfolio
                    </span><br><br>
                    <a href="{{ route('portfolios.shares.create', $portfolio) }}">Buy Share</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Trigger the modal with a button -->
                    <div class="from action pull-right">
                        <button type="button" class="btn green-meadow" data-toggle="modal" data-target="#buyModal">Buy</button>
                        <button type="button" class="btn red-mint" data-toggle="modal" data-target="#sellModal">Sell</button>
                    </div>
                    <!-- Modal Buy Start-->
                    <div id="buyModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <div class="portlet-title">
                                        <div class="caption font-green-haze">
                                            <i class="icon-bag font-green-haze"></i>
                                            <span class="caption-subject bold uppercase">Buy Share</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">                                             
                                            <div class="portlet-body form">
                                                <form role="form" class="form-horizontal" method="GET" action="{{ route('portfolios.shares.create', $portfolio) }}">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label for="single-append-text" class="col-md-4 control-label">Select Company:</label>
                                                            <div class="col-md-8">
                                                                <div class="input-group select2-bootstrap-append">
                                                                    <select id="single-append-text" class="form-control basic-single-select2 select-company" name="company_info" style="width: 300px;">
                                                                        @foreach ($instruments as $id => $company)
                                                                        <option value="{{ $id }}">{{ $company }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!--company info start-->
                                        <div class="company-info">

                                        </div>
                                        <!--company info end-->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn blue">Confirm</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Buy End-->
                    <!-- Modal Sell Start-->
                    <div id="sellModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <div class="portlet-title">
                                        <div class="caption font-green-haze">
                                            <i class="icon-bag font-green-haze"></i>
                                            <span class="caption-subject bold uppercase">Sell Share</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">                                             
                                            <div class="portlet-body form">
                                                <form role="form" class="form-horizontal" method="GET" action="{{ route('portfolios.shares.create', $portfolio) }}">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label for="single-append-text" class="col-md-4 control-label">Select Company:</label>
                                                            <div class="col-md-8">
                                                                <div class="input-group select2-bootstrap-append">
                                                                    <select id="single-append-text" class="form-control basic-single-select2 select-company" name="company_info" style="width: 300px;">
                                                                        @foreach ($instruments as $id => $company)
                                                                        <option value="{{ $id }}">{{ $company }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!--company info start-->
                                        <div class="company-info">
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
                                                                <th>Market Lot:</th>
                                                                <th>{{ $max_shares }}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Quantity:</th>
                                                                <th>{{ $max_shares }}</th>
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
                                                    <form method="POST" action="{{ route('portfolios.shares.store', $portfolio) }}">
                                                        {{ csrf_field() }}
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="control-label" for="buy_quantity">Sell Quantity:</label>      
                                                                <div class="form-group">
                                                                    <div class="input-icon right">
                                                                        <input type="text" name="buy_quantity" class="form-control"> 
                                                                        <input type="hidden" class="form-control" name="instrument_id" value="{{ $company_info->id }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--company info end-->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn blue">Confirm</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Sell End-->
                </div>
                <div class="clearx"></div>
                <div class="col-md-12">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-briefcase"></i>Portfolio</div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable">
                                <table class="table table-striped table-hovern table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="text-align: center"></th>
                                            <th colspan="3" style="text-align: center">Today</th>
                                            <th colspan="3" style="text-align: center"></th>
                                            <th colspan="4" style="text-align: center">Since Purchased</th>
                                            <th colspan="2" style="text-align: center"></th>
                                        </tr>
                                        <tr>
                                            <th>Company Code</th>
                                            <th>LTP</th>
                                            <th>Change</th>
                                            <th>Gain/Loss</th>
                                            <th>Shares</th>
                                            <th>Buy</th>
                                            <th>Commission</th>
                                            <th>Total Purchase</th>
                                            <th>Total Gain/Loss</th>
                                            <th>% Change</th>
                                            <th>% Portfolio</th>
                                            <th>Sell Value</th>
                                            <th>Sell</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @php
                                        $sumGainLoss = 0;
                                        $sumTotalPurchase = 0;
                                        $sumTotalGain = 0;
                                        $sumSellValueDeductingCommision = 0;

                                        $sumBuyCommissionLoop = 0;
                                        $sumTotalPurchaseLoop = 0;
                                        $sumTotalGainLoop = 0;
                                        $growthPercent = 0;
                                        $sumPercentPortfolioLoop = 0;
                                        @endphp

                                        @forelse ($portfolio->shares as $share)
                                        @php
                                        $instrumentCode = $share->intrument->instrument_code;
                                        $instrumentName = $share->intrument->name;
                                        $portfolioCashAmount = $portfolio->cash_amount;
                                        $noOfShare = $share->no_of_shares;
                                        $sumNoOfShare = $portfolio->shares->sum('no_of_shares');

                                        $buyingPrice = $share->buying_price;
                                        $totalBuyCost  = $noOfShare * $buyingPrice;

                                        $lastTradePrice = $share->intrument->data_banks_intraday->close_price;
                                        $lastTradeDate = $share->intrument->data_banks_intraday->lm_date_time->format('Y-m-d');
                                        $priceChange = $share->intrument->data_banks_intraday->price_change;
                                        $gainLoss = $priceChange * $noOfShare;
                                        $sumGainLoss += $gainLoss;

                                        $shareComission = $share->commission;
                                        $buyCommission = $shareComission * $totalBuyCost / 100;

                                        $totalPurchase = $buyingPrice * $noOfShare + $buyCommission;
                                        $sumTotalPurchase += $totalPurchase;

                                        $sellValue = $noOfShare * $lastTradePrice;
                                        $sellCommission = ($shareComission / 100) * $sellValue;
                                        $sellValueDeductingCommision = $sellValue - $sellCommission;
                                        $sumSellValueDeductingCommision += $sellValueDeductingCommision;

                                        $totalBuyCostWithCommission = $totalBuyCost + $buyCommission;
                                        $totalGain = $sellValueDeductingCommision - $totalBuyCostWithCommission;
                                        $sumTotalGain += $totalGain;

                                        $percentChange = $totalGain / $totalBuyCostWithCommission * 100;

                                        $allShareCashAmount = $sumNoOfShare * $buyingPrice;
                                        $totalPortfolioValue = $allShareCashAmount + $portfolioCashAmount;
                                        $percentPortfolio = $sellValue / $totalPortfolioValue * 100;
                                        $portfolioOfCash = $portfolioCashAmount / $totalPortfolioValue * 100;


                                        $sumBuyCommissionLoop += $buyCommission;
                                        $sumTotalPurchaseLoop += $totalPurchase;
                                        $sumTotalGainLoop += $totalGain;
                                        $growthPercent += $percentChange;                                
                                        $sumPercentPortfolioLoop += $percentPortfolio;
                                        @endphp

                                        <tr>
                                            <td>
                                                <span class="bold text-primary">{{ $instrumentCode }}</span>
                                                <br>
                                                <small class="instrument-name">{{ $instrumentName }}</small>
                                            </td>
                                            <td>
                                                {{ $lastTradePrice }}
                                            </td>
                                            <td>
                                                {{ number_format($priceChange, 2) }}
                                            </td>
                                            <td>
                                                @if ($gainLoss > 0)
                                                <span class="text-success">{{ number_format($gainLoss, 2) }}</span>
                                                @else
                                                <span class="text-danger">{{ number_format($gainLoss, 2) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $noOfShare }}</td>
                                            <td>{{ $buyingPrice }}</td>
                                            <td>{{ $buyCommission }}</td>
                                            <td>{{ $totalPurchase }}</td>
                                            <td>
                                                @if ($totalGain > 0)
                                                <span class="text-success">{{ $totalGain }}</span>
                                                @else
                                                <span class="text-danger">{{ $totalGain }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($percentChange > 0)
                                                <span class="text-success">{{ number_format($percentChange, 2) }}%</span>
                                                @else
                                                <span class="text-danger">{{ number_format($percentChange, 2) }}%</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ number_format($percentPortfolio, 2) }}%
                                            </td>
                                            <td>{{ $sellValueDeductingCommision }}</td>
                                            <td>
                                                @if ($share->is_mature)
                                                <small>Matured</small>
                                                @else
                                                <small>Not Matured</small>
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($loop->last)
                                        <tr class="active">
                                            <td colspan="3">
                                                <span class="bold">Cash</span>
                                            </td>
                                            <td></td>
                                            <td colspan="3"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ number_format($portfolioOfCash, 2) }}%</td>
                                            <td>
                                                <span class="bold">
                                                    {{ number_format($portfolioCashAmount, 2) }}
                                                </span>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr class="active">
                                            <td colspan="3">
                                                <span class="bold">Total</span>
                                            </td>
                                            <td>
                                                @if ($sumGainLoss > 0)
                                                <span class="text-success">{{ number_format($sumGainLoss, 2) }}</span>
                                                @else
                                                <span class="text-danger">{{ number_format($sumGainLoss, 2) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $sumNoOfShare }}</td>
                                            <td colspan="2"></td>
                                            <td>{{ $sumBuyCommissionLoop }}</td>
                                            <td>{{ $sumTotalPurchaseLoop }}</td>
                                            <td>
                                                @if ($sumTotalGainLoop > 0)
                                                <span class="text-success">{{ $sumTotalGainLoop }}</span>
                                                @else
                                                <span class="text-danger">{{ $sumTotalGainLoop }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($growthPercent > 0)
                                                <span class="text-success">{{ $growthPercent }}%</span>
                                                @else
                                                <span class="text-danger">{{ number_format($growthPercent, 2) }}%</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($portfolioOfCash += $sumPercentPortfolioLoop, 2) }}%</td>
                                            <td>
                                                <span class="bold">
                                                    {{ number_format($sumSellValueDeductingCommision += $portfolioCashAmount, 2) }}
                                                </span>
                                            </td>
                                            <td></td>
                                        </tr>
                                        @endif
                                        @empty     
                                        <tr class="no-records-found text-center">
                                            <td colspan="13">
                                                No portfolio available. Please <a href="{{ route('portfolios.shares.create', $portfolio) }}">buy share</a> to create your portfolio.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $(".basic-single-select2").select2({
            placeholder: "Select a company",
            allowClear: true
        });

        $('.select-company').change(function () {
            startLoading($(this));
            $.get('?company_info=' + $(this).val(), function (data) {
                $('.company-info').html(data);
                endLoading();
            });
        });
    });
</script>
@endsection