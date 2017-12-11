<?php

namespace App\Repositories;

use App\Contest;

class ContestRepository 
{
	/**
     * Show all contests.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
    	// get all contest
        $contests = Contest::with('creator')
                            ->withCount('approvedContestUsers')
                            ->orderBy('approved_contest_users_count', 'desc')
                            ->where('is_active', true)
                            ->take(25)
                            ->latest('created_at')->get();
        // Todo: whereDate()

        return $contests;
    }
} 