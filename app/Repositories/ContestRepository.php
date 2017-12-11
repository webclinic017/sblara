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
                             ->where('contest_category', 1)
                            ->orderBy('approved_contest_users_count', 'desc')
                            ->where('is_active', true)
                            ->latest('created_at')->paginate(25);
        // Todo: whereDate()

        return $contests;
    }
} 