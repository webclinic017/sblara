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

	return \App\DataBanksIntraday::where('trade_date', lastTradeDate())->select("close_price", "yday_close_price", "high_price", "instrument_id", "low_price", "open_price", "total_trades", "total_value", "total_volume", "lm_date_time", "new_volume")->whereIn('instrument_id', $ids)->groupBy('trade_time')->get()->groupBy('instrument_id');
});