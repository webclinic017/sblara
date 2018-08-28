<?php

use App\Repositories\DataBankEodRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\InstrumentRepository;
use App\Repositories\FundamentalRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

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


    $data = \Cache::remember("plugin_eod_data_all". $instrument_codes.'_'.$adjusted.$from.$to, 1, function () use ($from, $to, $adjusted, $instrument_codes, $instrument_code_arr)
    {
    $data = \App\Repositories\DataBankEodRepository::getPluginEodDataAll($from, $to, $adjusted, $instrument_code_arr);
    return json_encode($data, JSON_UNESCAPED_SLASHES);

    });
    return $data;

    // $data = DataBankEodRepository::getPluginEodDataAll($from, $to, $adjusted, $instrument_code_arr);
    // return json_encode($data, JSON_UNESCAPED_SLASHES);


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

    $sql="SELECT count(DISTINCT user_id, hdd, cpu) as device_no FROM plugin_stats where user_id=$user_id";
    $device=\DB::select($sql);
    $device_no=$device[0]->device_no;


    if ($device_no > 1) {
        $message['user'] = "You are using plugin from $device_no device. Multiple device is restricted and account may be suspended";
    } else {
        $message['user'] = $user_info[0]->plugin_message;
        //$message['user'] = "You are using plugin from $device_no device";
    }
    $message['user_message_color'] = '#e43a45';


    $plugin_expired_at = $user_info[0]->plugin_expired_at;
    if (!is_null($plugin_expired_at)) {
        $plugin_expired_at = Carbon::parse($plugin_expired_at);
        $today = Carbon::today();
        $day_remaining_to_expire = $today->diffInDays($plugin_expired_at,false);
        if ($day_remaining_to_expire > 0 and $day_remaining_to_expire < 7) {
            $message['user_message_color'] = '#3598dc';
            $message['user'] = "Your current subscription will expire within $day_remaining_to_expire days. Please renew your subscription before expire. Call 01552573043 for any query";
        }
        if ($day_remaining_to_expire <0) {
            $user_info[0]->group_id = 1;
        }
        if ($day_remaining_to_expire > -7 and $day_remaining_to_expire <0) {
            $message['user_message_color'] = '#3598dc';
            $message['user'] = "Your subscription has been expired and downgraded to free version. Please renew your subscription. Call 01552573043 for any query";
        }



    }


    //$message['global'] = "Our data maintenance will go on next day -2";
    $message['global'] = null;
    $message['global_message_color'] = '#f36a5a';


    $message['eod_mode_enable'] = false;
    $message['intraday_mode_enable'] = false;
    $message['adjusted_mode_enable'] = false;
    $message['fundamental_button_enable'] = false;
    $message['resources_button_enable'] = false;
    $message['interval'] = 600;


           if($user_info[0]->group_id == 1){
                 $message['global_message_color'] = '#e43a45';
                   $message['global'] = "Due to high load unfortunately our free version of plugin is  unavailable.  Call 01552573043 for any query";
            }

    if($user_info[0]->group_id==1)
    {
        // free

        $message['eod_mode_enable'] = true;
        $message['intraday_mode_enable'] = true;
        $message['adjusted_mode_enable'] = false;
        $message['fundamental_button_enable'] = false;
        $message['resources_button_enable'] = false;
        $message['interval'] = 14000;


    }

    if($user_info[0]->group_id==2)
    {
        // paid


        $message['eod_mode_enable'] = true;
        $message['intraday_mode_enable'] = true;
        $message['adjusted_mode_enable'] = true;
        $message['fundamental_button_enable'] = false;
        $message['resources_button_enable'] = false;
        $message['interval'] = 60;
    }

    if($user_info[0]->group_id==3)
    {
        // corporate

        $message['eod_mode_enable'] = true;
        $message['intraday_mode_enable'] = true;
        $message['adjusted_mode_enable'] = true;
        $message['fundamental_button_enable'] = true;
        $message['resources_button_enable'] = true;
        $message['interval'] = 30;

    }

    if($user_info[0]->group_id==4)
    {
        // course

        $message['eod_mode_enable'] = true;
        $message['intraday_mode_enable'] = true;
        $message['adjusted_mode_enable'] = true;
        $message['fundamental_button_enable'] = true;
        $message['resources_button_enable'] = true;
        $message['interval'] = 30;

    }

    if($user_info[0]->group_id==5)
    {
        // sponsored


        $message['eod_mode_enable'] = true;
        $message['intraday_mode_enable'] = true;
        $message['adjusted_mode_enable'] = true;
        $message['fundamental_button_enable'] = true;
        $message['resources_button_enable'] = true;
        $message['interval'] = 30;

    }


    return json_encode($message, JSON_UNESCAPED_SLASHES);
})->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('trade_date_info/{date}', function ($date) {
    $trade_date_details = \DB::select("SELECT *  FROM `markets` WHERE `trade_date` = '$date'");
    return $trade_date_details;
})->middleware(['auth:api', 'scopes:paid-plugin-data']);

Route::get('intraday_live/{code}', function ($code = 'DSEX') {
// this function is not in use
    DataBanksIntradayRepository::getLiveIntraForPlugin($code);
})->middleware(['auth:api', 'scopes:paid-plugin-data']);
