<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseBatches extends Model
{
    protected $table = "course_batches";
    //public $timestamps = false;

    public function course()
    {
        return $this->hasOne('App\Courses', 'id', 'course_id');
    }

    public function venue()
    {
        return $this->hasOne('App\CourseVenues', 'venue_id', 'course_venue_id');
    }
}
