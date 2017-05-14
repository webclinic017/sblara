<?php

namespace App\Policies;

use App\Contest;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the authenticated user has permission to edit a contest.
     *
     * @param  User  $user
     * @param  Contest $contest
     * @return bool
     */
    public function edit(User $user, Contest $contest)
    {
        return $contest->user_id == $user->id;
    }

    /**
     * Determine if the authenticated user has permission to update a contest.
     *
     * @param  User  $user
     * @param  Contest $contest
     * @return bool
     */
    public function update(User $user, Contest $contest)
    {
        return $contest->user_id == $user->id;
    }
}
