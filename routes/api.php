<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'MyApiLoginController@login');

/*Route::middleware('auth:api')->get('/test', function (Request $request) {
    return $data = DataBankEodRepository::getEodDataAsc(12,'2016-06-01','2017-04-01');
});*/


// Route::get('/test', function () {
//     return $data = DataBankEodRepository::getEodDataAsc(12, '2016-06-01', '2017-04-01');
//     // Access token has both "check-status" and "place-orders" scopes...
// })->middleware(['auth:api', 'scopes:paid-plugin-data']);


Route::get('symbol_list/', "ApiController@symbol_list")->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('eod_data/{from}/{to}/{instrument_code}/{adjusted?}', "ApiController@eod_data")->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('eod_data_all/{from}/{to}/{adjusted?}/{instrument_codes?}', "ApiController@eod_data_all")->middleware(['auth:api', 'scopes:paid-plugin-data']);

//$tradeDate=2017-05-29
Route::get('intraday_data/{minute?}/{tradeDate?}/{instrument_code?}', "ApiController@intraday_data")->middleware(['auth:api', 'scopes:paid-plugin-data']);


Route::get('intraday_data_lastday/{last_update_time?}/{instrument_code?}/', "ApiController@intraday_data_lastday")->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('fundamental_data/{instrument_code?}/', "ApiController@fundamental_data")->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('plugin_user_stats/{username}/{hdd}/{cpu}/', "ApiController@plugin_user_stats")->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('trade_date_info/{date}', "ApiController@trade_date_info")->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('intraday_live/{code}', "ApiController@intraday_live")->middleware(['auth:api', 'scopes:paid-plugin-data']);
