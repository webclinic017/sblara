<?php

namespace App\Http\Controllers;

use App\Contest;
use App\User;
use Illuminate\Http\Request;

class MyContestStatusesController extends Controller
{
    /**
     * Approve member.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function approve(Contest $contest, User $user)
    {
        $user->contestPortfolios()->updateExistingPivot($contest->id, [
                                'approved' => true, 
                                'portfolio_value' => $contest->contest_amount
                            ]);

        flash('Member successfully approved!', 'success');

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
