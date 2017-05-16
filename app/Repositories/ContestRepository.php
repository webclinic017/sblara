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
                            ->where('is_active', true)
                            ->latest('created_at')->get();
        // Todo: whereDate()

        return $contests;
    }
} 