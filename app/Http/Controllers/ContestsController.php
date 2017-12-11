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
        $sql = "SELECT *, (no_of_shares - sell_quantity) as available_shares FROM `contest_portfolio_shares` left join (SELECT * FROM `data_banks_intradays` where batch = (select max(batch) from data_banks_intradays)) as ltp on ltp.instrument_id = contest_portfolio_shares.instrument_id where contest_id = 413";
        $data = \DB::select(\DB::raw($sql));
        dd($data);
         $contest->load(['contestPortfolios.shares', 'contestPortfolios.user']);

        // Retrieve all contests that have at least one approved user..
        // $contest->load(['contestUsers.shares', 'contestUsers' => function ($q) {
        //     $q->wherePivot('approved', true);
        // }]);
        return view('contests.show', compact('contest'));
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
