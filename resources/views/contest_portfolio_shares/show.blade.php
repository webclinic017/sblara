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
                    </span>
                </div>

                @include('contest_portfolio_shares.partials.menu')
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
                            <th class="text-center">Code</th>
                            <th class="text-center">LTP</th>
                            <th class="text-center">Change</th>
                            <th class="text-center">Gain/Loss</th>
                            <th class="text-center">Shares</th>
                            <th class="text-center">B Price</th>
                            <th class="text-center">B Date</th>
                            <th class="text-center">Buy Comm</th>
                            <th class="text-center">Total Purchase</th>
                            <th class="text-center">Total G/L</th>
                            <th class="text-center">% Change</th>
                            <th class="text-center">% Portfolio</th>
                            <th class="text-center">Sell Value</th>
                            <th class="text-center">Sell</th>
                        </tr>
                    </thead>

                    <tbody> 
                        @php
                            $sumSellValueDeductingCommision = 0;
                            $sumPercentPortfolio = 0;
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

                                $lastTradePrice = number_format($share->intrument->data_banks_intraday->close_price, 2);
                                $lastTradeDate = $share->intrument->data_banks_intraday->lm_date_time->format('Y-m-d');
                                $priceChange = number_format($share->intrument->data_banks_intraday->price_change, 2);
                                $gainLoss = $priceChange * $noOfShare;

                                $shareComission = $share->commission;
                                $buyCommission = $shareComission * $totalBuyCost / 100;
                                
                                $totalPurchase = $buyingPrice * $noOfShare + $buyCommission;

                                $sellValue = $noOfShare * $lastTradePrice;
                                $sellCommission = ($shareComission / 100) * $sellValue;
                                $sellValueDeductingCommision = $sellValue - $sellCommission;
                                $sumSellValueDeductingCommision += $sellValueDeductingCommision;

                                $totalBuyCostWithCommission = $totalBuyCost + $buyCommission;
                                $totalGain = $sellValueDeductingCommision - $totalBuyCostWithCommission;

                                $percentChange = number_format($totalGain / $totalBuyCostWithCommission * 100, 2);

                                $allShareCashAmount = $sumNoOfShare * $buyingPrice;
                                $totalPortfolioValue = $allShareCashAmount + $portfolioCashAmount;
                                $percentPortfolio = number_format($sellValue / $totalPortfolioValue * 100, 2);
                                $portfolioOfCash = number_format($portfolioCashAmount / $totalPortfolioValue * 100, 2);
                                $sumPercentPortfolio += $percentPortfolio;
                            @endphp

                            <tr>
                                <td>
                                    <span class="bold text-primary">{{ $instrumentCode }}</span>

                                </td>
                                <td>
                                    {{ $lastTradePrice }} <br>
                                     <small class="instrument-name">
                                        ({{ $lastTradeDate }})
                                    </small>
                                </td>
                                <td>
                                    {{ $priceChange }}
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
                                    {{ $percentPortfolio }}
                                </td>
                                <td>{{ $sellValueDeductingCommision }}</td>
                                <td>
                                    @if (isMature($share->intrument->id,$share->buying_date->format('Y-m-d')))
                                        <a href="{{ route('portfolios.shares.edit', $share) }}" class="btn blue">Sell</a>
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
                                    <td>{{ $portfolioOfCash }}%</td>
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
                                    <td>{{ $sumNoOfShare }}</td>
                                    <td colspan="2"></td>
                                    <td>{{ $sumBuyCommission }}</td>
                                    <td>{{ $sumTotalPurchase }}</td>
                                    <td>
                                        @if ($sumTotalGain > 0)
                                            <span class="text-success">{{ $sumTotalGain }}</span>
                                        @else
                                            <span class="text-danger">{{ $sumTotalGain }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($growthPercent > 0)
                                            <span class="text-success">{{ $growthPercent }}</span>
                                        @else
                                            <span class="text-danger">{{ $growthPercent }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $portfolioOfCash += $sumPercentPortfolio }}%</td>
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
@endsection
