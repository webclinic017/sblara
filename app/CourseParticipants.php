<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Participants;

class CourseParticipants extends Model
{
    protected $table = "course_participants";
    //public $timestamps = false;

    static public function getActiveCourse()
    {
        $course_batches = CourseBatches::where('c_start_date', '>=', date("Y-m-d H:i:s"))->where('c_reg_last_date', '>=', date("Y-m-d H:i:s"))->get();
        for($i = 0; $i < count($course_batches); $i++){
          //dd($course_batches[$i]);
          $course_batches[$i]->count = CourseParticipants::where('course_batch_id', $course_batches[$i]->id)->count();
          $course_batches[$i]->paid = CourseParticipants::where('course_batch_id', $course_batches[$i]->id)->where('paid_status','paid')->count();
        }
        return $course_batches;
    }

    public function batch()
    {
        return $this->hasOne('App\CourseBatches', 'id', 'course_batch_id');
    }
}
