<?php 
Route::get("/instruments", function ()
{
	return \App\Instrument::active()->select('id', 'instrument_code')->orderBy('instrument_code', 'asc')->get();
});


Route::get("/instruments/{id}/intraday", function ($id)
{

	return \App\DataBanksIntraday::where('trade_date', lastTradeDate())->where('instrument_id', $id)->select("close_price", "yday_close_price", "high_price", "instrument_id", "low_price", "open_price", "total_trades", "total_value", "total_volume", "lm_date_time", "new_volume")->groupBy('trade_time')->get();
});

Route::get("/intraday", function ()
{
	$ids = request()->instruments;
	$ids = explode(",", $ids);

	$bstring = implode(",", array_fill(0, count($ids), "?"));
 	

	$sql = "select * from (select  distinct concat(instrument_id, lm_date_time) a, `close_price`, `yday_close_price`, `high_price`, `instrument_id`, `trade_time`, `low_price`, `open_price`, `total_trades`, `total_value`, `total_volume`, `lm_date_time`, `new_volume` from `data_banks_intradays` where `trade_date` = '".lastTradeDate()."' and `instrument_id` in (".$bstring.") order by id desc) a  group by `trade_time`, `instrument_id` ";

	$data = collect(\DB::select($sql, $ids))->groupBy('instrument_id');

	return $data;
});



