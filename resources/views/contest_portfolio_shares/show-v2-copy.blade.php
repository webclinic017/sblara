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
                            $multiplier = count($portfolio->shares);
                        @endphp

                        @forelse ($portfolio->shares as $share)
                            @if (count($portfolio->shares) > 1)
                                @if ($loop->first)
                                    <tr>
                                        <td>
                                            <span class="bold text-primary">{{ $share->intrument->instrument_code }}</span>
                                            <small class="instrument-name">{{ $share->intrument->name }}</small>
                                        </td>
                                        <td>
                                            {{ $lastTradePrice }}
                                            <small class="instrument-name">({{ $lastTradeDate }})</small>
                                        </td>
                                        <td>
                                            @if ($change > 0)
                                                <span class="text-success">{{ number_format($change, 2) }}</span>
                                            @else
                                                <span class="text-danger">{{ number_format($change, 2) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($gainLossToday > 0)
                                                <span class="text-success">{{ number_format($gainLossToday * $multiplier, 2) }}</span>
                                            @else
                                                <span class="text-danger">{{ number_format($gainLossToday * $multiplier, 2) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $share->sum('no_of_shares') }}</td>
                                        <td>{{ $share->buying_price }}</td>
                                        <td>Multiple</td>
                                        <td>{{ $commission * $multiplier }}</td>
                                        <td>{{ $totalPurchase * $multiplier }}</td>

                                        <td>
                                            @if ($gainLossTotal > 0)
                                                <span class="text-success">{{ number_format($gainLossTotal * $multiplier, 2) }}</span>
                                            @else
                                                <span class="text-danger">{{ number_format($gainLossTotal * $multiplier, 2) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($percentChange > 0)
                                                <span class="text-success">{{ number_format($percentChange, 2) }}</span>
                                            @else
                                                <span class="text-danger">{{ number_format($percentChange, 2) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($percentPortfolio * $multiplier, 2) }}</td>
                                        <td>{{ number_format($sellValue * $multiplier, 2) }}</td>
                                        <td></td>
                                    </tr>
                                @endif
                            @endif

                            <tr>
                                <td>
                                    @if (count($portfolio->shares) > 1)
                                        <!-- -->
                                    @else
                                        <span class="bold text-primary">{{ $share->intrument->instrument_code }}</span>
                                        <br>
                                        <small class="instrument-name">{{ $share->intrument->name }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if (count($portfolio->shares) > 1)
                                        <!-- -->
                                    @else
                                        {{ number_format($lastTradePrice, 2) }}
                                        <br>
                                        <small class="instrument-name">({{ $lastTradeDate }})</small>
                                    @endif
                                </td>
                                <td>
                                    @if (count($portfolio->shares) > 1)
                                        <!-- -->
                                    @else
                                        @if ($change > 0)
                                            <span class="text-success">{{ number_format($change, 2) }}</span>
                                        @else
                                            <span class="text-danger">{{ number_format($change, 2) }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($gainLossToday > 0)
                                        <span class="text-success">{{ number_format($gainLossToday, 2) }}</span>
                                    @else
                                        <span class="text-danger">{{ number_format($gainLossToday, 2) }}</span>
                                    @endif
                                </td>
                                <td>{{ $share->no_of_shares }}</td>
                                <td>{{ $share->buying_price }}</td>
                                <td>
                                    {{ $share->buying_date->format('Y-m-d') }}
                                </td>
                                <td>{{ number_format($commission, 2) }}</td>
                                <td>{{ number_format($totalPurchase, 2) }}</td>
                                <td>
                                    @if ($gainLossTotal > 0)
                                        <span class="text-success">{{ number_format($gainLossTotal, 2) }}</span>
                                    @else
                                        <span class="text-danger">{{ number_format($gainLossTotal, 2) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($percentChange > 0)
                                        <span class="text-success">{{ number_format($percentChange, 2) }}</span>
                                    @else
                                        <span class="text-danger">{{ number_format($percentChange, 2) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if (count($portfolio->shares) > 1)
                                        <!-- -->
                                    @else
                                        {{ number_format($percentPortfolio, 2) }}
                                    @endif
                                </td>
                                <td>{{ number_format($sellValue, 2) }}</td>
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
                                    <td>
                                        @if ($gainLossToday > 0)
                                            <span class="text-success">{{ number_format($gainLossToday * $multiplier, 2) }}</span>
                                        @else
                                            <span class="text-danger">{{ number_format($gainLossToday * $multiplier, 2) }}</span>
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ number_format($totalPurchase * $multiplier, 2) }}</td>
                                    <td>
                                        @if ($gainLossTotal > 0)
                                            <span class="text-success">{{ number_format($gainLossTotal * $multiplier, 2) }}</span>
                                        @else
                                            <span class="text-danger">{{ number_format($gainLossTotal * $multiplier, 2) }}</span>
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <span class="bold">
                                            {{ number_format($portfolio->cash_amount + $sellValue * $multiplier, 2) }}
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
