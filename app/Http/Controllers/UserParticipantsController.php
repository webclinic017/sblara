<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses;
use App\CourseVenues;
use App\CourseFacilitators;
use App\CourseCategories;
use App\CourseBatches;
use App\CourseParticipants;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class UserParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $batches = CourseParticipants::getActiveCourse();
      return view('user_courses.list', ['batches' => $batches]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $batch = CourseBatches::find($id);
      return view('user_courses.registration', ['batch' => $batch]);
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
        $this->validate($request, [
           'course_batch_id' => 'required|unique:course_facilitators,faci_name|max:255',
           'p_name' => 'required',
           'p_email' => 'required|email',
           'p_phone' => 'required',
           'p_address' => 'required',
           'p_profession' => 'max:100',
           'p_organisation' => 'max:100',
           'p_designation' => 'max:100',
           'where_heard' => 'max:100',
           'p_comments' => 'max:255'

        ]);

        $participant = new CourseParticipants();
        $participant->course_batch_id = $request->input('course_batch_id');
        $participant->p_name = $request->input('p_name');
        $participant->p_email = $request->input('p_email');
        $participant->p_phone = $request->input('p_phone');
        $participant->p_address = $request->input('p_address');
        $participant->p_profession = $request->input('p_profession');
        $participant->p_organisation = $request->input('p_organisation');
        $participant->p_designation = $request->input('p_designation');
        $participant->where_heard = $request->input('where_heard');
        $participant->p_comments = $request->input('p_comments');
        $participant->save();


        Mail::to($request->input('p_email'))->send(new OrderShipped($participant->id));

        $batches = CourseParticipants::getActiveCourse();


        return view('user_courses.list', ['batches' => $batches, 'message_success' => 'You successfull registred!']);
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
        return view('admin_courses.participants.detail', ['batches' => $batches]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        //return view('admin_courses.category.list', ['course_categories' => $course_categories, 'message_success' => 'Category is update']);
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
