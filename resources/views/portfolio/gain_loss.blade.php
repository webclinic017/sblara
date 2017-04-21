@extends('layouts.default')
@section('content')
@include('portfolio.portfolio_actions')

<div class="portlet light bordered ">
    <div class="portlet-title">
        <div class="caption font-green">
            <!--<i class="icon-pin font-green"></i>-->
            <span class="caption-subject bold uppercase"> Realized Gain/Loss</span>
        </div>
    </div>
    <div class="portlet-body form">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Market</th>
                    <th>Shares</th>
                    <th>Buy Price</th>
                    <th>Buy Comm.</th>
                    <th>Total Buy Price</th>
                    <th>Buy Date</th>
                    <th>Sell Price</th>
                    <th>Sell Comm.</th>
                    <th>Total Sell Price</th>
                    <th>Sell Date</th>
                    <th>Gain/Loss</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @each('portfolio.gain_loss_item',$transactions,'transaction')

            </tbody>
        </table>
    </div>
</div>

@endsection
@section('js')
<script>
    $(".portfolioActions .gain-loss").addClass('active');
    $(".portfolio-menu").addClass('open');
    $(function () {
    })

</script>
@endsection

