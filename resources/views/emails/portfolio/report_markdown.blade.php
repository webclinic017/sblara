@component('mail::message')
Dear Trader/Investors,

---
Here is the update of your portfolio **{{$portfolio_name}}** ({{$trade_date}})

---

@component('mail::table')
| Share         |   Qty         | Buy Price|     LTP  | Chg(today)   |
|:-------------|:-------------:|:--------:|:--------:|:------------:|
@foreach($portfolio_holdings as $row)
| {{$row->instrument_code}}|{{$row->no_of_shares}}|{{$row->buying_price}}|{{$row->close_price}}|  <span style="color:@if($row->today_change<0)red @else green @endif" >{{$row->today_change}} Tk ({{$row->today_change_per}}%)</span> |
@endforeach
@endcomponent

Today gain/loss : <span style="color:@if($total_gain_today<0)red @else green @endif" >{{$total_gain_today}} Tk</span>

##Today's market announcement of your holdings
@foreach($news as $row)
@component('mail::panel')
{{$row->instrument_code}} : {{$row->details}}
@endcomponent
@endforeach
@if(!count($news))
@component('mail::panel')
Today there is no market annoucment published related to your holdings
@endcomponent
@endif
@component('mail::button', ['url' => 'https://stockbangladesh.com/portfolio/' . $portfolio_id, 'color' => 'green'])
Check details
@endcomponent

Thanks,<br>
{{ config('app.name') }}

You are recieving this email because you have subscribed to send portfolio report. If you dont want this mail again - [unsubscribe from portfolio list](https://stockbangladesh.com/portfolio/)

Make sure our messages always go straight to your inbox.
Add info@stockbangladesh.com to your Address Book or Safe List.
@endcomponent

