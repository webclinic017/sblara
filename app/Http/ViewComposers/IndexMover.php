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
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\DataBankEodRepository;
use App\Repositories\IndexRepository;
use Illuminate\Support\Facades\Cache;


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
        //$instrumentList = InstrumentRepository::getInstrumentsScripOnly();
        $instrumentList = InstrumentRepository::getInstrumentsAll();
        $instrumentList=$instrumentList->whereNotIn('sector_list_id', [23, 24]); //filtering index and custom_index

        $listed_company_ids = $instrumentList->pluck('id');
        $lastTradedDataAllInstruments = DataBankEodRepository::getDateLessTradeData($listed_company_ids);


        //fundamental data can be cache for 24 hours as it updated daily basis
        $needed_fundamentals_of_listed_company = Cache::remember("index_mover_fundamentals", 60, function () use ($listed_company_ids) {

            $needed_fundamentals_of_listed_company = FundamentalRepository::getFundamentalData(array('total_no_securities', 'public_share_per'), $listed_company_ids);
            return $needed_fundamentals_of_listed_company;

        });

        $total_market_capital=0;
        $out="<table>";
        foreach($lastTradedDataAllInstruments as $instrumentData)
        {
            $instrument_id = $instrumentData->instrument_id;
            $instrument_code = $instrumentList->where('id', $instrument_id)->first()->instrument_code;


            if(isset($needed_fundamentals_of_listed_company['total_no_securities'][$instrument_id]))
            {
                $out.="<tr>";
                $total_no_securities = (int) $needed_fundamentals_of_listed_company['total_no_securities'][$instrument_id]->meta_value;
                $nos_updated= $needed_fundamentals_of_listed_company['total_no_securities'][$instrument_id]->meta_date;
                $cp= $instrumentData->close;
                $trade_date= $instrumentData->date;
                $market_cap_of_this_instrument = $total_no_securities * $cp;
                $total_market_capital+= $market_cap_of_this_instrument;

                $out .= "<td>  $instrument_code  </td><td>  $total_no_securities  </td><td>  $cp  </td><td> $market_cap_of_this_instrument  </td><td>  close price =$trade_date </td><td>  nos of= $nos_updated </td>";
                //echo "$instrument_code | securities= $total_no_securities ($nos_updated) | cp=$cp ($trade_date) | market capital= $market_cap_of_this_instrument <br />";

                $out .= "</tr>";

            }else
            {
                dump(" total_no_securities of $instrument_code not found");
            }


        }
        $out .= "</table>";

        echo $out;

        dd("Total market capital = $total_market_capital ");
exit;


        /* FundamentalRepository::showOrphan();
         $cap_equity=MarketStatRepository::getMarketStatsData(array('cap_equity'), null);
         $ob_cap_equity_today=$cap_equity->first();
         $ob_cap_equity_yesterday=$cap_equity->last();

         $index_data_yesterday = IndexRepository::getIndexDataYesterday(10,null,0);
         $index_data_today = IndexRepository::getIndexData(10,null,0);

         $dsex_yesterday= $index_data_yesterday['index']['10001']['data'][0]->capital_value;
         $cap_equity_today= $ob_cap_equity_yesterday['cap_equity']['meta_value'];
         $trade_date_today= $index_data_today['index']['10001']['data'][0]->index_date->format('Y-m-d');
         $trade_date_yesterday= $index_data_yesterday['index']['10001']['data'][0]->index_date->format('Y-m-d');

 dd($cap_equity);*/
       /* $TindexData = $this->Symbol->query('select id,symbol_id,close,date_time,lastprice from data_banks_intraday where symbol_id =3 AND date_time LIKE ' . "'$ydate%'" . ' ORDER BY id DESC LIMIT 1');
        $lastdayTindex = $TindexData[0]['data_banks_intraday']['lastprice'];*/


        //$view->with('bread', $bread);




    }


}