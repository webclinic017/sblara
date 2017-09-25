<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\CourseParticipants;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    private $id_participant;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id_participant)
    {
        $this->id_participant = $id_participant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $course_participant = CourseParticipants::find($this->id_participant);

          //      $CourseBatches = CourseBatches::find($request->input('course_batch_id'));

        //dd($course_participant->batch());
        return $this->view('mail', ['course_participant' => $course_participant])->subject
          (
            'Thank you for registering for Exclusive Training Program on '.$course_participant->batch->course->course_name
          );
    }
}
