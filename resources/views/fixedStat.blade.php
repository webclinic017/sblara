@php
$index = \Cache::remember("fixed_stat_index", 1, function ()
		{
			return \App\Market::indexValue();
		});

$up = \Cache::remember("fixed_stat_up", 1, function ()
		{
			return  \App\Market::upCount();
		});

$down = \Cache::remember("fixed_stat_down", 1, function ()
		{
			return  \App\Market::downCount();
		});
$trade = \Cache::remember("fixed_stat_trade", 1, function ()
		{
			return  \App\Market::totalTrade();
		});
$value = \Cache::remember("fixed_stat_value", 1, function ()
		{
			return  \App\Market::totalValue();
		});
@endphp
<div class="fixedStat" style="text-align: center;">
	<ul style="text-align: center; display: inline-block;">
		<li style="color: @if($index->percentage_deviation < 0)red @else #009d7c @endif; min-width: 130px">
			<div style="line-height: 25px"><strong>DSEX<i class="fa @if($index->percentage_deviation < 0) fa-caret-down @else fa-caret-up @endif"></i>{{number_format($index->percentage_deviation, 2)}}%</strong></div>
			<div style="line-height: 25px"><strong>{{number_format($index->capital_value, 0, '.', ',')}}</strong></div>
		</li>
		<li >
			<div style="line-height: 25px; color: #009dc7; text-align: left;"><strong><i class="fa fa-caret-up"></i>{{$up}}</strong></div>
			<div style="line-height: 25px;  color: red; text-align: left;"><strong><i class="fa fa-caret-down"></i>{{$down}}</strong></div>
		</li>
		<li style="color: @if($index->percentage_deviation < 0)red @else #009d7c @endif;">
			<div style="line-height: 25px"><strong>Trade</strong></div>
			<div style="line-height: 25px"><strong>{{number_format($trade, 0, '.', ',')}}</strong></div>
		</li>
		<li style="color: @if($index->percentage_deviation < 0)red @else #009d7c @endif;; min-width: 90px">
			<div style="line-height: 25px"><strong>Value</strong><small> (m)</small></div>
			<div style="line-height: 25px"><strong>{{number_format($value, 2, '.', ',')}}</strong></div>
		</li>
	</ul>
</div>