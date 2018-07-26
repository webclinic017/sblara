<?php
Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/dse/stock/{instrument}/{name}/chart/technical-analysis', 'ChartController@index')->name('ta-chart-new')->middleware('httpcache'); // ta-chart

Route::get('/dse/stock/{instrument}/{name}/chart/advance-technical-analysis/{layout?}', 'TradingViewController@chart')->name('advance-ta-chart')->middleware('httpcache'); // advance-ta-chart

Route::get('/dse/stock/{instrument}/{name}/chart/minute-chart', 'PagesController@minuteChart')->name('minute-chart')->middleware('httpcache'); // minute -chart

Route::get('/dse/stock/{instrument}/{name}/chart/news-chart', 'PagesController@newsChart')->name('news-chart')->middleware('httpcache');  //news chart

Route::get('/dse/stock/{instrument}/{name}/fundamental/details', 'PagesController@fundamentalDetails')->name('fundamental-details')->middleware('httpcache');  // fundamental details

Route::get('/dse/stock/{instrument}/{name}/trade/details', 'PagesController@tradeDetails')->name('trade-details')->middleware('httpcache');  // trade details

// Route::get('/dse/stock/{instrument}/{name}/news/search', 'NewsController@newsSearch')->name('news-search')->middleware('httpcache');  // trade details



// Route::get('/dse/stock/ACI/advance-chemical-industries/technical/details', 'controller@action')->name('/DSE/ACI/company-details'); // technical details

// Route::get('/dse/stock/ACI/advance-chemical-industries/news/market-announcement', 'controller@action')->name('/DSE/ACI/company-details'); 
// 
// Route::get('/dse/stock/ACI/advance-chemical-industries/news/search', 'controller@action')->name('/DSE/ACI/company-details');

// Route::get('/dse/sector/textile/news', 'controller@action')->name('/DSE/ACI/news');
// Route::get('/dse/sector/textile/chart/technical-analysis/', 'controller@action')->name('/DSE/ACI/news');
// Route::get('/dse/sector/textile/chart/minute-chart/', 'controller@action')->name('/DSE/ACI/news');

// Route::get('/dse/market/monitor', 'controller@action')->name('/DSE/ACI/news');
// Route::get('/dse/market/share/price/list', 'controller@action')->name('/DSE/ACI/news');
// Route::get('/dse/market/share/price/table', 'controller@action')->name('/DSE/ACI/news');
// Route::get('/dse/market/share/price/data-matrix', 'controller@action')->name('/DSE/ACI/news');



//========================  Contest Start  ======================== 
// Contest Portfolio Shares routes..
Route::post('/portfolios/{portfolio}/shares/create', 'PortfolioSharesController@store')->name('portfolios.shares.store');
Route::get('/portfolios/{portfolio}/shares/create', 'PortfolioSharesController@create')->name('portfolios.shares.create');
Route::get('/portfolios/{portfolio}/shares/edit', 'PortfolioSharesController@edit')->name('portfolios.shares.edit');
// Contest Portfolio routes..
Route::get('/contests/portfolios/{portfolio}', 'ContestPortfoliosController@show')->name('contests.portfolios.show');
// My Contests Update Statuses routes..
Route::patch('/mycontests/{contest}/approve/{user}', 'MyContestStatusesController@approve')->name('mycontests.approve.user');
Route::patch('/mycontests/{contest}/disapprove/{user}', 'MyContestStatusesController@disapprove')->name('mycontests.disapprove.user');
Route::patch('/mycontests/{contest}/block', 'MyContestStatusesController@block')->name('mycontests.block');
Route::patch('/mycontests/{contest}/unblock', 'MyContestStatusesController@unblock')->name('mycontests.unblock');
// Join Contest routes..
Route::match(['get', 'post'], '/contests/{contest}/join', 'JoinContestsController@store')->name('contests.join');
// My Contests routes..
Route::resource('/mycontests', 'MyContestsController');
Route::get('/mycontests', 'MyContestsController@index')->name('mycontests');
// Contests routes..
Route::resource('/contests', 'ContestsController');
Route::get('/contests', 'ContestsController@index')->name('contests');
//========================  Contest End  ======================== 

