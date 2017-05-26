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
                         Details
                    </span>
                </div>
            </div>

            <div class="portlet-body">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr class="bg-primary">
                            <th colspan="2"></th>
                            <th class="text-center" colspan="3">
                                <span class="caption-subject bold uppercase">
                                    <span class="text-primary"></span>
                                    Today
                                </span>
                            </th>
                            <th colspan="3"></th>
                            <th class="text-center" colspan="4">Since Purchased</th>
                            <th colspan="2"></th>
                        </tr>

                        <tr class="text-center active">
                            <th class="text-center">Company Code</th>
                            <th class="text-center">Last Trade Price</th>
                            <th class="text-center">Change</th>
                            <th class="text-center">Gain/Loss</th>
                            <th class="text-center">Shares</th>
                            <th class="text-center">Buy Price</th>
                            <th class="text-center">Purchase Date</th>
                            <th class="text-center">Buy Commision</th>
                            <th class="text-center">Total Purchase</th>
                            <th class="text-center">Total Gain/Loss</th>
                            <th class="text-center">% Change</th>
                            <th class="text-center">% Portfolio</th>
                            <th class="text-center">Sell Value</th>
                            <th class="text-center">Sell</th>
                        </tr>
                    </thead>

                    <tbody> 
                        @php
                            $sumGainLoss = 0;
                            $sumTotalPurchase = 0;
                            $sumTotalGain = 0;
                            $sumPercentPortfolio = 0;
                            $sumSellValueDeductingCommision = 0;
                        @endphp

                        @forelse ($portfolio->shares as $key => $share)
                            @php
                                $instrumentCode = $share->intrument->instrument_code;
                                $instrumentName = $share->intrument->name;
                                $portfolioCashAmount = $portfolio->cash_amount;
                                $noOfShare = $share->no_of_shares;
                                $sumNoOfShare = $share->sum('no_of_shares');
                                $buyingPrice = $share->buying_price;
                                $totalBuyCost  = $noOfShare * $buyingPrice;

                                $lastTradePrice = number_format($share->intrument->data_banks_intraday->close_price, 2);
                                $lastTradeDate = $share->intrument->data_banks_intraday->lm_date_time->format('Y-m-d');
                                $priceChange = number_format($share->intrument->data_banks_intraday->price_change, 2);
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

                                $percentChange = number_format($totalGain / $totalBuyCostWithCommission * 100, 2);

                                $allShareCashAmount = $sumNoOfShare * $buyingPrice;
                                $totalPortfolioValue = $allShareCashAmount + $portfolioCashAmount;
                                $percentPortfolio = $sellValue / $totalPortfolioValue * 100;
                                $sumPercentPortfolio += $percentPortfolio;
                            @endphp

                            @if (count($portfolio->shares) > 1)
                                @if ($loop->first)
                                    <tr class="danger">
                                        <td>
                                            <span class="bold text-primary">{{ $instrumentCode }}</span>
                                            <small class="instrument-name">{{ $instrumentName }}</small>
                                        </td>
                                        <td>
                                            {{ $lastTradePrice }}
                                            <small class="instrument-name">({{ $lastTradeDate }})</small>
                                        </td>
                                        <td>
                                            @if ($priceChange > 0)
                                                <span class="text-success">{{ $priceChange }}</span>
                                            @else
                                                <span class="text-danger">{{ $priceChange }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($sumGainLossLoop > 0)
                                                <span class="text-success">{{ $sumGainLossLoop }}</span>
                                            @else
                                                <span class="text-danger">{{ $sumGainLossLoop }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $sumNoOfShare }}</td>
                                        <td>{{ $buyingPrice }}</td>
                                        <td>Multiple</td>
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
                                            @if ($percentChange > 0)
                                                <span class="text-success">{{ $percentChange }}</span>
                                            @else
                                                <span class="text-danger">{{ $percentChange }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $sumPercentPortfolioLoop }}</td>
                                        <td>{{ $sumSellValueDeductingCommisionLoop }}</td>
                                        <td></td>
                                    </tr>
                                @endif
                            @endif

                            <tr>
                                <td>
                                    @if (count($portfolio->shares) > 1)
                                        <small>
                                            {{ $lastTradeDate }}<br>
                                            {{ $noOfShare }} @ TK {{ $lastTradePrice }}
                                        </small>
                                    @else
                                        <span class="bold text-primary">{{ $instrumentCode }}</span>
                                        <br>
                                        <small class="instrument-name">{{ $instrumentName }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if (count($portfolio->shares) > 1)
                                        --
                                    @else
                                        {{ $lastTradePrice }}
                                         <small class="instrument-name">
                                            ({{ $lastTradeDate }})
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    @if (count($portfolio->shares) > 1)
                                        --
                                    @else
                                        {{ $priceChange }}
                                    @endif
                                </td>
                                <td>
                                    @if ($gainLoss > 0)
                                        <span class="text-success">{{ $gainLoss }}</span>
                                    @else
                                        <span class="text-danger">{{ $gainLoss }}</span>
                                    @endif
                                </td>
                                <td>{{ $noOfShare }}</td>
                                <td>{{ $buyingPrice }}</td>
                                <td>{{ $share->buying_date->format('Y-m-d')  }}</td>
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
                                        <span class="text-success">{{ $percentChange }}</span>
                                    @else
                                        <span class="text-danger">{{ $percentChange }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if (count($portfolio->shares) > 1)
                                        
                                    @else
                                        {{ $percentPortfolio }}
                                    @endif
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
                                    <td></td>
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
                                            <span class="text-success">{{ $sumGainLoss }}</span>
                                        @else
                                            <span class="text-danger">{{ $sumGainLoss }}</span>
                                        @endif
                                    </td>
                                    <td colspan="3"></td>
                                    <td></td>
                                    <td>{{ $sumTotalPurchase }}</td>
                                    <td>
                                        @if ($sumTotalGain > 0)
                                            <span class="text-success">{{ $sumTotalGain }}</span>
                                        @else
                                            <span class="text-danger">{{ $sumTotalGain }}</span>
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <span class="bold">
                                            {{ $sumSellValueDeductingCommision += $portfolioCashAmount }}
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
@endsection
