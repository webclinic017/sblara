<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kindfilter extends Model
{
    //
    protected $table = "kind_filters";

    public function filters()
    {
        return $this->hasMany('App\Filter', 'id_kindfilter', 'id');
    }
}
