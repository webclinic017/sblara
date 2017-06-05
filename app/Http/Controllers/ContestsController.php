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

        $growthPercent = 0;
        $contestAmount = $contest->contest_amount;
        foreach ($contest->contestUsers as $user) {
            $totalPortfolioValue = $user->pivot->cash_amount;
        }
        $growth = $totalPortfolioValue - $contestAmount;
        $growthPercent = $growth / $contestAmount * 100;

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