// User routes
Route::get('user-information', 'UserController@userInformationChange')->name('user-information')->middleware(['auth']);
Route::get('user-name-change', 'UserController@userNameChange')->name('user-name-change');
Route::get('user-password-change', 'UserController@passwordChange')->name('user-password-change');

// Image routes
Route::post('change-image', 'ImageController@changeImage')->name('change-image');


Route::get('/passport', 'Passport\PassportController@show');

//Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout'); //Just added to fix issue. By default logout is post
// filter
Route::get('/filter', 'FilterController@index');
Route::post('/filter', 'FilterController@filter');
Route::post('/save_filter', 'FilterController@save_filter');
Route::post('/screeners/new', 'ScreenerController@save')->name('save-screeners')->middleware('auth');
Route::post('/screeners/{id}/update', 'ScreenerController@update')->name('update-screeners')->middleware('auth');
Route::get('/screeners/new', 'ScreenerController@create')->name('new-screener');
Route::get('/screeners/result', 'ScreenerController@result')->name('new-screener');
Route::get('/screeners/{slug?}', 'ScreenerController@show')->name('screeners');


//
// Route to courses
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::resource('/courses', 'CoursesController');//->middleware('admin');
    Route::get('/plugin-requests', 'PluginController@requests');//->middleware('admin');
    Route::resource('/categories_course', 'CourseCategoriesController');//->middleware('auth');;
    Route::resource('/venues_course', 'CourseVenuesController');//->middleware('admin');
    Route::resource('/participants_course', 'CourseParticipantsController');//->middleware('admin');
    Route::resource('/facilitators_course', 'CourseFacilitatorsController');//->middleware('admin');

    Route::resource('/batch_transfer', 'BatchTransferController');//->middleware('admin');

    Route::get('participant_payment/{id}', ['as' => 'participant_payment.index', 'uses' => 'CoursePaymentsController@index']);
    Route::get('participant_payment/create/{id}', ['as' => 'participant_payment.create', 'uses' => 'CoursePaymentsController@create']);
    Route::post('participant_payment/store', ['as' => 'participant_payment.store', 'uses' => 'CoursePaymentsController@store']);
    //Route::resource('/participant_payment', 'CoursePaymentsController', ['except' => ['index']]);//->middleware('admin');
});

Route::get('/courses-avaliable', 'UserParticipantsController@index')->name('courses-avaliable');
Route::get('/courses/upcoming-courses', 'UserParticipantsController@index')->name('/courses/upcoming-courses');
Route::get('courses-avaliable', function () {
    return Redirect::to('/courses/upcoming-courses', 301);
});


Route::get('/courses/technical-analysis', 'UserParticipantsController@home')->name('/courses/technical-analysis');
Route::get('/courses/technical-analysis/basic-technical-analysis', 'UserParticipantsController@basic_technical_analysis')->name('/courses/technical-analysis/basic-technical-analysis');
Route::get('/courses/technical-analysis/executive-technical-analysis', 'UserParticipantsController@executive_technical_analysis')->name('/courses/technical-analysis/executive-technical-analysis');
Route::get('/courses/technical-analysis/free-technical-analysis-course', 'UserParticipantsController@free_technical_analysis')->name('/courses/technical-analysis/free-technical-analysis-course');
Route::get('/courses/technical-analysis/advance-technical-analysis-course', 'UserParticipantsController@advance_technical_analysis')->name('/courses/technical-analysis/advance-technical-analysis-course');
Route::get('/courses/technical-analysis/advance-usage-of-amibroker', 'UserParticipantsController@advance_usage_of_amibroker')->name('/courses/technical-analysis/advance-usage-of-amibroker');
Route::get('/courses/technical-analysis/mechanical-trading-method', 'UserParticipantsController@mechanical_trading_method')->name('/courses/technical-analysis/mechanical-trading-method');

