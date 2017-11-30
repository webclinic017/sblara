<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasAttachment;
class Ipo extends Model
{
    use SoftDeletes, HasAttachment;
    protected $table = 'ipolists';

    public function scopeUpcoming($query)
    {
    	return $query;
    }

}
