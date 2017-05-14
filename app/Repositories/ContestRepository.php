<?php

namespace App\Repositories;

use App\Contest;

class ContestRepository 
{
    public static function ContestData()
    {
        $contests = Contest::with('creator')->get();

        return $contests;
    }
} 