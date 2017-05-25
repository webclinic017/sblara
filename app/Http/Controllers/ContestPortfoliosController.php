<?php

namespace App\Http\Controllers;

use App\ContestPortfolio;
use Illuminate\Http\Request;

class ContestPortfoliosController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(ContestPortfolio $portfolio)
    {
        $portfolio->load('shares.intrument.data_banks_intraday');

        $lastTradePrice              = null;
        $lastTradeDate               = null;
        $price_change                = null;
        $change                      = null;
        $gainLossToday               = null;
        $buyPrice                    = null;
        $buyCommission               = null;
        $totalPurchase               = null;
        $gainLossTotal               = null;
        $changePercentTotal          = null;
        $sellValue                   = null;
        $total_gain                  = null;
        $portfolio_of_a_share        = null;
        $sellValueDeductingCommision = null;

        if (isset($portfolio->shares)) {
            foreach ($portfolio->shares as $share) {
                $shares        = $share->no_of_shares; // same
                $buyPrice      = $share->buying_price;
                
                $totalBuyCost  = $shares * $buyPrice;
                $buyCommission = $share->commission * $totalBuyCost / 100;
                $totalPurchase = $buyPrice * $shares + $buyCommission;

                $lastTradePrice = $share->intrument->data_banks_intraday->close_price;
                $lastTradeDate  = $share->intrument->data_banks_intraday->lm_date_time->format('Y-m-d');
                
                $price_change  = $share->intrument->data_banks_intraday->price_change;
                $gainLossToday = $price_change * $shares;

                $sellValue                   = $shares * $lastTradePrice;
                $sellCommission              = ($share->commission / 100) * $sellValue;
                $sellValueDeductingCommision = $sellValue - $sellCommission;

                $total_buy_cost_with_commission = $totalBuyCost + $buyCommission;
                $total_gain                     = $sellValueDeductingCommision - $total_buy_cost_with_commission;

                $change = $total_gain / $total_buy_cost_with_commission * 100;

                $all_share_cash_amount = $share->sum('no_of_shares') + $portfolio->cash_amount;
                $portfolio_of_a_share  = $sellValue / $all_share_cash_amount * 100;
            }
        }
        
        return view('contest_portfolio_shares.show', [
            'portfolio'        => $portfolio,
            'lastTradePrice'   => $lastTradePrice,
            'lastTradeDate'    => $lastTradeDate,
            'change'           => $price_change,
            'gainLossToday'    => $gainLossToday,
            'buyPrice'         => $buyPrice,
            'commission'       => $buyCommission,
            'totalPurchase'    => $totalPurchase,
            'gainLossTotal'    => $total_gain,
            'percentChange'    => $change,
            'percentPortfolio' => $portfolio_of_a_share,
            'sellValue'        => $sellValueDeductingCommision
        ]);
    }
}