Route::get('/courses/fundamental-analysis/basic-fundamental-analysis', 'UserParticipantsController@basic_fundamental_analysis')->name('/courses/fundamental-analysis/basic-fundamental-analysis');
Route::get('/courses/fundamental-analysis/business-and-financial-modeling', 'UserParticipantsController@business_and_financial_modeling')->name('/courses/fundamental-analysis/business-and-financial-modeling');
Route::get('/courses/fundamental-analysis/risk-management', 'UserParticipantsController@risk_management')->name('/courses/fundamental-analysis/risk-management');
Route::get('/courses/fundamental-analysis/standard-financial-reporting-with-useful-tips', 'UserParticipantsController@standard_financial_reporting_with_useful_tips')->name('/courses/fundamental-analysis/standard-financial-reporting-with-useful-tips');

Route::resource('/batches', 'CourseManageController')->middleware('admin');


Route::get('/courses/upcoming-courses/batches/{id}', 'CourseManageController@batch_details');
/*Route::get('/courses/upcoming-courses/batches/{id}', 'CourseManageController@batch_details');*/
//Route::get('/courses/upcoming-courses/batches/{id}', 'CourseManageController@show');
/*
Route::get('batches/{id}', function () {
    return Redirect::to('/courses/upcoming-courses/batches/{id}', 301);
});*/


Route::get('/registration/{id}', 'UserParticipantsController@create')->name('registration.create');
Route::post('/registration', 'UserParticipantsController@store')->name('registration.store');

//Route::get('/mail', 'MailController@index');

Route::get('mail', function () {
    return view('mail');
});

//Route::post('/categories_course', 'CourseCategoriesController@store')->name('qwer');

Route::get('my-page', function () {
    return Response::make('Hello!')->setTtl(60); // Cache 1 minute
});


Route::get('head', function () {
    return response()->view('includes.metronic.head')->setTtl(60);
});

/*Route::get('/', function () {
    return response()->view('dashboard')->setTtl(60);
})->name('/');*/

Route::get('/test', function () {

    return view('test', ['instrument_id' => 79]);
});


Route::get('/dashboardnew', function () {

    return view('dashboard_new');
});


Route::post('/watchlist/create', 'WatchlistController@create')->middleware('auth');
Route::get('/watchlist/rename', 'WatchlistController@rename')->middleware('auth');
Route::get('/watchlist/delete', 'WatchlistController@delete')->middleware('auth');
Route::get('/watchlist/remove', 'WatchlistController@remove')->middleware('auth');
Route::post('/watchlist/{id}/add', 'WatchlistController@addItem')->middleware('auth');
Route::get('/watchlist/addtomultiple', 'WatchlistController@addMultiple')->middleware('auth');
Route::get('/tv', 'TradingViewController@chart');
Route::get('/tv/tab/{tab}', 'TradingViewController@tab');
Route::any('/se', 'seController@index');
Route::any('/price-board', 'PriceBoardController@index')->name('price-board');
Route::get('/setest', 'seController@test');
Route::get('/download', 'DownloadController@index')->name('download');
Route::post('/download', 'DownloadController@download');
Route::get('/pluginEod', function () {
    return response()->download(storage_path() . '/app/plugin/eod.zip');
});

Route::get('/pluginAdjustedEod', function () {
    return response()->download(storage_path() . '/app/plugin/adjusted_eod.zip');
});


Route::get('/pluginIntra', function () {
    return response()->download(storage_path() . '/app/plugin/intra.zip');
});

Route::get('/pluginResources', function () {
    return response()->download(storage_path() . '/app/plugin/resources.zip');
});


Route::get('/plugin-installer-win7and8', function () {
    return response()->download(storage_path() . '/app/plugin/StockBangladeshPlugin-Win7-8.zip');
});


Route::get('/plugin-installer-win10', function () {
    return response()->download(storage_path() . '/app/plugin/StockBangladeshPlugin-Win10.zip');
});


