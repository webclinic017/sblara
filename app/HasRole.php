<?php

namespace App;

use Auth;

trait HasRole
{

    /**
     * A user may have a role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Assign a role to the user
     *
     * @param  $role
     * @return mixed
     */
    public function assignRole($role)
    {
        return $this->role()->associate($role)->save();
    }

    /**
     * Determine if the user is admin.
     */
    public function isAdmin()
    {
        return auth()->user()->role->name == 'admin';
    }

    /**
     * Determine if the user is member.
     */
    public function isMember()
    {
        return auth()->user()->role->name == 'member';
    }
}