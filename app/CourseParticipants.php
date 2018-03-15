<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Participants;

class CourseParticipants extends Model
{
    protected $table = "course_participants";
    //public $timestamps = false;

    static public function getActiveCourse()
    {
        $course_batches =  DB::select(
          "SELECT b.id, b.batch_name, b.c_start_date, b.c_start_time,b.c_end_date, b.c_end_time, b.course_fees, b.course_duration, c.id as c_id, c.course_name, d.venue_id, d.venue_name
           FROM course_batches AS b, courses AS c, course_venues AS d
           WHERE b.course_id = c.id AND b.course_venue_id = d.venue_id AND (b.batch_status = 'upcoming' OR b.batch_status='running') ORDER BY b.c_start_date asc"
        );

        //$course_batches = CourseBatches::where('c_start_date', '>=', date("Y-m-d H:i:s"))->where('c_reg_last_date', '>=', date("Y-m-d H:i:s"))->get();
        for($i = 0; $i < count($course_batches); $i++){
          //dd($course_batches[$i]);
          $course_batches[$i]->count = CourseParticipants::where('course_batch_id', $course_batches[$i]->id)->count();
          $course_batches[$i]->paid = CourseParticipants::where('course_batch_id', $course_batches[$i]->id)->where('paid_status','paid')->count();
        }
        return $course_batches;
    }

    public static function getEnumValues($table, $column)
    {
      $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;
      preg_match('/^enum\((.*)\)$/', $type, $matches);
      $enum = array();
      foreach( explode(',', $matches[1]) as $value )
      {
        $v = trim( $value, "'" );
        $enum = array_add($enum, $v, $v);
      }
      return $enum;
    }

    public function batch()
    {
        return $this->hasOne('App\CourseBatches', 'id', 'course_batch_id');
    }

    public function payment()
    {
        return $this->hasMany('App\CourseParticipantPayments', 'course_participant_id', 'id');
    }
}