Route::get('/pluginIntra2', function () {
    return response()->download(storage_path() . '/app/plugin/intra_data_test.txt');
});


Route::get('/data', 'PagesController@data')->name('/data');
Route::get('/d', 'PagesController@dashboard2')->name('/dashboard2')->middleware('httpcache');
Route::get('/', 'PagesController@dashboard')->name('home')->middleware('httpcache');
Route::get('/home', function () {
    return redirect('/');
});

// Route::get('/dse-price-list', function () {
//         // return view('company_list_page');
//     })->name('dse-price-list');

Route::get('/dse-price-list', 'TableController@index')->name('dse-price-list');

Route::get('/market-depth', function () {
        return view('market_depth_page');
    })->name('market-depth');
Route::get('/data-matrix', function () {
        return view('data_matrix_page');
    })->name('data-matrix');

Route::get('/watch-matrix', function () {
        return view('watch_matrix');
    })->name('watch-matrix');

Route::get('/price-matrix', function () {
        return view('price_matrix_page');
    })->name('price-matrix');
Route::get('/market-frame', function () {
        return view('market_frame_page');
    })->name('market-frame');
Route::get('/market-composition', function () {
        return view('market_composition_page');
    })->name('market-composition');
Route::get('/sector-pe', function () {
        return view('sector_pe_page');
    })->name('sector-pe');
Route::get('/sector-minute-chart', function () {
        return view('sector-minute-chart-page');
    })->name('sector-minute-chart');
Route::get('/category-pe', function () {
        return view('category_pe_page');
    })->name('category-pe');

Route::get('/dividend-yield-payout-ratio', function () {
        return view('dividend-yield-payout-ratio-page');
    })->name('dividend-yield-payout-ratio');

Route::get('/share-market-in-islam', function () {
        return view('share-market-in-islam');
    })->name('share-market-in-islam');

Route::get('/dse/stock/candlestick-pattern', function () {
        return view('candlestick-pattern');
    })->name('/dse/stock/candlestick-pattern');

Route::get('/cockpit', function () {
        return view('cockpit_page');
    })->name('cockpit');

Route::get('news-chart/{instrument_id?}', 'PagesController@newsChartRedirect');
Route::get('minute-chart/{instrument_id?}', 'PagesController@redirectMinuteChart')->middleware('httpcache'); //httpcache implemented in PagesController@minuteChart
Route::get('company-details/{instrument_id?}', 'PagesController@tradeDetailsRedirect');

//https://stockbangladesh.com/company-details/displayCompany.php?name=FIRSTFIN
Route::get('/company-details/displayCompany.php', function () {
    return Redirect::to('/company-details', 301);
});


Route::get('fundamental-details/{instrument_id?}', 'PagesController@fundamentalDetailsRedirect')/*->middleware('httpcache')*/;
Route::get('technical-analysis-home', 'PagesController@technicalAnalysisHome')->name('technical-analysis-home')/*->middleware('httpcache')*/;


Route::get('/advance-ta-chart', 'AdvanceChartController@redirect');
Route::post('/advance-ta-chart/snapshot', 'TradingViewController@snapshot');

Route::get('/java-chart', 'DataBanksEodController@java_chart')->name('java-chart');
Route::get('/ta/ajax/{reportrange?}/{instrument?}/{comparewith?}/{Indicators?}/{configure?}/{charttype?}/{overlay?}/{mov1?}/{avgPeriod1?}/{mov2?}/{avgPeriod2?}/{adj?}/{interval?}', 'DataBanksEodController@chart_img_trac');
Route::get('/ta-chart', 'ChartController@redirect')->name('ta-chart');
Route::get('/ta-chart-img', 'ChartController@taChartImg')->name('ta-chart-img')->middleware('httpcache');
Route::get('/getchart/{img}', 'DataBanksEodController@getchart');

Route::get('/storage/chartimages/{image}', 'TradingViewController@share');
Route::get('/dd', 'TestController@funtest');
Route::get('/monitor', function () {
        return view('monitor');
    })->name('monitor');

