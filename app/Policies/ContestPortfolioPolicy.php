<?php

namespace App\Policies;

use App\ContestPortfolio;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContestPortfolioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the authenticated user has permission to show a contest portfolio.
     *
     * @param  User $user
     * @param  ContestPortfolio $portfolio
     * @return bool
     */
    public function show(User $user, ContestPortfolio $portfolio)
    {
        return $portfolio->user_id == $user->id;
    }

    /**
     * Determine if the authenticated user has permission to create a contest portfolio.
     *
     * @param  User $user
     * @param  ContestPortfolio $portfolio
     * @return bool
     */
    public function create(User $user, ContestPortfolio $portfolio)
    {
        return $portfolio->user_id == $user->id;
    }
}
