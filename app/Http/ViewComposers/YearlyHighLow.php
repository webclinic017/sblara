<?php

/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM

 */
namespace App\Http\ViewComposers;

use App\Market;
use Illuminate\View\View;

use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\DataBankEodRepository;

use App\Repositories\InstrumentRepository;
use DB;

class YearlyHighLow

{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */

    public function compose(View $view)

    {
        $viewdata = $view->getData();
        $instrument_id = 13;
        if (isset($viewdata['instrument_id']))
            $instrument_id = (int)$viewdata['instrument_id'];

        $instrument_info = InstrumentRepository::getInstrumentsById($instrument_id)->first();
        $instrument_code = $instrument_info->instrument_code;

        $position_arr = array();
        $latest_trade_data_all_instruments = DataBanksIntradayRepository::getLatestTradeDataAll();

        $position_arr['price_change'] = "Not Traded";
        $position_arr['price_change_per'] = "Not Traded";
        $position_arr['total_volume'] = "Not Traded";
        $position_arr['total_trades'] = "Not Traded";
        $position_arr['total_value'] = "Not Traded";
        $total_shares_traded = count($latest_trade_data_all_instruments);
        if (isset($latest_trade_data_all_instruments[$instrument_id])) {
            $sorted = $latest_trade_data_all_instruments->sortBy('price_change')->toArray();
            $position_arr['price_change'] = array_search($instrument_id, array_keys($sorted));

            $sorted = $latest_trade_data_all_instruments->sortBy('price_change_per')->toArray();
            $position_arr['price_change_per'] = array_search($instrument_id, array_keys($sorted));

            $sorted = $latest_trade_data_all_instruments->sortBy('total_volume')->toArray();
            $position_arr['total_volume'] = array_search($instrument_id, array_keys($sorted));

            $sorted = $latest_trade_data_all_instruments->sortBy('total_trades')->toArray();
            $position_arr['total_trades'] = array_search($instrument_id, array_keys($sorted));

            $sorted = $latest_trade_data_all_instruments->sortBy('total_value')->toArray();
            $position_arr['total_value'] = array_search($instrument_id, array_keys($sorted));
            $position_arr['total_shares_traded'] = $total_shares_traded;

        }


        //dd($position_arr);


        /////////////////////     52 weeks high low - STARTS  \\\\\\\\\\\\\\\\\\\\\\\\\\\

        $year_ago_date = date('Y-m-d', strtotime('-1 year'));
        $today = date('Y-m-d');
        $eod = DataBankEodRepository::getEodData($instrument_id, $year_ago_date, $today);
        $eod_adj = DataBankEodRepository::getEodDataAdjusted($instrument_id, $year_ago_date, $today);

        $yearly_high_low_data = array();
        $high_all = $eod['h'];
        arsort($high_all);
        $high_key = array_keys($high_all)[0];
        $yearly_high = $high_all[$high_key];
        $yearly_high_at = date('d-M,Y', $eod['t'][$high_key]);
        $yearly_high_low_data['yearly_high'] = $yearly_high;
        $yearly_high_low_data['yearly_high_at'] = $yearly_high_at;

        $low_all = $eod['l'];
        asort($low_all);
        $low_key = array_keys($low_all)[0];
        $yearly_low = $low_all[$low_key];
        $yearly_low_at = date('d-M,Y', $eod['t'][$low_key]);
        $yearly_high_low_data['yearly_low'] = $yearly_low;
        $yearly_high_low_data['yearly_low_at'] = $yearly_low_at;

        $yearly_high_low_data_adjusted = array();
        $high_all = $eod_adj['h'];
        arsort($high_all);
        $high_key = array_keys($high_all)[0];
        $yearly_high = $high_all[$high_key];
        $yearly_high_at = date('d-M,Y', $eod['t'][$high_key]);
        $yearly_high_low_data_adjusted['yearly_high'] = round($yearly_high, 2);
        $yearly_high_low_data_adjusted['yearly_high_at'] = $yearly_high_at;

        $low_all = $eod_adj['l'];
        asort($low_all);
        $low_key = array_keys($low_all)[0];
        $yearly_low = $low_all[$low_key];
        $yearly_low_at = date('d-M,Y', $eod['t'][$low_key]);
        $yearly_high_low_data_adjusted['yearly_low'] = round($yearly_low, 2);
        $yearly_high_low_data_adjusted['yearly_low_at'] = $yearly_low_at;


        /////////////////////     52 weeks high low - ENDS  \\\\\\\\\\\\\\\\\\\\\\\\\\\


        $today = array();
        $today['o'] = $eod['o'][0];
        $today['h'] = $eod['h'][0];
        $today['l'] = $eod['l'][0];
        $today['c'] = $eod['c'][0];

        /*
                dd($yearly_high_low_data_adjusted);
                dump($today);
                dump($latest_trade_data);
                dump($eod);
                dump($eod_adj);*/


        $view->with('today', $today)
            ->with('instrument_code', $instrument_code)
            ->with('position_arr', $position_arr)
            ->with('yearly_high_low_data_adjusted', $yearly_high_low_data_adjusted)
            ->with('yearly_high_low_data', $yearly_high_low_data);

    }

}