Route::get('/ajax/monitor/{inst_id}/{period}/{day_before?}', 'AjaxController@monitor')->name('Ajax.Monitor')->middleware('httpcache');
Route::get('/ajax/yDay/{inst_id}/{period}', 'AjaxController@yDay')->name('Ajax.yDay');

Route::get('/ajax/market/{inst_id}', 'AjaxController@market')->name('Ajax.Market');
Route::get('/ajax/marketDepthData/{inst_id}', 'AjaxController@marketDepthData')->name('Ajax.MarketDepthData');
Route::any('/monitor/save_data', 'AjaxController@saveData')->name('Ajax.saveData')->middleware('auth');

Route::get('/ajax/data_matrix', 'AjaxController@data_matrix')->name('Ajax.data_matrix');
Route::get('/ajax/watch_matrix', 'AjaxController@watch_matrix')->name('Ajax.watch_matrix');

Route::get('/ajax/price_matrix_data', 'AjaxController@price_matrix_data')->name('Ajax.price_matrix_data');
Route::get('/ajax/load_block/{param}', 'AjaxController@load_block')->name('Ajax.load_block')->middleware('httpcache'); //example: /ajax/load_block/bock_name=block.minute_chart:instrument_id=13

Route::get('/tooltip_chart/{instrumentId}', 'DataBanksEodController@tooltip_chart')->name('tooltip_chart');
Route::get('/price-scale-chart/{high}/{low}/{close}/{text}/', 'DataBanksEodController@price_scale_chart')->name('price-scale-chart');

//trading view
Route::get('config/', 'TradingViewController@config');
Route::get('sidebar-tree/', 'TradingViewController@tree');
Route::post('1.1/charts/', 'TradingViewController@saveLayout');
Route::delete('1.1/charts/', 'TradingViewController@delete');
Route::get('1.1/charts/', 'TradingViewController@layouts');
Route::get('1.1/charts/current', 'TradingViewController@current');

Route::get('watchlists', 'WatchlistController@listById');
Route::get('watchlists/{id}/{action}', 'WatchlistController@action');

//tradingview function
Route::get('/time', function () {
    return json_encode(time());
});

//tradingview function to get symbol details

Route::get('symbols/', 'TradingViewController@symbols');

//tradingview function to search symbol
//https://demo_feed.tradingview.com/search?limit=30&query=A&type=&exchange=
Route::get('search/', 'TradingViewController@search');
Route::get('search/{type}/{query}', 'SearchController@search');
Route::post('/feedback', 'FeedbackController@index');


//https://demo_feed.tradingview.com/history?symbol=ABB&resolution=D&from=1491726479&to=1492590479
Route::get('history/', 'TradingViewController@history')->middleware('httpcache');

Route::get('/ajax', function () {
    return 786;
});
Auth::routes();

Route::resource('/portfolio', 'PortfolioController');
Route::resource('/portfolio_transaction', 'PortfolioScripsController');
Route::post('/portfolio-setting', 'PortfolioController@portfolio_setting');
Route::get('/portfolio_diversity/{portfolio_id}', 'PortfolioController@diversity');
Route::get('/portfolio_market_summary/{portfolio_id}', 'PortfolioController@marketSummary');
Route::get('/portfolio_chart/{portfolio_id}', 'PortfolioController@portfolio_chart');
Route::get('/portfolio_fundamental/{portfolio_id}', 'PortfolioController@portfolio_fundamental');
Route::get('/diversity_model/{portfolio_id}', 'PortfolioController@diversity_model');
Route::get('/portfolio_gain_loss/{portfolio_id}', 'PortfolioController@gainLoss');
Route::get('/portfolio_performance/{portfolio_id}', 'PortfolioController@performance');

Route::get('/upload', 'PortfolioController@uploadForm');
Route::post('/upload', 'PortfolioController@uploadSubmit');

Route::post('search_json', 'SearchController@search');

/* Se Routes */
Route::get('/ipos', 'IpoController@upcoming')->name('ipos');

