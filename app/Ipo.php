<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ipo extends Model
{
    protected $table = 'ipolists';

    public function scopeUpcoming($query)
    {
    	return $query;
    }
}
