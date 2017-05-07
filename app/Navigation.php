<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    public function parent() {

        //return $this->hasOne('navigation', 'id', 'parent_id');
        return $this->hasMany('App\Navigation', 'id', 'parent_id');

    }

    public function children() {

        return $this->hasMany('App\Navigation', 'parent_id', 'id');


    }

    public static function tree() {

        return static::with(implode('.', array_fill(0, 4, 'children')))->where('parent_id', '=', NULL)->get();

    }
}
