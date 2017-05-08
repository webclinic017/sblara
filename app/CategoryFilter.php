<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryFilter extends Model
{
    //
    protected $table = "category_filters";

    public function kind_filters()
    {
        return $this->hasMany('App\Kindfilter', 'id_category', 'id');
    }
}
