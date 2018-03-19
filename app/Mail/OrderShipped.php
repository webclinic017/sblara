<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\CourseParticipants;
use App\CourseBatches;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    private $id_participant;
    private $bacth_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id_participant,$bacth_id)
    {
        $this->id_participant = $id_participant;
        $this->bacth_id = $bacth_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $course_participant = CourseParticipants::find($this->id_participant);

        $batch = CourseBatches::find($this->bacth_id);

        //dd($course_participant->batch());
        return $this->view('mail', ['course_participant' => $course_participant,'batch' => $batch])->subject
          (
            'Thank you for registering for Exclusive Training Program on '.$course_participant->batch->course->course_name
          );
    }
}
