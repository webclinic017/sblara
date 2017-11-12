<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\FundamentalRepository;
use App\Repositories\MarketStatRepository;
use App\Repositories\IndexRepository;

class IndexMover
{
    /**
     * The index repository implementation.
     *
     * @var IndexRepository
     */

    /**
     * Create a new market_summary composer.
     *
     * @param  IndexRepository  $indexes
     * @return void
     */


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $cap_equity=MarketStatRepository::getMarketStatsData(array('cap_equity'), null);
        $ob_cap_equity_today=$cap_equity->first();
        $ob_cap_equity_yesterday=$cap_equity->last();

        $index_data_yesterday = IndexRepository::getIndexDataYesterday(10,null,0);
        $index_data_today = IndexRepository::getIndexData(10,null,0);

        $dsex_yesterday= $index_data_yesterday['index']['10001']['data'][0]->capital_value;
        $cap_equity_today= $ob_cap_equity_yesterday['cap_equity']['meta_value'];
        $trade_date_today= $index_data_today['index']['10001']['data'][0]->index_date->format('Y-m-d');
        $trade_date_yesterday= $index_data_yesterday['index']['10001']['data'][0]->index_date->format('Y-m-d');

dd($cap_equity);
       /* $TindexData = $this->Symbol->query('select id,symbol_id,close,date_time,lastprice from data_banks_intraday where symbol_id =3 AND date_time LIKE ' . "'$ydate%'" . ' ORDER BY id DESC LIMIT 1');
        $lastdayTindex = $TindexData[0]['data_banks_intraday']['lastprice'];*/


        //$view->with('bread', $bread);




    }


}