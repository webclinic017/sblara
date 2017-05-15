<?php

namespace App\Http\Controllers;

use App\Contest;
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
