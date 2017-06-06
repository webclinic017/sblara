<?php

namespace App\Policies;

use App\ContestPortfolio;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContestPortfolioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the contest is blocked.
     *
     * @param  Contest $contest
     * @return bool
     */
    public function show(User $user, ContestPortfolio $portfolio)
    {
        return $portfolio->user_id == $user->id;
    }
}
