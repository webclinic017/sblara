                              @foreach ($portfolio->shares as $company)
                                                                        @php
                                                                        if(!$company->isMature)
                                                                        {
                                                                             continue;
                                                                        }
                                                                        @endphp
                                                                        <option value="{{ $company->instrument->id }}">{{ $company->instrument->instrument_code }}</option>
                                                                        @endforeach
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
                                                <form id="buyForm" role="form" class="form-horizontal" method="GET" action="{{ route('portfolios.shares.create', $portfolio) }}">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label for="single-append-text" class="col-md-4 control-label">Select Company:</label>
                                                            <div class="col-md-8">
                                                                <div class="input-group select2-bootstrap-append">
                                                                    <select data-type="buy" id="single-append-text" class="form-control basic-single-select2 select-company" name="company_info" style="width: 300px;">
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
                                    <button type="submit" class="btn blue confirmBuy" >Confirm</button>
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
                                                                    <select data-type="sell" id="single-append-text" class="form-control basic-single-select2 select-company" name="company_info" style="width: 300px;">
                                                                        <option value=""></option>
                                                                        @foreach ($portfolio->shares()->with('instrument')->groupBy('instrument_id')->get() as $company)
                                                                        @php
                                                                        if(!$company->isMature)
                                                                        {
                                                                             continue;
                                                                        }
                                                                        @endphp
                                                                        <option value="{{ $company->instrument->id }}">{{ $company->instrument->instrument_code }}</option>
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
                                    <button type="submit" class="btn blue confirmSell">Confirm</button>
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
                                <table class="tree table table-striped table-hovern table-bordered">
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
                                            <th>Buy Price</th>
                                            <th>Commission</th>
                                            <th>Total Purchase</th>
                                            <th>Total Gain/Loss</th>
                                            <th>% Change</th>
                                            <th>% Portfolio</th>
                                            <th>Sell Value</th>
                                            <th>Status</th>
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
                                        $sumNoOfShare = 0;
                                        @endphp

                                        @forelse ($portfolio->shares as $share)

                                        @php
                                        // dd($portfolio->shares);
                                        if($share->availableQty < 1)
                                        {
                                            continue;
                                        }
                                        $instrumentCode = $share->intrument->instrument_code;
                                        $instrumentName = $share->intrument->name;
                                        $portfolioCashAmount = $portfolio->cash_amount;
                                        $noOfShare = $share->no_of_shares - $share->sell_quantity;
                                        $sumNoOfShare += $noOfShare;

                                        $buyingPrice = $share->buying_price;
                                        $totalBuyCost  = $noOfShare * $buyingPrice;

                                        $lastTradePrice = $share->intrument->data_banks_intraday->close_price;
                                        $lastTradeDate = $share->intrument->data_banks_intraday->lm_date_time->format('Y-m-d');
                                        $priceChange = $share->intrument->data_banks_intraday->price_change;
                                        $priceChangePercent = ($priceChange * 100) / ($lastTradePrice - $priceChange);
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
                                            <td style="color: @if($priceChange > 0) #36c6d3 @elseif($priceChange == 0) blue @else red @endif ">
                                                {{ number_format($priceChange, 2)  }} ({{number_format($priceChangePercent, 2)}}%)
                                            </td>
                                            <td>
                                                @if ($gainLoss > 0)
                                                <span class="text-success">{{ number_format($gainLoss, 2) }}</span>
                                                @else
                                                <span class="text-danger">{{ number_format($gainLoss, 2) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ round($noOfShare) }}</td>
                                            <td>{{ $buyingPrice }}</td>
                                            <td>{{ $buyCommission }}</td>
                                            <td>{{ number_format($totalPurchase, 2) }}</td>
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
                                                @if ($share->isMature)
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
                                            <td ></td>
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
                                            <td>100.00%</td>
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
                                                No portfolio available. Please <a href="javascript:" data-toggle="modal" data-target="#buyModal">buy share</a> to create your portfolio.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>


{{-- 
                                <table class="tree table table-striped table-hovern table-bordered">
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
                                            <th>Status</th>
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
                                            <td>{{ round($noOfShare) }}</td>
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
                                                @if ($share->isMature)
                                                <small>Matured</small>
                                                @else
                                                <small>Not Matured</small>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="treegrid-1">
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
                                                @if ($share->isMature)
                                                <small>Matured</small>
                                                @else
                                                <small>Not Matured</small>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr  class="treegrid-2 treegrid-parent-1">
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
                                                @if ($share->isMature)
                                                <small>Matured</small>
                                                @else
                                                <small>Not Matured</small>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr  class="treegrid-2 treegrid-parent-1">
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
                                                @if ($share->isMature)
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
                                </table> --}}
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
            if($(this).val() == "")
            {
                return;
            }
            startLoading($(this));
            var type = $(this).data('type');
            $.get('?company_info=' + $(this).val(), {type: type}, function (data) {
                $('.company-info').html(data);
                endLoading();

            });
        });
    });
</script>

<script type="text/javascript">
    $('.tree').treegrid();
</script>
@endsection