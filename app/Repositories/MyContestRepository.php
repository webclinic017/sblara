<?php

namespace App\Repositories;

use App\Contest;

class MyContestRepository 
{
    public static function myContestData()
    {
    	// get all own contests
        $myContests = auth()->user()->contests()->withCount('approvedContestUsers')->latest()->get();

        return $myContests;
    }
} 