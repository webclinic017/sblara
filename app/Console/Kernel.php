<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Market;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\PluginEodDataWriteCommand::class,
        Commands\PluginEodDataResetCommand::class,
        Commands\PluginAdjustedEodDataResetCommand::class,
        Commands\PluginIntradayDataResetCommand::class,
        Commands\PluginIntradayDataWriteCommand::class,

        Commands\EodIntradayTradeCommand::class,
        Commands\EodIntraFinalizeCommand::class,
        Commands\TradeDataCommand::class,
        Commands\UpdateDseNewsCommand::class,
        Commands\UpdateDseIndexCommand::class,
        Commands\ParseMstCommand::class,


        Commands\GenerateCustomIndexCommand::class,
        Commands\CalculateSectorIntradayCommand::class,

        Commands\RemoveDuplicateEodCommand::class,
        Commands\FundamentalLatestIdCommand::class,
        Commands\Import::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('plugin:resetEod')->dailyAt('16:00')->emailOutputTo('fazalmohammad19@gmail.com');
        //$schedule->command('plugin:resetIntra')->dailyAt('17:00')->emailOutputTo('fazalmohammad19@gmail.com');
        $schedule->command('plugin:resetAdjustedEod')->dailyAt('16:45')->emailOutputTo('fazalmohammad19@gmail.com');

       /*$schedule->command('index:generateCustomIndex')->cron('* 10,11,12,13,14 * * 0,1,2,3,4')->when(function () {
            return Market::isMarketOpen();
        })->emailOutputTo('fazalmohammad19@gmail.com');*/

        $schedule->command('dse:EodIntradayTrade')->cron('* 10,11,12,13,14 * * 0,1,2,3,4')->emailOutputTo('fazalmohammad19@gmail.com');
        $schedule->command('dse:UpdateDseNews')->cron('2,7,12,17,22,27,32,37,42,47,52,57 10,11,12,13,14,15,16 * * 0,1,2,3,4');
        $schedule->command('dse:UpdateDseIndex')->cron('* 10,11,12,13,14 * * 0,1,2,3,4');
        $schedule->command('dse:ParseMst')->cron('30 16 * * 0,1,2,3,4')->emailOutputTo('fazalmohammad19@gmail.com');
        $schedule->command('dse:EodIntraFinalize')->cron('15 16,18,20,22 * * 0,1,2,3,4')->emailOutputTo('fazalmohammad19@gmail.com');

        $schedule->command('dse:CalculateSectorIntraday')->cron('* 10,11,12,13,14 * * 0,1,2,3,4')->emailOutputTo('fazalmohammad19@gmail.com');

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
