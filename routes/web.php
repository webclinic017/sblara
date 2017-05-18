<?php

use App\Repositories\DataBankEodRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// My Contests Update Statuses routes..
Route::patch('/mycontests/{contest}/approve/{user}', 'MyContestStatusesController@approve')->name('mycontests.approve.user');
Route::patch('/mycontests/{contest}/block', 'MyContestStatusesController@block')->name('mycontests.block');
Route::patch('/mycontests/{contest}/unblock', 'MyContestStatusesController@unblock')->name('mycontests.unblock');
// Join Contest routes..
Route::post('/contests/{contest}/join', 'JoinContestsController@store')->name('contests.join');
// My Contests routes..
Route::resource('/mycontests', 'MyContestsController');
// Contests routes..
Route::resource('/contests', 'ContestsController');


// User routes
Route::get('user-information', 'UserController@userInformationChange')->name('user-information')->middleware('auth');
Route::get('user-name-change', 'UserController@userNameChange')->name('user-name-change');
Route::get('user-password-change', 'UserController@passwordChange')->name('user-password-change');

// Image routes
Route::post('change-image', 'ImageController@changeImage')->name('change-image');


Route::get('/passport', 'Passport\PassportController@show');

//Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout'); //Just added to fix issue. By default logout is post
Route::get('/filter', 'FilterController@index');
Route::get('/filter/debug', 'FilterController@debug');


Route::get('/parce/{save}', 'ParcerController@index');
Route::get('/parce2/{save}', 'ParcerController@index2');
Route::get('/adx/{save}', 'ParcerController@adx');
Route::get('/atr/{save}', 'ParcerController@atr');
Route::get('/volume/{save}', 'ParcerController@volume');
Route::get('/vma/{save}', 'ParcerController@vma');
Route::get('/obv/{save}', 'ParcerController@obv');
Route::get('/price_change1/{save}', 'ParcerController@price_change1');
Route::get('/price_change2/{save}', 'ParcerController@price_change2');
Route::get('/HiLo/{save}', 'ParcerController@HiLo');
Route::get('/supres/{save}', 'ParcerController@supres');

Route::get('/macd/{save}', 'ParcerController@macd');
Route::get('/bb/{save}', 'ParcerController@bb');
Route::get('/divergence/{save}', 'ParcerController@divergence');
Route::get('/candlestick/{save}', 'ParcerController@candlestick');
Route::get('/william/{save}', 'ParcerController@william');

Route::post('/filter', 'FilterController@filter');

Route::get('my-page', function(){
    return Response::make('Hello!')->setTtl(60); // Cache 1 minute
});


Route::get('head', function(){
    return response()->view('includes.metronic.head')->setTtl(60);
});

Route::get('/', function () {
    //return view('dashboard');
    return response()->view('dashboard')->setTtl(60);
})->name('/');

Route::get('/test', function () {
    return view('test');
});


Route::get('/market-depth', function () {return view('market_depth_page');})->name('market-depth');
Route::get('/market-frame', function () {return view('market_frame_page');})->name('market-frame');
Route::get('/market-composition', function () {return view('market_composition_page');})->name('market-composition');
Route::get('news-chart/{instrument_id?}', 'PagesController@newsChart')->name('news-chart');
Route::get('minute-chart/{instrument_id?}', 'PagesController@minuteChart')->name('minute-chart')->middleware('httpcache'); //httpcache implemented in PagesController@minuteChart
Route::get('company-details/{instrument_id?}', 'PagesController@companyDetails')->name('company-details')->middleware('httpcache');
Route::get('fundamental-details/{instrument_id?}', 'PagesController@fundamentalDetails')->name('fundamental-details')/*->middleware('httpcache')*/;



Route::get('/advance-ta-chart', function () {return view('ta_chart.advance_ta_chart');})->name('advance-ta-chart');
Route::get('/ta-chart', 'DataBanksEodController@panel')->name('ta-chart');
Route::get('/ta/ajax/{reportrange?}/{instrument?}/{comparewith?}/{Indicators?}/{configure?}/{charttype?}/{overlay?}/{mov1?}/{avgPeriod1?}/{mov2?}/{avgPeriod2?}/{adj?}/', 'DataBanksEodController@chart_img_trac');
Route::get('/getchart/{img}', 'DataBanksEodController@getchart');


Route::get('/dd', 'TestController@funtest');
Route::get('/monitor', function () {return view('monitor');})->name('monitor');

Route::get('/ajax/monitor/{inst_id}/{period}/{day_before?}', 'AjaxController@monitor')->name('Ajax.Monitor');
Route::get('/ajax/yDay/{inst_id}/{period}', 'AjaxController@yDay')->name('Ajax.yDay');

Route::get('/ajax/market/{inst_id}', 'AjaxController@market')->name('Ajax.Market');
Route::get('/ajax/marketDepthData/{inst_id}', 'AjaxController@marketDepthData')->name('Ajax.MarketDepthData');
Route::post('/monitor/save_data', 'AjaxController@saveData')->name('Ajax.saveData');

Route::get('/ajax/data_matrix', 'AjaxController@data_matrix')->name('Ajax.data_matrix');
Route::get('/ajax/price_matrix_data', 'AjaxController@price_matrix_data')->name('Ajax.price_matrix_data');
Route::get('/ajax/load_block/{param}', 'AjaxController@load_block')->name('Ajax.load_block')->middleware('httpcache'); //example: /ajax/load_block/bock_name=block.minute_chart:instrument_id=13


//trading view
Route::get('config/', 'TradingViewController@config');

//tradingview function
Route::get('/time', function () {
    return json_encode(time());
});

//tradingview function to get symbol details

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
Route::resource('/portfolio', 'PortfolioController');
Route::resource('/portfolio_transaction', 'PortfolioTransactionController');
Route::get('/portfolio_diversity/{portfolio_id}', 'PortfolioController@diversity');
Route::get('/portfolio_market_summary/{portfolio_id}', 'PortfolioController@marketSummary');
Route::get('/portfolio_gain_loss/{portfolio_id}', 'PortfolioController@gainLoss');
Route::get('/portfolio_performance/{portfolio_id}', 'PortfolioController@performance');
Route::post('search_json', 'SearchController@search');
