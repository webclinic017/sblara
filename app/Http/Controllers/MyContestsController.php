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
        if ($contest->access_level) {
            auth()->user()->contestPortfolios()->attach($contest, ['approved' => false]);
            // return msg waiting for approval
        } else {
            auth()->user()->contestPortfolios()->attach($contest, ['approved' => true]);
            // // return session msg
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

        // return session msg..

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

        return back();
    }
}
