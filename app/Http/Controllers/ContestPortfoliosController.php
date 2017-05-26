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
        //return $portfolio;

        return view('contest_portfolio_shares.show', [
            'portfolio'        => $portfolio
        ]);
    }
}
