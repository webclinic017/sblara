
<form role="form" action="/portfolio" method="post">
    {{csrf_field()}}

                <div class="row">
                <input type="hidden" name="portfolioId" value="{{$portfolio->id or ''}}">
                    <div class="col-md-4">
                       <div class="form-group form-md-line-input has-success form-md-floating-label">
                           <div class="input-icon right">
                               <input class="form-control edited" type="text"  value="{{$portfolio->portfolio_name or ''}}" required="" name="name">
                               <label for="form_control_1">Portfolio name</label>
                               <span class="help-block">Your portfolio name...</span>
                               <i class="icon-briefcase"></i>
                           </div>
                       </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input has-success form-md-floating-label">
                            <div class="input-icon right">
                                <input class="form-control edited" type="text"  name="cash_amount" value="{{$portfolio->cash_amount or 0}}">
                                <label for="form_control_1">Cash</label>
                                <span class="help-block">If you don't add any cash, your total cash will be negative when purchase share</span>
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input has-success form-md-floating-label">
                            <div class="input-icon right">
                                <input class="form-control edited" type="text"  name="broker_fee" value="{{$portfolio->broker_fee or 0}}" >
                                <label for="form_control_1">Commission</label>
                                <span class="help-block">default broker commission for this portfolio</span>
                                <i class="fa fa-scissors"></i>
                            </div>
                        </div>
                    </div>
                </div>



{{--    <div class="form-group form-md-line-input">
        <div class="input-group">
            <div class="input-group-control">
                <input type="text" class="form-control" value="{{$portfolio->portfolio_name or ''}}" required="" name="name">
                <label for="form_control_1">Portfolio Name</label>
            </div>
            <span class="input-group-btn btn-right">
                <button type="submit" class="btn blue">Save</button>
            </span>
        </div>
    </div>--}}

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
                @if($portfolio)
                @each('portfolio.transaction_item',$transactions,'transaction')
                @endif
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
</form>
<script>
   $(".portfolio_date").datepicker({
               format: 'yyyy-mm-dd'
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
</script>