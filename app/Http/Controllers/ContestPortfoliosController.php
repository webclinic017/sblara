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
        $this->authorize('show', $portfolio);

        $portfolio->load('contest', 'shares.intrument.data_banks_intraday');

        $sumGainLoss = 0;
        $sumBuyCommission = 0;

        $sumTotalPurchase = 0;
        $sumTotalGain = 0;
        $sumSellValueDeductingCommision = 0;

        $contestAmount = $portfolio->contest->contest_amount;
        $totalPortfolioValue = $portfolio->current_portfolio_value;
        $growth = $totalPortfolioValue - $contestAmount;
        $growthPercent = $growth / $contestAmount * 100;
        
        foreach ($portfolio->shares as $share) {
            $portfolioCashAmount = $portfolio->cash_amount;
            $noOfShare = $share->no_of_shares;
            $sumNoOfShare = $portfolio->shares->sum('no_of_shares');
            $buyingPrice = $share->buying_price;
            $totalBuyCost  = $noOfShare * $buyingPrice;
            $lastTradePrice = $share->intrument->data_banks_intraday->close_price;
            $lastTradeDate = $share->intrument->data_banks_intraday->lm_date_time->format('Y-m-d');
            $priceChange = $share->intrument->data_banks_intraday->price_change;
            $gainLoss = $priceChange * $noOfShare;
            $sumGainLoss += $gainLoss;

            $shareComission = $share->commission;
            $buyCommission = $shareComission * $totalBuyCost / 100;
            $sumBuyCommission += $buyCommission;
            
            $totalPurchase = $buyingPrice * $noOfShare + $buyCommission;
            $sumTotalPurchase += $totalPurchase;

            $sellValue = $noOfShare * $lastTradePrice;
            $sellCommission = ($shareComission / 100) * $sellValue;
            $sellValueDeductingCommision = $sellValue - $sellCommission;
            $sumSellValueDeductingCommision += $sellValueDeductingCommision;

            $totalBuyCostWithCommission = $totalBuyCost + $buyCommission;
            $totalGain = $sellValueDeductingCommision - $totalBuyCostWithCommission;
            $sumTotalGain += $totalGain;

            $percentChange = $totalGain / $totalBuyCostWithCommission * 100;

            $allShareCashAmount = $sumNoOfShare * $buyingPrice;
            $totalPortfolioValue = $allShareCashAmount + $portfolioCashAmount;
            $percentPortfolio = $sellValue / $totalPortfolioValue * 100;
        }

        return view('contest_portfolio_shares.show', [
            'portfolio'                      => $portfolio,
            'sumGainLoss'                    => number_format($sumGainLoss, 2),
            'sumBuyCommission'               => number_format($sumBuyCommission, 2),
            'sumTotalPurchase'               => number_format($sumTotalPurchase, 2),
            'sumTotalGain'                   => number_format($sumTotalGain, 2),
            'sumSellValueDeductingCommision' => number_format($sumSellValueDeductingCommision, 2),
            'growthPercent'                  => number_format($growthPercent, 2)
        ]);
    }
}
