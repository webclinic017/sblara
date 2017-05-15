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
        $contests = Contest::with('creator')->get();

        return $contests;
    }
} 