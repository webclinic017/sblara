<?php

namespace App\Http\Controllers;

use App\Contest;
use App\User;
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


        $users = \Cache::remember('contest_'.$contest, now()->addSeconds(1200), function () use($contest)
        {
         $sql = "SELECT no_of_shares , sell_quantity, users.name, users.id user_id,  contest_portfolios.id, contest_portfolios.join_date, 
                    (select count(distinct  id) from contest_portfolio_shares where contest_portfolio_id = contest_portfolios.id) share_holdings, round(IFNULL(sum((no_of_shares - sell_quantity)* IFNULL(ltp, (select close from data_banks_eods where data_banks_eods.instrument_id = contest_portfolio_shares.instrument_id and close != 0 and close is not null order by id desc limit 1))), 0) +cash_amount, 2) portfolio_value FROM `contest_portfolios` 
                    LEFT JOIN contest_portfolio_shares on contest_portfolios.id = contest_portfolio_shares.contest_portfolio_id 
                    LEFT JOIN (SELECT instrument_id, ROUND( COALESCE(  NULLIF(close_price, 0), NULLIF(pub_last_traded_price, 0) , NULLIF(spot_last_traded_price, 0), NULLIF(yday_close_price,  0) ), 2 ) as ltp FROM `data_banks_intradays` where batch = ( select max(batch) from data_banks_intradays) ) as ltp on ltp.instrument_id = contest_portfolio_shares.instrument_id LEFT JOIN users on users.id = user_id WHERE contest_portfolios.contest_id = $contest->id   group by contest_portfolios.id ORDER BY `portfolio_value` DESC";            
            return \DB::select(\DB::raw($sql)); 
        });
         $contest->load(['contestPortfolios.shares', 'contestPortfolios.user']);
         // dd($sql);
        // Retrieve all contests that have at least one approved user..
        // $contest->load(['contestUsers.shares', 'contestUsers' => function ($q) {
        //     $q->wherePivot('approved', true);
        // }]);
         $i = 0;
         $ids = [];
         foreach($users as $user){
            if($i == 3){break;}
            $ids[] = $user->user_id;
            $i ++;
         }
            $ids_ordered = implode(',', $ids);
         $top3 = User::whereIn('id', $ids)
                         ->orderByRaw(\DB::raw("FIELD(id, $ids_ordered)")) 
                         ->get();

        return view('contests.show', compact('users', 'contest', 'top3'));
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
