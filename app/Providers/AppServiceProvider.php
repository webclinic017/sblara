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

        // if(request()->getClientIp() == "202.125.72.110"){
        //     dump(config('app.debug'));
        //     config(['app.debug' => false]);
        //     dd(config('app.debug'));

        //     // dd(request()->getClientIp());
        // }
        view()->composer('block.market_index', function($view) {
            $view->with('dsex', 777);
        });

        View::composer('html.breadcrumbs', 'App\Http\ViewComposers\BreadcrumbMaker');
        View::composer('html.instrument_list_bs_select', 'App\Http\ViewComposers\InstrumentListBsSelect');
        View::composer('html.instrument_list_bs_select_with_sector', 'App\Http\ViewComposers\InstrumentListBsSelectWithSector');
        View::composer('block.index_chart', 'App\Http\ViewComposers\IndexChart');
        View::composer('block.dsex_chart', 'App\Http\ViewComposers\DsexChart');
        View::composer('block.index_chart2', 'App\Http\ViewComposers\IndexChart');
        View::composer('block.index_mover', 'App\Http\ViewComposers\IndexMover');

        View::composer('block.market_radar', 'App\Http\ViewComposers\MarketRadar');
        View::composer('block.market_radar2', 'App\Http\ViewComposers\MarketRadar2');
        View::composer('block.market_radar_paidup', 'App\Http\ViewComposers\MarketRadarPaidup');
        View::composer('block.market_radar_share_price', 'App\Http\ViewComposers\MarketRadarSharePrice');
        View::composer('block.market_radar_public_holdings', 'App\Http\ViewComposers\MarketRadarPublicHoldings');
        View::composer('block.market_radar_director_holdings', 'App\Http\ViewComposers\MarketRadarDirectorHoldings');
        View::composer('block.market_radar_institute_holdings', 'App\Http\ViewComposers\MarketRadarInstituteHoldings');
        View::composer('block.market_radar_pe', 'App\Http\ViewComposers\MarketRadarPe');
        View::composer('block.market_radar_category', 'App\Http\ViewComposers\MarketRadarCategory');

        View::composer('block.dividend_yield_and_payout_ratio', 'App\Http\ViewComposers\DividendYieldAndPayoutRatio');
        View::composer('block.home_page_index', 'App\Http\ViewComposers\HomePageIndexChart');
        View::composer('block.market_summary', 'App\Http\ViewComposers\MarketSummary');
        View::composer('block.up_down_single_chart', 'App\Http\ViewComposers\UpDownSingleChart');
        View::composer('block.projected_trade_chart', 'App\Http\ViewComposers\ProjectedTradeChart');
        View::composer('block.up_down_chart', 'App\Http\ViewComposers\UpDownChart');
        View::composer('block.top_sectors', 'App\Http\ViewComposers\TopSectors');
        View::composer('block.sector_gainer_loser', 'App\Http\ViewComposers\SectorGainerLoser');
        View::composer('block.sector_gainer_loser_last_minute', 'App\Http\ViewComposers\SectorGainerLoserLastMinute');
        View::composer('block.sectorwise-share-price-list-dse', 'App\Http\ViewComposers\SectorWiseSharePriceListDse');

        View::composer('block.category_pe', 'App\Http\ViewComposers\CategoryPE');
        View::composer('block.sector_pe', 'App\Http\ViewComposers\SectorPE');
        View::composer('block.sector_pe_details', 'App\Http\ViewComposers\SectorPeDetails');
        View::composer('block.sector_minute_chart', 'App\Http\ViewComposers\SectorMinuteChart');
        View::composer('block.news_chart', 'App\Http\ViewComposers\NewsChart');
        View::composer('block.recent_corporate_actions', 'App\Http\ViewComposers\CorporateActionChart');
        View::composer('block.news_time_line', 'App\Http\ViewComposers\NewsTimeLine');
        View::composer('block.news_box', 'App\Http\ViewComposers\NewsBox');
        View::composer('block.news_box_today', 'App\Http\ViewComposers\NewsBoxToday');
        View::composer('block.dsb_news', 'App\Http\ViewComposers\DsbNews');

        View::composer('block.trade_activity', 'App\Http\ViewComposers\TradeActivity');
        View::composer('block.trade_stats', 'App\Http\ViewComposers\TradeStats');
        View::composer('block.yearly_high_low', 'App\Http\ViewComposers\YearlyHighLow');
        View::composer('block.fundamental_summary', 'App\Http\ViewComposers\FundamentalSummary');
        View::composer('block.dividend_history', 'App\Http\ViewComposers\DividendHistory');
        View::composer('block.share_holdings_chart', 'App\Http\ViewComposers\ShareHoldingsChart');
        View::composer('block.dividend_possible', 'App\Http\ViewComposers\DividendPossible');
        View::composer('block.share_holdings_history_chart', 'App\Http\ViewComposers\ShareHoldingsHistoryChart');
        View::composer('block.eps_history_chart_quarter_to_quarter', 'App\Http\ViewComposers\EpsHistoryChartQuarterToQuarter');
        View::composer('block.eps_history_chart_up_to_quarter', 'App\Http\ViewComposers\EpsHistoryChartUpToQuarter');
        View::composer('block.yearly_nav', 'App\Http\ViewComposers\YearlyNav');
        View::composer('block.yearly_eps', 'App\Http\ViewComposers\YearlyEps');

        View::composer('block.market_frame_by_gainer_lose', 'App\Http\ViewComposers\MarketFrameGainerLoser');
        View::composer('block.market_frame_old_site', 'App\Http\ViewComposers\MarketFrameOldSite');
        View::composer('block.price_tree', 'App\Http\ViewComposers\PriceTree');
        View::composer('block.market_composition_table', 'App\Http\ViewComposers\MarketCompositionTable');
        View::composer('block.market_composition_pie', 'App\Http\ViewComposers\MarketCompositionPie');
        View::composer('block.market_composition_bar_total', 'App\Http\ViewComposers\MarketCompositionBarTotal');
        View::composer('block.market_composition_bar_per', 'App\Http\ViewComposers\MarketCompositionBarPer');
        View::composer('block.intraday_market_composition_bar_per', 'App\Http\ViewComposers\IntradayMarketCompositionBarPer');
        View::composer('block.gain_loser_depth', 'App\Http\ViewComposers\GainerLoserDepth');
        View::composer('block.sector_gain_loser_column', 'App\Http\ViewComposers\SectorGainerLoserColumn');

        View::composer('block.minute_chart', 'App\Http\ViewComposers\MinuteChart');
        View::composer('block.market_depth_single', 'App\Http\ViewComposers\MarketDepth');

        View::composer('block.significant_movement_value', 'App\Http\ViewComposers\SignificantMovementValue');
        View::composer('block.significant_movement_trade', 'App\Http\ViewComposers\SignificantMovementTrade');
        View::composer('block.top_by_no_of_trades', 'App\Http\ViewComposers\TopByNoOfTrades');
        View::composer('block.top_by_trade_value', 'App\Http\ViewComposers\TopByTradeValue');
        View::composer('block.top_by_big_buyer', 'App\Http\ViewComposers\TopByBigBuyer');
        View::composer('block.top_by_price_change', 'App\Http\ViewComposers\TopByPriceChange');
        View::composer('block.top_by_price_change_per', 'App\Http\ViewComposers\TopByPriceChangePer');
        View::composer('block.company_list_table', 'App\Http\ViewComposers\CompanyListTable');

        View::composer('block.advance_chart', 'App\Http\ViewComposers\AdvanceChart');
        View::composer('block.monitor_chart', 'App\Http\ViewComposers\MonitorChart');

        View::composer('portfolio.create_transaction_item', 'App\Http\ViewComposers\CreateTransactionItem');
        View::composer('portfolio.transaction_item', 'App\Http\ViewComposers\TransactionItem');
        View::composer('portfolio.performance_item', 'App\Http\ViewComposers\PerformanceItem');
        View::composer('portfolio.portfolio_card', 'App\Http\ViewComposers\PortfolioCard');

        // Contests View
        View::composer('contests.block.index', 'App\Http\ViewComposers\ContestsView@index');
        // MyContests View
        View::composer('my_contests.block.index', 'App\Http\ViewComposers\MyContestsView@index');
        // Competitors View
        // View::composer('my_contests.block.competitor', 'App\Http\ViewComposers\MyContestsView@competitor');
        // Test
        // View::composer('contest_portfolio_shares.show', 'App\Http\ViewComposers\ContestPortfolioSharesView');
         View::composer('block.newspaper_news', 'App\Http\ViewComposers\NewspaperNews');
         View::composer('block.contest', 'App\Http\ViewComposers\Contest');
         View::composer('block.course', 'App\Http\ViewComposers\Course');
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
