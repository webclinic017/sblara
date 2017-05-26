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
                <table class="table table-bordered table-condensed table-hover">
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
                        @forelse ($portfolio->shares as $share)
                            @php
                                $noOfShare = $share->no_of_shares;
                                $buyingPrice = $share->buying_price;
                                $totalBuyCost  = $noOfShare * $buyingPrice;

                                $lastTradePrice = $share->intrument->data_banks_intraday->close_price;
                                $priceChange = $share->intrument->data_banks_intraday->price_change;
                                $gainLoss = $priceChange * $noOfShare;

                                $portfolioComission = $share->commission;

                                $buyCommission = $portfolioComission * $totalBuyCost / 100;

                                $totalPurchase = $buyingPrice * $noOfShare + $buyCommission;

                                $sellValue = $noOfShare * $lastTradePrice;
                                $sellCommission = ($portfolioComission / 100) * $sellValue;
                                $sellValueDeductingCommision = $sellValue - $sellCommission;

                                $totalBuyCostWithCommission = $totalBuyCost + $buyCommission;
                                $totalGain = $sellValueDeductingCommision - $totalBuyCostWithCommission;

                                $percentChange = $totalGain / $totalBuyCostWithCommission * 100;

                                $allShareCashAmount = $share->sum('no_of_shares') * $buyingPrice;
                                $totalPortfolioValue = $allShareCashAmount + $portfolio->cash_amount;
                                $percentPortfolio = $sellValue / $totalPortfolioValue * 100;
                            @endphp

                            <tr>
                                <td>
                                    <span class="bold text-primary">{{ $share->intrument->instrument_code }}</span>
                                    <br>
                                    <small class="instrument-name">{{ $share->intrument->name }}</small>
                                </td>
                                <td>
                                    {{ $lastTradePrice }}
                                     <small class="instrument-name">
                                        ({{ $share->intrument->data_banks_intraday->lm_date_time->format('Y-m-d') }})
                                    </small>
                                </td>
                                <td>{{ $priceChange }}</td>
                                <td>{{ $gainLoss }}</td>
                                <td>{{ $noOfShare }}</td>
                                <td>{{ $buyingPrice }}</td>
                                <td>{{ $share->buying_date->format('Y-m-d')  }}</td>
                                <td>{{ $buyCommission }}</td>
                                <td>{{ $totalPurchase }}</td>
                                <td>{{ $totalGain }}</td>
                                <td>{{ $percentChange }}</td>
                                <td>{{ $percentPortfolio }}</td>
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
                                    <td>
                                        <span class="bold">Cash</span>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <span class="bold">
                                            {{ number_format($portfolio->cash_amount, 2) }}
                                        </span>
                                    </td>
                                    <td></td>
                                </tr>

                                <tr class="active">
                                    <td>
                                        <span class="bold">Total</span>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <span class="bold">
                                            
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
