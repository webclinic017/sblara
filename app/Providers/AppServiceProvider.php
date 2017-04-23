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

        View::composer(
                'block.index_chart', 'App\Http\ViewComposers\IndexChart'
        );

        View::composer(
                'block.market_summary', 'App\Http\ViewComposers\MarketSummary'
        );

        View::composer(
                'block.significant_movement', 'App\Http\ViewComposers\SignificantMovement'
        );
        View::composer(
                'portfolio.create_transaction_item', 'App\Http\ViewComposers\CreateTransactionItem'
        );


        View::composer(
            'block.monitor_chart', 'App\Http\ViewComposers\MonitorChart'
        );


        View::composer('portfolio.transaction_item', 'App\Http\ViewComposers\TransactionItem');
        View::composer('portfolio.performance_item', 'App\Http\ViewComposers\PerformanceItem');
        View::composer('portfolio.performance_total_item', 'App\Http\ViewComposers\PerformanceTotalItem');
        View::composer('portfolio.gain_loss_item', 'App\Http\ViewComposers\GainLossItem');

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
