<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Repositories\InstrumentRepository;
use App\Market;
use App\Repositories\FundamentalRepository;
use App\Repositories\MarketStatRepository;
use App\Repositories\IndexRepository;


class GenerateCustomIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:generateCustomIndex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculating SBDSEGEN & TRDGEN. It is used in Index mover and running corn every minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */



// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan index:generateCustomIndex
    public function handle()
    {
        $cap_equity = MarketStatRepository::getMarketStatsData(array('cap_equity'), null);
        $ob_cap_equity_today = $cap_equity->first();
        $ob_cap_equity_yesterday = $cap_equity->last();

        $index_data_yesterday = IndexRepository::getIndexDataYesterday(10, null, 0);
        $index_data_today = IndexRepository::getIndexData(10, null, 0);

        $dsex_yesterday = $index_data_yesterday['index']['10001']['data'][0]->capital_value;
        $cap_equity_today = $ob_cap_equity_yesterday['cap_equity']['meta_value'];
        $trade_date_today = $index_data_today['index']['10001']['data'][0]->index_date->format('Y-m-d');
        $trade_date_yesterday = $index_data_yesterday['index']['10001']['data'][0]->index_date->format('Y-m-d');

        $this->info('ok');
    }
}
