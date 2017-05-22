<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;

class JoinContestsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Join a new contest.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function store(Contest $contest)
    {
        $contest->load('approvedContestUsers');

        $current_member = $contest->approvedContestUsers->count();

        if ($current_member < $contest->max_member) {
            if ($contest->access_level) {
                auth()->user()->contestPortfolios()->attach($contest, ['approved' => false]);

                flash('Please wait for the approval!', 'success');
            } else {
                auth()->user()->contestPortfolios()
                            ->attach($contest, [
                                'approved' => true, 
                                'portfolio_value' => $contest->contest_amount
                            ]);

                flash('You successfully joined in a contest!', 'success');
            }
        } else {
            flash('Sorry contest is already full!', 'error');
        }

        return back();
    }
}
