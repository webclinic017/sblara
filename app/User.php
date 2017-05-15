<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable {

    use Notifiable, HasApiTokens, HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function portfolios() {
        return $this->hasMany('\App\Portfolio');
    }

    /**
     * Get all of the contests for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contests()
    {
        return $this->hasMany(Contest::class);
    }

    /**
     * Fetch all contest that the user has joined up.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contestPortfolios()
    {
        return $this->belongsToMany(Contest::class, 'contest_portfolios', 'contest_id', 'user_id')
                    ->withPivot('join_date', 'approved')
                    ->withTimestamps();
    }
}
