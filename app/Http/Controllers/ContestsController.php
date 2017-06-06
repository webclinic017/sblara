<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;

class ContestsController extends Controller
{    
    /**
     * Show all contests.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contests.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {
        // Only Active/Unblock contest can view/show.
        if ( ! $contest->is_active) {
            $this->authorize('show', $contest);
        }

        // Retrieve all contests that have at least one approved user..
        $contest->load(['contestUsers.shares', 'contestUsers' => function ($q) {
            $q->wherePivot('approved', true);
        }]);

        /*total_portfolio_value= sum of sell_value_deducting_commision of all portfolio share +cash_amount
        %portfolio of a share = sell_value_deducting_commission of that share/total_portfolio_value*100
        growth=portfolio growth
        if contest_amount =100000 taka
        and current total_portfolio_value is 150000 taka
        growth will be =150000-100000 =50000 taka
        growth %= 50000/100000*100= 50%*/

        $growthPercent = 0;
        $contestAmount = $contest->contest_amount;
        foreach ($contest->contestUsers as $user) {
            $totalPortfolioValue = $user->pivot->current_portfolio_value;
        }
        $growth = $totalPortfolioValue - $contestAmount;
        $growthPercent = number_format($growth / $contestAmount * 100, 2);

        return view('contests.show', compact('contest', 'growthPercent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
        //
    }
}
