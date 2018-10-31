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
          $course_batches[$i]->paid = \App\CourseParticipantPayments::whereIn('course_participant_id',  CourseParticipants::where('course_batch_id', $course_batches[0]->id)->pluck('id'))->count();
          $course_batches[$i]->topScrollBangla = self::getTopScrollBangla($course_batches[$i]);
          $course_batches[$i]->color = self::getColor();
        }

        
        return $course_batches;
    }

    public static function getTopScrollBangla($course)
    {
        $datetime1 = new \DateTime($course->c_start_date);
        $datetime2 = new \DateTime($course->c_end_date);
        $interval = $datetime1->diff($datetime2);


      // $a = toBangla(date_diff(new \DateTime($course->c_start_date), new \DateTime($course->c_end_date), false));
      $interval = toBangla($interval->format('%a'));
     
        $batch =  preg_replace("/[^0-9]/", '', $course->batch_name);
        $string = "বাংলাদেশে প্রথম শেয়ার মার্কেটের প্রযুক্তিগত বিশ্লেষণকারী কোম্পানি \"স্টক বাংলাদেশ লিমিটেড\" এর '".$course->course_name."' কোর্সটির ".toBangla((int) $batch)."তম ব্যাচ শুরু হতে যাচ্ছে আগামী ".toBangla(date('d', strtotime($course->c_start_date)))." ".toBangla(date('M', strtotime($course->c_start_date))).", ".toBangla(date('Y', strtotime($course->c_start_date)))." ইং। ".$interval."দিনের এই কোর্সটি চলবে ".toBangla(date('D', strtotime($course->c_start_date)))." থেকে ".toBangla(date('D', strtotime($course->c_end_date)))." সকাল ".toBangla(substr($course->c_start_time, 0, 5))." ঘটিকা থেকে সন্ধ্যা ".toBangla(substr($course->c_end_time, 0, 5))." ঘটিকা পর্যন্ত। কোর্স ফি- ".toBangla($course->course_fees)." টাকা। কোর্স শেষে প্রত্যেক অংশগ্রহণকারীকে সার্টিফিকেট প্রদান করা হবে। পরিবর্তনশীল শেয়ার বাজার সম্পর্কে জানতে আপনাকেও আপডেটেড হওয়াটা জরুরী। মার্কেট সম্পর্কে জ্ঞান অর্জন করে জেনে-বুঝে বিনিয়োগ করুন, কাঙ্খিত মুনাফা অর্জন করুন। রেজিষ্ট্রেশন করতে কল করুন- <a href=\"tel:01929912878\">০১৯২৯ ৯১ ২৮ ৭৮</a>, অথবা বিস্তারিত জানতে <a href=\"/courses/upcoming-courses/batches/".$course->id."\">এখানে ক্লিক করুন</a>";
         self::getColor();
          return $string;
    }
    public static function getColor() {
        $d = (int) date('d')/7;
        if($d < 1){
          // return "#1BBC9B";
          
          return "#9A12B3";
        }
        if($d < 2){
          // return "#E43A45";
          return "#9A12B3";
        }
        if($d < 3){
          // return "#9A12B3";
          return "#9A12B3";
        }
        if($d < 4){
          // return "#1BBC9B";
          return "#9A12B3";
        }
        if($d < 5){
          // return "#E43A45";
          // return "#1BBC9B";
          return "#9A12B3";
          // return "#E43A45";
          // return "#1BBC9B";
        }
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
