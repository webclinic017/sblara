@extends('layouts.metronic.default')
@section('content')
@include('portfolio.portfolio_actions')
@section('page_heading')
{{$portfolio->portfolio_name}}
@endsection

<div class="portlet light bordered ">
    <div class="portlet-title">
        <div class="caption font-green">
            <!--<i class="icon-pin font-green"></i>-->
            <span class="caption-subject bold uppercase"> Portfolio Performances</span>
        </div>
    </div>
    <div class="portlet-body portfolio-content-area form">

        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <tr>
                    <th colspan="2"></th>
                    <th colspan="3" class="text-center">Today</th>
                    <th colspan="3"></th>
                    <th colspan="4" class="text-center">Since Purchased</th>
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
                    {{--<th>%Portfolio</th>--}}
                    <th>Sell Value</th>
                </tr>
            </thead>
            <tbody>
                @each('portfolio.performance_item',$transactions,'transaction')
                @include('portfolio.performance_total_item',['portfolio'=>$portfolio])

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


        $(".showTransactionChildren").click(function () {
            $(this).addClass('hidden');
            var tr = $(this).closest('tr');
            tr.nextUntil('.normalTransaction').removeClass('hidden');
            tr.find('.hideTransactionChildren').removeClass('hidden');
        })
        $(".hideTransactionChildren").click(function () {
            $(this).addClass('hidden');
            var tr = $(this).closest('tr');
            tr.nextUntil('.normalTransaction').addClass('hidden');
            tr.find('.showTransactionChildren').removeClass('hidden');
        })
    })

</script>
@endsection

