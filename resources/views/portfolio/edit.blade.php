
<form role="form" action="/portfolio" method="post">
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
</form>
<script>
    $(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
</script>