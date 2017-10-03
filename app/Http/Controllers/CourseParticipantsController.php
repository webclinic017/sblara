<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Courses;
use App\CourseVenues;
use App\CourseFacilitators;
use App\CourseCategories;
use App\CourseBatches;
use App\CourseParticipants;

class CourseParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $batches = CourseParticipants::getActiveCourse();
      return view('admin_courses.participants.list', ['batches' => $batches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $batches = CourseBatches::find($id);
        $participants = CourseParticipants::where('course_batch_id',$id)->get();
        return view('admin_courses.participants.detail', ['batches' => $batches, 'participants' => $participants]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $participant = CourseParticipants::find($id);
        $certificate_status = CourseParticipants::getEnumValues('course_participants', 'p_certificate_status');
        $batch_want = CourseParticipants::getEnumValues('course_participants', 'batch_want');
        return view('admin_courses.participants.edit', ['participant' => $participant, 'certificate_status' => $certificate_status, 'batch_want' => $batch_want]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'p_name' => 'required',
           'p_email' => 'required|email',
           'p_phone' => 'required',
           'p_address' => 'required',
           'p_profession' => 'max:100',
           'p_organisation' => 'max:100',
           'p_designation' => 'max:100',
           'p_comments' => 'max:255',
           'our_comments' => 'max:255',

        ]);

        $participant = CourseParticipants::find($id);
        $participant->p_name = $request->input('p_name');
        $participant->p_identification_no = $request->input('p_identification_no');
        $participant->p_email = $request->input('p_email');
        $participant->p_phone = $request->input('p_phone');
        $participant->p_address = $request->input('p_address');
        $participant->p_profession = $request->input('p_profession');
        $participant->p_organisation = $request->input('p_organisation');
        $participant->p_designation = $request->input('p_designation');
        $participant->where_heard = $request->input('where_heard');
        $participant->p_comments = $request->input('p_comments');
        $participant->our_comments = $request->input('our_comments');
        $participant->p_certificate_status = $request->input('p_certificate_status');
        $participant->batch_want = $request->input('batch_want');
        $participant->save();

        $participant = CourseParticipants::find($id);
        $certificate_status = CourseParticipants::getEnumValues('course_participants', 'p_certificate_status');
        $batch_want = CourseParticipants::getEnumValues('course_participants', 'batch_want');
        return view('admin_courses.participants.edit', ['participant' => $participant, 'certificate_status' => $certificate_status, 'batch_want' => $batch_want,
                'message_success' => 'Participant successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
