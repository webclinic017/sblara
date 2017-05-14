<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'name',
		'start_date',
		'end_date',
		'access_level',
		'contest_amount',
		'max_amount',
		'max_member',
		'is_active'
    ];

    /**
     * Get the creator that owns the contest.
     */
    public function creator() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