Route::get('/ipos/history', 'IpoController@history')->name('ipos-history');
Route::get('/ipos/results', 'IpoController@results')->name('ipos-results');
Route::post('/user/meta/store', 'UserController@storeMeta');

/* Se Routes */
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

    Route::get('/news-parser', "NewsParserController@index");
    Route::post('/news-parser', "NewsParserController@update");
    Route::get('/share-percentage-cse', "SharePercetageCseController@index");
    Route::post('/share-percentage-cse', "SharePercetageCseController@update");
    Route::get('/share-percentage-cse/update', "SharePercetageCseController@scrape");

    if(isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'admin') !== false){
          Voyager::routes();
   }
  
    Route::resource('/ipos', 'IpoController');
    Route::resource('/news', 'newspaperNewsController');
    Route::get('/data-extractors/share-percentage', 'DataExtractController@sharePercentage')->name('voyger.data-extractor.share-precentage');
    Route::get('/data-extractors/eps-parsing', 'DataExtractController@epsParsing')->name('admin.data-extract.eps-parsing');
    Route::get('/data-extractors/share-percentage-dse-import', 'DataExtractController@sharePercentageDseImport');
    Route::view('/feedbacks', 'admin.feedbacks');
});
    Route::view('/contact-us', 'contact');
/* Se Routes */


//==============================
Route::get('/tutorials/technical', 'knowledgeBasketController@index')->name('knowledge-basket');
Route::get('/collective/news', 'newspaperNewsController@collectiveNews')->name('collective-news');
Route::get('/news/search', 'NewsController@newsSearch')->name('news-search');
Route::get('/news/details/{id}', 'NewsController@viewNews');

Route::get('/latest-share-price', 'TableController@index');
Route::get('/latest-share-price/{id}/details', 'TableController@details');
Route::post('/latest-share-price/update-column', 'TableController@updateColumn');

//Route::get('/resources/amibroker-data-plugin-dse', 'ComingSoonController@index')->name('amibroker-data-plugin-dse');

Route::get('/resources/amibroker-data-plugin-dse', function () {
    if(request()->has('gid'))
    {
        if(\Auth::guest())
            {
                abort(403);
            }
        $user = \Auth::user();
        if($user->plugin_apply == request()->gid)
        {
            return "";
        }
        $user->plugin_apply = request()->gid;
        $user->name = request()->name;
        $user->contact_no = request()->mobile;

        if($user->plugin_apply == '1' && $user->group_id == '0')
        {
            $user->plugin_approved_at = \Carbon\Carbon::now();        
            $user->group_id = $user->plugin_apply;
            \Mail::to($user)->send(new \App\Mail\PluginRequestApproved());
        }

        if($user->plugin_apply != '1')
        {
            \Mail::to($user)->send(new \App\Mail\PluginRequestReceived($user));
        }

        $user->save();
        return "";
    }    
    $user = Auth::user();
    return view('amibroker-data-plugin')->with(compact(['user']));
})->name('amibroker-data-plugin-dse');

Route::get('/resources/amibrokerplugin', function () {
    return Redirect::to('/resources/amibroker-data-plugin-dse', 301);
});


//Route::get('/test/ak', 'TestController@testAK');
Route::get('/test/ak', 'SearchController@testSearch');
Route::get('/test/speed', function () {


    return view('speed');
});

Route::get('/financial-reports-list', 'DataExtractController@list_financial_reports')->name('financial-reports-list');
Route::get('/financial-reports-extract/{instrument_code}/{type}', 'DataExtractController@extract_financial_reports')->name('financial-reports-list');
Route::any('/tabledata/{id}/json', 'TableController@json');

/*old urls*/
Route::get('/resources/monitor', function ()
{
    return redirect('/monitor');
});
Route::get('/users/login', function ()
{
    return redirect('/login');
});
Route::get('/loaderio-21eda4831b3a2f606d926bec73f7f60a/', function ()
{
    echo "loaderio-21eda4831b3a2f606d926bec73f7f60a";
    exit;
    
});
/*old urls*/