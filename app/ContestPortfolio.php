<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestPortfolio extends Model
{
    /**
     * Get the creator that owns the contest.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator() 
    {
        return $this->belongsTo(User::class);
    }
}
