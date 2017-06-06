<?php

namespace App\Http\Controllers;

use App\Contest;
use App\User;
use Illuminate\Http\Request;

class MyContestStatusesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Approve member.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function approve(Contest $contest, User $user)
    {
        $user->contestPortfolios()->updateExistingPivot($contest->id, [
                                'approved'                => true, 
                                'portfolio_value'         => $contest->contest_amount,
                                'cash_amount'             => $contest->contest_amount,
                                'current_portfolio_value' => $contest->contest_amount
                            ]);

        flash('Member successfully approved!', 'success');

        return back();
    }

    /**
     * Disapprove member.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function disapprove(Contest $contest, User $user)
    {
        $user->contestPortfolios()->updateExistingPivot($contest->id, [
                                'approved' => false
                            ]);

        flash('Member successfully disapprove!', 'success');

        return back();
    }

    /**
     * Block contest.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function block(Contest $contest)
    {
        $contest->update([
            'is_active' => false
        ]);

        flash('Contest successfully blocked!', 'success');

        return back();
    }

    /**
     * Unblock contest.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function unblock(Contest $contest)
    {
        $contest->update([
            'is_active' => true
        ]);

        flash('Contest successfully unblocked!', 'success');

        return back();
    }
}
