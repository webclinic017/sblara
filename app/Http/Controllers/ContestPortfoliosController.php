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
        $portfolio->load('share.intrument.data_banks_intraday');

        $lastTradePrice     = null;
        $lastTradeDate      = null;
        $change             = null;
        $gainLossToday      = null;
        $amount             = null;
        $buyPrice           = null;
        $buyCommission      = null;
        $totalPurchase      = null;
        $gainLossTotal      = null;
        $changePercentTotal = null;
        $sellValue          = null;

        if ($portfolio->share) {
            $shares        = $portfolio->share->amount;
            $buyPrice      = $portfolio->share->rate;
            $totalBuyCost  = $shares * $buyPrice;
            $buyCommission = $portfolio->share->commission * $totalBuyCost / 100;
            $amount        = $portfolio->share->amount;
            $totalPurchase = $buyPrice * $shares + $buyCommission;

            $lastTradePrice     = $portfolio->share->intrument->data_banks_intraday->close_price;
            $lastTradeDate      = $portfolio->share->intrument->data_banks_intraday->lm_date_time->format('Y-m-d');
            $change             = $portfolio->share->intrument->data_banks_intraday->price_change;
            $changePercent      = $buyPrice ? $change / $buyPrice * 100 : 0;
            $gainLossToday      = $change * $shares;
            $changeTotal        = $lastTradePrice - $buyPrice;
            $changePercentTotal = $buyPrice ? $changeTotal / $buyPrice * 100 : 0;
            $gainLossTotal      = $changeTotal * $shares;
            $sellValue          = $lastTradePrice * $shares;

            /*$amountSumOfPortfolio = \App\PortfolioTransaction::where('portfolio_id', $portfolio->share->portfolio_id)
                                                             ->where('transaction_type_id', 1)
                                                             ->sum('amount');
            $portfolioPercent   = $amount / $amountSumOfPortfolio * 100;*/
        }
        
        return view('contest_portfolio_shares.show', [
            'portfolio'        => $portfolio,
            'lastTradePrice'   => $lastTradePrice,
            'lastTradeDate'    => $lastTradeDate,
            'change'           => $change,
            'gainLossToday'    => $gainLossToday,
            'amount'           => $amount,
            'buyPrice'         => $buyPrice,
            'commission'       => $buyCommission,
            'totalPurchase'    => $totalPurchase,
            'gainLossTotal'    => $gainLossTotal,
            'percentChange'    => $changePercentTotal,
            'percentPortfolio' => 0, // Todo portfolioPercent,
            'sellValue'        => $sellValue,
        ]);
    }
}
