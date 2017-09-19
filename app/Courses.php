<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = "courses";
    //public $timestamps = false;

    public function CourseCategories()
    {
        return $this->hasOne('App\CourseCategories', 'id', 'course_category_id');
    }
}
