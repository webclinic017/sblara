@extends('layouts.default')
@section('content')

@if(session('status')=='success')
<div class="alert alert-success">
    Portfolio Saved successfully!
</div>
@endif
@include('portfolio.portfolio_actions')

<form role="form" action="/portfolio" method="post">
    <div class="portlet light bordered ">
        <div class="portlet-title">
            <div class="caption font-green">
                <i class="icon-pin font-green"></i>
                <span class="caption-subject bold uppercase"> {{$portfolio?'Update':'Create'}} Portfolio</span>
            </div>
        </div>
        <div class="portlet-body form">
            {{csrf_field()}}
            <input type="hidden" name="portfolioId" value="{{$portfolio->id or ''}}">
            <div class="form-group form-md-line-input">
                <div class="input-group">
                    <div class="input-group-control">
                        <input type="text" class="form-control" value="{{$portfolio->portfolio_name or ''}}" required="" name="name">
                        <label for="form_control_1">Portfolio Name</label>
                    </div>
                    <span class="input-group-btn btn-right">
                        <button type="submit" class="btn blue">Save</button>
                    </span>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Transaction</th>
                        <th>Symbol</th>
                        <th>Market</th>
                        <th># Shares</th>
                        <th>Price/Share</th>
                        <th>Commission%</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @if($portfolio)
                    @each('portfolio.transaction_item',$transactions,'transaction')
                    @endif
                    @include('portfolio.create_transaction_item')
                    @include('portfolio.create_transaction_item')
                    @include('portfolio.create_transaction_item')
                    @include('portfolio.create_transaction_item')
                    @include('portfolio.create_transaction_item')

                </tbody>
            </table>
        </div>
    </div>
</form>
@endsection
@section('js')
<script>
    $(".portfolioActions .edit").addClass('active');
    $(".portfolio-menu").addClass('open');
    $(function () {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $(".transactionType").change(function () {
            var value = $(this).val()
            var tr = $(this).closest('tr');
            if (value == 1 || value == 4)
            {
                tr.find('.type-sell').addClass('hidden');
                tr.find('.type-buy').removeClass('hidden');
            }
            else
            {
                tr.find('.type-buy').addClass('hidden');
                tr.find('.type-sell').removeClass('hidden');

            }
        })
    })

</script>
@endsection

