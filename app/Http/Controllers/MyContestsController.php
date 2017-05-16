<?php

namespace App\Http\Controllers;

use App\Contest;
use App\User;
use Illuminate\Http\Request;

class MyContestsController extends Controller
{
	/**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show all own contests.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('my_contests.index');
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
                auth()->user()->contestPortfolios()->attach($contest, ['approved' => true]);

                flash('You successfully joined in a contest!', 'success');
            }
        } else {
            flash('Sorry contest is already full!', 'error');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {
        // Retrieve all contests that have at least one approved user..
        $contest->load('forApprovalContestUsers', 'approvedContestUsers');

        return view('my_contests.show', compact('contest'));
    }

    /**
     * Approve member.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function approve(Contest $contest, User $user)
    {
        $user->contestPortfolios()->updateExistingPivot($contest->id, ['approved' => true]);

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
