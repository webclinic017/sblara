@extends('layouts.default')
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
            <div class="form-group form-md-line-input">
                <div class="input-group">
                    <div class="input-group-control">
                        <input type="text" class="form-control" value="" required="" name="name">
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
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $(".portfolio-menu .create").addClass('active');
        $(".portfolio-menu").addClass('open');
    })

</script>
@endsection

