<?php

namespace App\Repositories;

use App\Contest;

class ContestRepository 
{
    public static function ContestData()
    {
    	// get all contest
        $contests = Contest::with('creator')->get();

        return $contests;
    }
} 