<?php

use App\Repositories\DataBankEodRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\InstrumentRepository;
use App\Repositories\FundamentalRepository;
use Illuminate\Http\Request;

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


Route::get('symbol_list/', function () {
    $data = InstrumentRepository::getInstrumentsScripWithIndex();
    return json_encode($data, JSON_UNESCAPED_SLASHES);
})->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('eod_data/{from}/{to}/{instrument_code}/{adjusted?}', function ($from, $to, $instrument_code, $adjusted = 1) {
    $data = DataBankEodRepository::getPluginEodData($instrument_code, $from, $to, $adjusted);
    return json_encode($data, JSON_UNESCAPED_SLASHES);
})->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('eod_data_all/{from}/{to}/{adjusted?}/{instrument_codes?}', function ($from, $to, $adjusted = 1, $instrument_codes = null) {

    $instrument_code_arr = array();
    if (!is_null($instrument_codes))
        $instrument_code_arr = explode(',', $instrument_codes);

    $data = DataBankEodRepository::getPluginEodDataAll($from, $to, $adjusted, $instrument_code_arr);
    return json_encode($data, JSON_UNESCAPED_SLASHES);
})->middleware(['auth:api', 'scopes:paid-plugin-data']);

//$tradeDate=2017-05-29
Route::get('intraday_data/{minute?}/{tradeDate?}/{instrument_code?}', function ($minute = 1, $tradeDate = null, $instrument_codes = null) {

    if ($tradeDate == 'null')
        $tradeDate = null;
    $instrument_code_arr = array();
    if (!is_null($instrument_codes))
        $instrument_code_arr = explode(',', $instrument_codes);

    $data = DataBanksIntradayRepository::getIntraForPlugin($minute, $tradeDate, 1, $instrument_code_arr);
    return json_encode($data, JSON_UNESCAPED_SLASHES);
})->middleware(['auth:api', 'scopes:paid-plugin-data']);


Route::get('intraday_data_lastday/{last_update_time?}/{instrument_code?}/', function ($last_update_time = 0, $instrument_code = null) {
    $data = DataBanksIntradayRepository::getLastDayIntraForPlugin($last_update_time, $instrument_code);
    return $data;
})->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('fundamental_data/{instrument_code?}/', function ($instrument_code = null) {
    $data = FundamentalRepository::getAmibrokerFundamentalData($instrument_code);
    return $data;
    //return json_encode($data, JSON_UNESCAPED_SLASHES);
    // return count($data);
})->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('plugin_user_stats/{username}/{hdd}/{cpu}/', function ($username, $hdd, $cpu) {
    $user_info = \DB::select("select * from users where email like '$username'");
    $user_id = $user_info[0]->id;
    $ip = 'null';
    DB::table('plugin_stats')->insert(
        ['user_id' => $user_id, 'login_from_ip' => $ip, 'hdd' => $hdd, 'cpu' => $cpu]
    );
    $message['user'] = $user_info[0]->plugin_message;
    $message['user_message_color'] = '#26C281';
    $message['global'] = "Our data maintenance will go on next day ";
    $message['global_message_color'] = '#f36a5a';
    $message['eod_mode_enable'] = true;
    $message['intraday_mode_enable'] = true;
    $message['adjusted_mode_enable'] = true;
    $message['fundamental_button_enable'] = true;
    $message['resources_button_enable'] = true;

    $message['interval'] = 30;
    return json_encode($message, JSON_UNESCAPED_SLASHES);
})->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('trade_date_info/{date}', function ($date) {
    $trade_date_details = \DB::select("SELECT *  FROM `markets` WHERE `trade_date` = '$date'");
    return $trade_date_details;
})->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('intraday_live/{code}', function ($code = 'DSEX') {

    DataBanksIntradayRepository::getLiveIntraForPlugin($code);
})->middleware(['auth:api', 'scopes:paid-plugin-data']);
