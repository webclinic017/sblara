<?php

namespace App\Http\Controllers;

use App\ContestPortfolio;
use Illuminate\Http\Request;

class ContestPortfoliosController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(ContestPortfolio $portfolio)
    {
        $portfolio->load('share.intrument', 'share.transactionType', 'share.portfolio.portfolio_transactions');

        /*$amountSumOfPortfolio = \App\PortfolioTransaction::where('portfolio_id', $transaction->portfolio_id)
        												 ->where('transaction_type_id', 1)
        												 ->sum('amount');*/

        // test
      	if ($portfolio->share) {
	        $dataBankIntraDays = \App\DataBanksIntraday::where('instrument_id', $portfolio->share->instrument_id)
	        										   ->latest('id')->first();
      	}
		// return $portfolio;

        return view('contest_portfolio_shares.show', compact('portfolio', 'dataBankIntraDays'));
    }
}
