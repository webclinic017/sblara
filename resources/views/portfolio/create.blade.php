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

                        <div class="col-md-6">
                           <div class="form-group form-md-line-input has-success form-md-floating-label">
                               <div class="input-icon right">
                                   <input class="form-control" type="text">
                                   <label for="form_control_1">Portfolio name</label>
                                   <span class="help-block">Your portfolio name...</span>
                                   <i class="icon-briefcase"></i>
                               </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input has-success form-md-floating-label">
                                <div class="input-icon right">
                                    <input class="form-control" type="text">
                                    <label for="form_control_1">Cash</label>
                                    <span class="help-block">If you dont add any cash, your total cash will be negative when purchase share</span>
                                    <i class="fa fa-money"></i>
                                </div>
                            </div>
                        </div>




               {{-- <div class="col-md-6">
                    <div class="form-group form-md-line-input">
                        <div class="input-group">
                            <div class="input-group-control">
                                <input type="text" class="form-control" value="" required="" name="name">
                                <label for="form_control_1">Portfolio Name</label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-md-line-input">
                        <div class="input-group">
                            <div class="input-group-control">
                                <input type="text" class="form-control" value="" required="" name="name">
                                <label for="form_control_1">Portfolio Name</label>
                            </div>

                        </div>
                    </div>
                </div>--}}
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
    $(function () {
        $(".portfolio_date").datepicker({
            format: 'yyyy-mm-dd'
        });
        $(".portfolio-menu .create").addClass('active');
        $(".portfolio-menu").addClass('open');
    })

</script>
@endsection

