<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        view()->composer('block.market_index', function($view) {
            $view->with('dsex', 777);
        });

        View::composer('html.menu', 'App\Http\ViewComposers\MenuMaker');
        View::composer('html.instrument_list_bs_select', 'App\Http\ViewComposers\InstrumentListBsSelect');
        View::composer('block.index_chart', 'App\Http\ViewComposers\IndexChart');
        View::composer('block.home_page_index', 'App\Http\ViewComposers\HomePageIndexChart');
        View::composer('block.market_summary', 'App\Http\ViewComposers\MarketSummary');
        View::composer('block.up_down', 'App\Http\ViewComposers\UpDownChart');
        View::composer('block.sector_gainer_loser', 'App\Http\ViewComposers\SectorGainerLoser');

        View::composer('block.sector_minute_chart', 'App\Http\ViewComposers\SectorMinuteChart');
        View::composer('block.news_chart', 'App\Http\ViewComposers\NewsChart');
        View::composer('block.news_time_line', 'App\Http\ViewComposers\NewsTimeLine');
        View::composer('block.news_box', 'App\Http\ViewComposers\NewsBox');
        View::composer('block.news_box_today', 'App\Http\ViewComposers\NewsBoxToday');

        View::composer('block.market_frame_by_gainer_lose', 'App\Http\ViewComposers\MarketFrameGainerLoser');
        View::composer('block.market_frame_old_site', 'App\Http\ViewComposers\MarketFrameOldSite');
        View::composer('block.price_tree', 'App\Http\ViewComposers\PriceTree');
        View::composer('block.market_composition_pie', 'App\Http\ViewComposers\MarketCompositionPie');
        View::composer('block.market_composition_bar_total', 'App\Http\ViewComposers\MarketCompositionBarTotal');
        View::composer('block.market_composition_bar_per', 'App\Http\ViewComposers\MarketCompositionBarPer');
        View::composer('block.gain_loser_depth', 'App\Http\ViewComposers\GainerLoserDepth');
        View::composer('block.sector_gain_loser_column', 'App\Http\ViewComposers\SectorGainerLoserColumn');

        View::composer('block.minute_chart', 'App\Http\ViewComposers\MinuteChart');
        View::composer('block.market_depth_single', 'App\Http\ViewComposers\MarketDepth');

        View::composer('block.significant_movement_value', 'App\Http\ViewComposers\SignificantMovementValue');
        View::composer('block.significant_movement_trade', 'App\Http\ViewComposers\SignificantMovementTrade');
        View::composer('block.top_by_price_change', 'App\Http\ViewComposers\TopByPriceChange');
        View::composer('block.top_by_price_change_per', 'App\Http\ViewComposers\TopByPriceChangePer');

        View::composer('block.advance_chart', 'App\Http\ViewComposers\AdvanceChart');
        View::composer('block.monitor_chart', 'App\Http\ViewComposers\MonitorChart');

        View::composer('portfolio.create_transaction_item', 'App\Http\ViewComposers\CreateTransactionItem');
        View::composer('portfolio.transaction_item', 'App\Http\ViewComposers\TransactionItem');
        View::composer('portfolio.performance_item', 'App\Http\ViewComposers\PerformanceItem');
        View::composer('portfolio.performance_total_item', 'App\Http\ViewComposers\PerformanceTotalItem');
        View::composer('portfolio.gain_loss_item', 'App\Http\ViewComposers\GainLossItem');

        View::composer('block.contests.index', 'App\Http\ViewComposers\Contests');
        View::composer('block.my_contests.index', 'App\Http\ViewComposers\MyContests');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
        Schema::defaultStringLength(191);
    }

}
