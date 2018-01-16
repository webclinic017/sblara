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
    <div class="portlet-body portfolio-content-area formn flip-scroll">

        <table class="table table-striped table-bordered table-advance table-hover table-condensed flip-content">
            <thead class="flip-content">
                <tr class="visible-md visible-lg">
                    <th colspan="2"></th>
                    <th colspan="3" class="text-center ">Today</th>
                    <th colspan="3"></th>
                    <th colspan="4" class="text-center">Since Purchased</th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <th>Code</th>
                    <th class="hidden-xs hidden-sm" >Market</th>
                    <th>LTP</th>
                    <th>Change</th>
                    <th>Gain/Loss</th>
                    <th>Shares</th>
                    <th>Buy Price</th>
                    <th><span class="hidden-xs hidden-sm">Purchase Date</span> <span class="visible-xs visible-sm">Date</span></th>
                    <th><span class="hidden-xs hidden-sm">Buy Commission </span> <span class="visible-xs visible-sm">Comm </span></th>
                    <th><span class="hidden-xs hidden-sm">Total Purchase</span> <span class="visible-xs visible-sm">Total Pur </span></th>
                    <th>Gain/Loss</th>
                    <th>%Change</th>
                    <th>%Portfolio</th>
                    <th>Sell Value</th>
                </tr>
            </thead>
            <tbody>
                @include('portfolio.performance_item',['portfolio'=>$portfolio])
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
