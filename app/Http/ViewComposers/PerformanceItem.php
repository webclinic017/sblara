<?php

/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\InstrumentRepository;

class PerformanceItem {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {


        $viewData      = $view->getData();

        $portfolio_id = $viewData['portfolio']->id;
        $cash_amount = $viewData['portfolio']->cash_amount;


        $all_buy_transactions_of_this_portfolio_group_by_instrument_id = \App\PortfolioScrip::where('share_status', 'buy')
            ->where('portfolio_id', $portfolio_id)
            ->get()->groupBy('instrument_id');

        $all_exchanges = \App\Exchange::all()->keyBy('id');

        $total_buy_cost_of_this_portfolio_with_commission=0;
        $total_sell_value_of_this_portfolio_deducting_commission=0;
        $total_gain_loss_of_this_portfolio_since_purchased=0;
        $total_gain_loss_of_this_portfolio_today=0;

        $all_transaction_array=array();

        foreach($all_buy_transactions_of_this_portfolio_group_by_instrument_id as $instrument_id=>$all_transactions_of_this_instrument)
        {
            $dataBankIntraDays = \App\DataBanksIntraday::where('instrument_id', $instrument_id)
                ->orderBy('id', 'desc')
                ->first();



            $instrument_info = \App\Instrument::where('id', $instrument_id)
                ->first();



            $total_buying_cost_of_this_instrument = 0;
            $total_shares_of_this_instrument = 0;  //shares
            $total_buy_commission_of_this_instrument=0; // commission

            $childTransactions=array();

            foreach($all_transactions_of_this_instrument as $transaction)
            {
                if(count($all_transactions_of_this_instrument)>1) {

                    $temp=array();
                    $temp['instrument_code']= $instrument_info->instrument_code;
                    $temp['exchange'] = $all_exchanges[$instrument_info->exchange_id]->name;
                    $temp['total_shares_of_this_instrument']= $transaction->no_of_shares;
                    $temp['buying_date_of_this_instrument'] = $transaction->buying_date->format('Y-m-d');
                    $temp['avg_buy_cost_of_this_instrument']= $transaction->buying_price;
                    $temp['total_buy_commission_of_this_instrument']= $transaction->commission ? ($transaction->commission / 100) * ($transaction->buying_price* $transaction->no_of_shares) : 0;
                    $temp['is_parent']=0;
                    $temp['is_child']=1;
                    $temp['last_traded_datetime_of_this_instrument']= $dataBankIntraDays->lm_date_time->format('h:i a');
                    $temp['last_traded_price_of_this_instrument']= $dataBankIntraDays->close_price;
                    $temp['change_today_of_this_instrument']= $dataBankIntraDays->price_change;
                    $temp['change_today_per_of_this_instrument']= $dataBankIntraDays->price_change_per;
                    $temp['percent_of_portfolio_holding_by_this_instrument']=0;
                    $sell_value_of_this_instrument= $dataBankIntraDays->close_price* $transaction->no_of_shares;
                    $sell_commission_of_this_instrument = $transaction->commission ? ($transaction->commission / 100) * $sell_value_of_this_instrument : 0;
                    $temp['sell_value_deducting_commission_of_this_instrument']= $sell_value_of_this_instrument- $sell_commission_of_this_instrument;
                    $temp['total_buying_cost_including_commission_of_this_instrument']= $temp['total_buy_commission_of_this_instrument'] + ($transaction->buying_price * $transaction->no_of_shares);
                    $temp['gain_loss_today_for_this_instrument'] = $temp['sell_value_deducting_commission_of_this_instrument']-$temp['total_buying_cost_including_commission_of_this_instrument'];
                    $temp['gain_loss_since_purchased_for_this_instrument'] = ($dataBankIntraDays->close_price - $transaction->buying_price) * $transaction->no_of_shares;
                    $temp['gain_loss_per_since_purchased_for_this_instrument'] = $temp['total_buying_cost_including_commission_of_this_instrument']?$temp['gain_loss_since_purchased_for_this_instrument'] / $temp['total_buying_cost_including_commission_of_this_instrument'] * 100:0;
                    $temp['gain_loss_per_since_purchased_for_this_instrument'] = round($temp['gain_loss_per_since_purchased_for_this_instrument'], 2);
                    $temp['has_child']=0;
               //     $temp['childTransactions']=array();

                    $childTransactions[]= $temp;

                }
                
                $total_shares_of_this_instrument += $transaction->no_of_shares;
                $total_buying_cost_of_this_instrument += $transaction->buying_price* $transaction->no_of_shares;
                $total_buy_commission_of_this_instrument = $transaction->commission ? ($transaction->commission / 100) * $total_buying_cost_of_this_instrument : 0;
            }

            $total_buying_cost_including_commission_of_this_instrument= $total_buying_cost_of_this_instrument+ $total_buy_commission_of_this_instrument;
            $avg_buy_cost_of_this_instrument= $total_shares_of_this_instrument?($total_buying_cost_of_this_instrument / $total_shares_of_this_instrument):0;
            $avg_buy_cost_of_this_instrument= round($avg_buy_cost_of_this_instrument,2);


            $temp = array();
            $temp['instrument_code'] = $instrument_info->instrument_code;
            $temp['exchange'] = $all_exchanges[$instrument_info->exchange_id]->name;
            $temp['total_shares_of_this_instrument'] = $total_shares_of_this_instrument;
            $temp['buying_date_of_this_instrument'] = $transaction->buying_date->format('Y-m-d');
            $temp['avg_buy_cost_of_this_instrument'] = $avg_buy_cost_of_this_instrument;
            $temp['total_buy_commission_of_this_instrument'] = $total_buy_commission_of_this_instrument;
            $temp['is_parent'] = 1;
            $temp['is_child'] = 0;
            if($dataBankIntraDays)
            {

             $temp['last_traded_datetime_of_this_instrument'] = $dataBankIntraDays->lm_date_time->format('h:i a');
            }else{
             $temp['last_traded_datetime_of_this_instrument'] = " ";

            }

            if($dataBankIntraDays)
            {
            $temp['last_traded_price_of_this_instrument'] = $dataBankIntraDays->close_price;
            }else{
                $temp['last_traded_price_of_this_instrument'] = "";
            }
            
            if($dataBankIntraDays)
            {
            $temp['change_today_of_this_instrument'] = $dataBankIntraDays->price_change;
            }else{
                $temp['change_today_of_this_instrument'] = "";
            }

            if($dataBankIntraDays)
            {
            $temp['change_today_per_of_this_instrument'] = $dataBankIntraDays->price_change_per;
            }else{
                $temp['change_today_per_of_this_instrument'] = "";
            }

    if(!$dataBankIntraDays)
    {
        $dataBankIntraDays = new \stdClass();
        $dataBankIntraDays->close_price = 0;
        $dataBankIntraDays->price_change = 0;
    }
            $temp['percent_of_portfolio_holding_by_this_instrument'] = 0;
            $sell_value_of_this_instrument = $dataBankIntraDays->close_price * $total_shares_of_this_instrument;
        

        $sell_commission_of_this_instrument = $transaction->commission ? ($transaction->commission / 100) * $sell_value_of_this_instrument : 0;
            $temp['sell_value_deducting_commission_of_this_instrument'] = $sell_value_of_this_instrument - $sell_commission_of_this_instrument;
            $temp['total_buying_cost_including_commission_of_this_instrument'] = $total_buying_cost_including_commission_of_this_instrument;
            $temp['gain_loss_today_for_this_instrument'] = $total_shares_of_this_instrument * $dataBankIntraDays->price_change;
            $temp['gain_loss_since_purchased_for_this_instrument'] = $temp['sell_value_deducting_commission_of_this_instrument']-$total_buying_cost_including_commission_of_this_instrument;
            $temp['gain_loss_per_since_purchased_for_this_instrument'] = $temp['total_buying_cost_including_commission_of_this_instrument']?($temp['gain_loss_since_purchased_for_this_instrument'] / $temp['total_buying_cost_including_commission_of_this_instrument'] * 100):0;
            $temp['gain_loss_per_since_purchased_for_this_instrument'] = round($temp['gain_loss_per_since_purchased_for_this_instrument'], 2);
            $temp['has_child']=count($childTransactions);

            $all_transaction_array[]= $temp;
            foreach($childTransactions as $child)
            {
                $all_transaction_array[]= $child;
            }

            $total_gain_loss_of_this_portfolio_today+= $temp['gain_loss_today_for_this_instrument'];
            $total_buy_cost_of_this_portfolio_with_commission+= $temp['total_buying_cost_including_commission_of_this_instrument'];
            $total_sell_value_of_this_portfolio_deducting_commission+= $temp['sell_value_deducting_commission_of_this_instrument'];
            $total_gain_loss_of_this_portfolio_since_purchased+= $temp['gain_loss_since_purchased_for_this_instrument'];


        }


