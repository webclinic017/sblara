<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as Ath;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\UserInformation;

class User extends  Authenticatable implements Ath{

    use Notifiable, HasRole, HasApiTokens;

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

    public function watchlists() {
        return $this->hasMany('\App\Watchlist');
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
                    ->withPivot('id', 'join_date', 'approved', 'portfolio_value', 'cash_amount', 'current_portfolio_value')
                    ->withTimestamps();
    }

    public function joinedContests()
    {
        return $this->hasMany(\App\ContestPortfolio::class);
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

    public function contestShares()
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

    public function getAvatarAttribute($value)
    {
        return $this->image?"/img/149x149/".$this->image:"/img/user-default.png";
    }

    public function getTaChartSettingsAttribute()
    {
        //ta-chart-settings
        return $this->getMeta('ta-chart-settings');
        
    }

    public function getMeta($key)
    {
        return UserInformation::join('metas', 'user_informations.meta_id', 'metas.id')->where('metas.meta_key', $key)->where('user_id', $this->id)->first();
    }

    public function storeMeta($key, $value)
    {
        if($meta = $this->getMeta($key)){
            UserInformation::where('id', $meta->id)->update(['meta_value' => $value]);
            print_r($meta);
            return $meta;
        }
        $meta = \App\Meta::where('meta_key', $key)->first();
        return UserInformation::insert(['meta_id' => $meta->id, 'user_id' => $this->id, 'meta_value' => $value]);

    }

    public function screeners()
    {
        return $this->hasMany(\App\Screener::class);
    }

}
