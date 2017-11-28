<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ipo extends Model
{
    use SoftDeletes;
    protected $table = 'ipolists';

    public function scopeUpcoming($query)
    {
    	return $query;
    }
}
