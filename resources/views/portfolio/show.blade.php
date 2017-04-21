@extends('layouts.default')
@section('content')
@include('portfolio.portfolio_actions')

<div class="portlet light bordered ">
    <div class="portlet-title">
        <div class="caption font-green">
            <!--<i class="icon-pin font-green"></i>-->
            <span class="caption-subject bold uppercase"> Portfolio Performance</span>
        </div>
    </div>
    <div class="portlet-body form">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="2"></th>
                    <th colspan="3">Today</th>
                    <th colspan="3"></th>
                    <th colspan="4">Since Purchased</th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <th>Company Code</th>
                    <th>Market</th>
                    <th>Last Trade Price</th>
                    <th>Change</th>
                    <th>Gain/Loss</th>
                    <th>Shares</th>
                    <th>Buy Price</th>
                    <th>Purchase Date</th>
                    <th>Buy Commission</th>
                    <th>Total Purchase</th>
                    <th>Gain/Loss</th>
                    <th>%Change</th>
                    <th>%Portfolio</th>
                    <th>Sell Value</th>
                </tr>
            </thead>
            <tbody>
                @each('portfolio.performance_item',$transactions,'transaction')

            </tbody>
        </table>
    </div>
</div>

@endsection
@section('js')
<script>
    $(".portfolio-menu").addClass('open');
    $(".portfolioActions .performance").addClass('active');
    $(function () {
    })

</script>
@endsection

