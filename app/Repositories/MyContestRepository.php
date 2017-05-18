<?php

namespace App\Repositories;

use App\Contest;

class MyContestRepository 
{
    public static function myContestData()
    {
    	// get all own contests
        $myContests = auth()->user()->contests()
        							->withCount('approvedContestUsers')
        							->withCount('forApprovalContestUsers')
        							->latest()->get();

        return $myContests;
    }

    public static function myJoinContestData()
    {
    	// get all join competitors contests
        // $myJoinContests = auth()->user()->contestPortfolios()->get();

    	$contests = auth()->user()->load('contestPortfolios.creator');

        return $contests;
    }
} 