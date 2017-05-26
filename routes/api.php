<?php

use App\Repositories\DataBankEodRepository;
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


Route::get('/test', function () {
    return $data = DataBankEodRepository::getEodDataAsc(12,'2016-06-01','2017-04-01');
    // Access token has both "check-status" and "place-orders" scopes...
})->middleware(['auth:api', 'scopes:paid-plugin-data']);


