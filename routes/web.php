<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/test', function () {
    return view('test');
});

//trading view
Route::get('/config', function () {
    return '{"supports_search":true,"supports_group_request":false,"supports_marks":true,"supports_timescale_marks":true,"supports_time":true,"exchanges":[{"value":"","name":"All Exchanges","desc":""},{"value":"XETRA","name":"XETRA","desc":"XETRA"},{"value":"NSE","name":"NSE","desc":"NSE"},{"value":"NasdaqNM","name":"NasdaqNM","desc":"NasdaqNM"},{"value":"NYSE","name":"NYSE","desc":"NYSE"},{"value":"CDNX","name":"CDNX","desc":"CDNX"},{"value":"Stuttgart","name":"Stuttgart","desc":"Stuttgart"}],"symbolsTypes":[{"name":"All types","value":""},{"name":"Stock","value":"stock"},{"name":"Index","value":"index"}],"supportedResolutions":["D","2D","3D","W","3W","M","6M"]}';
});

Route::get('/time', function () {
    return time();
});

//tradingview function to get symbol details
https://demo_feed.tradingview.com/symbols?symbol=AAPL
Route::get('symbols/', 'TradingViewController@symbols');

//tradingview function to search symbol
//https://demo_feed.tradingview.com/search?limit=30&query=A&type=&exchange=
Route::get('search/', 'TradingViewController@search');


//https://demo_feed.tradingview.com/history?symbol=ABB&resolution=D&from=1491726479&to=1492590479
Route::get('history/', 'TradingViewController@history');

Route::get('/ajax', function () {
    return 786;
});
Auth::routes();

Route::get('/home', 'HomeController@index');


