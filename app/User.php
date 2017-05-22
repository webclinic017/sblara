<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        return $this->belongsToMany(Contest::class, 'contest_portfolios', 'user_id', 'contest_id')
                    ->withPivot('id', 'join_date', 'approved', 'portfolio_value')
                    ->withTimestamps();
    }

    /**
     * Get all of the shares for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function shares()
    {
        return $this->hasManyThrough(
            ContestPortfolioShare::class, ContestPortfolio::class,
            'user_id', 'contest_portfolio_id', 'id'
        );
    }

    public function getJoinDateAttribute($join_date)
    {
        return Carbon::parse($join_date)->format('d-M-Y');
    }
}
