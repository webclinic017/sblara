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