@extends('layouts.metronic.default')
@section('content')
<form role="form" action="/portfolio" method="post">
    <div class="portlet light bordered ">
        <div class="portlet-title">
            <div class="caption font-green">
                <i class="icon-pin font-green"></i>
                <span class="caption-subject bold uppercase"> Create Portfolio</span>
            </div>
        </div>
        <div class="portlet-body form">
            {{csrf_field()}}
            <div class="row">

                <div class="col-md-4">
                   <div class="form-group form-md-line-input has-success form-md-floating-label">
                       <div class="input-icon right">
                           <input class="form-control" type="text"  required="" name="name">
                           <label for="form_control_1">Portfolio name</label>
                           <span class="help-block">Your portfolio name...</span>
                           <i class="icon-briefcase"></i>
                       </div>
                   </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                        <div class="input-icon right">
                            <input class="form-control" type="text"  name="cash_amount">
                            <label for="form_control_1">Cash</label>
                            <span class="help-block">If you don't add any cash, your total cash will be negative when purchase share</span>
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                        <div class="input-icon right">
                            <input class="form-control" type="text"  name="broker_fee" required="">
                            <label for="form_control_1">Commission</label>
                            <span class="help-block">default broker commission for this portfolio</span>
                            <i class="fa fa-scissors"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
             <div class="col-md-12">
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
                        @include('portfolio.create_transaction_item')
                        @include('portfolio.create_transaction_item')
                        @include('portfolio.create_transaction_item')
                        @include('portfolio.create_transaction_item')
                        @include('portfolio.create_transaction_item')
                        @include('portfolio.create_transaction_item')
                        @include('portfolio.create_transaction_item')

                    </tbody>
                </table>
            </div>
            </div>
            <div class="row">
             <div class="col-md-4 col-md-offset-4">
                   <span class="input-group-btn btn-right">
                       <button class="btn blue btn-block" type="submit" class="btn blue">Save</button>
                   </span>
            </div>
            </div>


        </div>
    </div>
</form>

@endsection
@section('js')
<script>
    $(function () {
        $(".portfolio_date").datepicker({
            format: 'yyyy-mm-dd'
        });
        $(".portfolio-menu .create").addClass('active');
        $(".portfolio-menu").addClass('open');
    })

</script>
@endsection

