@if(\Auth::guest())
<p style="padding: 10px">
Please <a href="/login">login</a> to see your portfolios.
</p>
@else
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th> Symbol </th>
            <th> Last </th>
            <th> Change </th>
        </tr>
    </thead>
    <tbody>
        @foreach(\App\Instrument::listForTvById(\App\PortfolioScrip::where('portfolio_id', request()->panel)->pluck('instrument_id')) as $instrument)
        <tr>
            <td style="color:@if($instrument->gain > 0) green @elseif($instrument->gain < 0) rgb(185, 27, 42) @else #58c3e5 @endif !important"> {{$instrument->instrument_code}} </td>
            <td style="color:@if($instrument->gain > 0) green @elseif($instrument->gain < 0) rgb(185, 27, 42) @else #58c3e5 @endif !important"> {{$instrument->close_price}} </td>
            <td style="color:@if($instrument->gain > 0) green @elseif($instrument->gain < 0) rgb(185, 27, 42) @else #58c3e5 @endif !important" > {{$instrument->gain}}% </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
