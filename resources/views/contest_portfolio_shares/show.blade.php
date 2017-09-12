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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <span class="caption-subject bold uppercase">
                                    <span class="text-primary"></span>
                                    Your Position is () Among () Participants 
                                </span>
                            </th>
                        </tr>

                        <tr class="text-center">
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
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($portfolio->shares as $share)
                            @if (count($portfolio->shares) > 1)
                                @if ($loop->first)
                                    <tr>
                                        <td>
                                            {{ $share->intrument->instrument_code }}
                                            <small class="instrument-name">{{ $share->intrument->name }}</small>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $share->sum('no_of_shares') }}</td>
                                        <td>{{ $share->buying_price }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endif
                            @endif

                            <tr>
                                <td>
                                    {{ $share->intrument->instrument_code }}
                                    <small class="instrument-name">{{ $share->intrument->name }}</small>
                                </td>
                                <td>
                                    {{ $lastTradePrice }}
                                    <small class="instrument-name">({{ $lastTradeDate }})</small>
                                </td>
                                <td>{{ $change }}</td>
                                <td>{{ $gainLossToday }}</td>
                                <td>{{ $share->no_of_shares }}</td>
                                <td>{{ $share->buying_price }}</td>
                                <td>
                                    {{ $share->buying_date->format('Y-m-d') }}
                                </td>
                                <td>{{ $commission }}</td>
                                <td>{{ $totalPurchase }}</td>
                                <td>{{ $gainLossTotal }}</td>
                                <td>{{ $percentChange }}</td>
                                <td>{{ $percentPortfolio }}</td>
                                <td>{{ $sellValue }}</td>
                            </tr>

                            @if ($loop->last)
                                <tr>
                                    <td>Cash</td>
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
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>Total</td>
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
                                    <td></td>
                                </tr>
                            @endif
                        @empty     
                            <tr class="no-records-found text-center">
                                <td colspan="13">No portfolio available. Please <a href="{{ route('portfolios.shares.create', $portfolio) }}">buy share</a> to create your portfolio.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