        $total_portfolio_value_with_commision=$total_buy_cost_of_this_portfolio_with_commission + $cash_amount;
        $total_gain_loss_per_of_this_portfolio_since_purchased= $total_portfolio_value_with_commision?round($total_gain_loss_of_this_portfolio_since_purchased/ $total_portfolio_value_with_commision*100,2):0;
        $cash_amount_per= $total_portfolio_value_with_commision?($cash_amount/$total_portfolio_value_with_commision)*100:0;
        $cash_amount_per=round($cash_amount_per,2);
        $total_portfolio_value_with_cash= round($total_sell_value_of_this_portfolio_deducting_commission + $cash_amount,2);

        // calculating percent_of_portfolio_holding_by_this_instrument
        //dump($all_transaction_array);
        $all_transaction_array2=array();
        foreach($all_transaction_array as $transaction)
        {
            $transaction['percent_of_portfolio_holding_by_this_instrument']= $total_portfolio_value_with_cash?$transaction['sell_value_deducting_commission_of_this_instrument']/ $total_portfolio_value_with_cash*100:0;
            $transaction['percent_of_portfolio_holding_by_this_instrument']=round($transaction['percent_of_portfolio_holding_by_this_instrument'],2);
            $all_transaction_array2[]= $transaction;
        }



        $view->with('all_transaction_array', $all_transaction_array2);
        $view->with('cash_amount', round($cash_amount,2));
        $view->with('cash_amount_per', round($cash_amount_per,2));
        $view->with('gainLossToday', round($total_gain_loss_of_this_portfolio_today,2));
        $view->with('totalPurchaseWithCommission', round($total_buy_cost_of_this_portfolio_with_commission,2));
        $view->with('totalProfitSincePurchase', round($total_gain_loss_of_this_portfolio_since_purchased,2));
        $view->with('totalChangeSincePurchase', round($total_gain_loss_per_of_this_portfolio_since_purchased,2));
        $view->with('totalSellDeductingCommission', round($total_portfolio_value_with_cash,2));


    }

}
