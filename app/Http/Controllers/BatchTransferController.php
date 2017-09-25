<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses;
use App\CourseVenues;
use App\CourseFacilitators;
use App\CourseCategories;
use App\CourseBatches;
use App\CourseParticipants;
use Illuminate\Support\Facades\DB;

class BatchTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$batches = CourseBatches::where('c_start_date', '>=', date("Y-m-d H:i:s"))->get();

      //
      //  SELECT a.*, b.id, b.course_id, b.batch_name, c.course_name FROM course_participants AS a, course_batches AS b, courses AS c WHERE a.batch_want = 'nextbatch' AND a.course_batch_id=b.id AND b.course_id=c.id
      //
      $participants = DB::select("SELECT a.*, b.id as b_id, b.course_id, b.batch_name, c.course_name FROM course_participants AS a, course_batches AS b, courses AS c WHERE a.batch_want = 'nextbatch' AND a.course_batch_id=b.id AND b.course_id=c.id");
      $transfers = DB::select("SELECT b.id, b.batch_name, c.course_name FROM course_batches AS b, courses AS c WHERE b.course_id = c.id AND b.batch_status = 'upcoming'");
      //$transfers = CourseParticipants::getActiveCourse();
    //  dd($participants);
      return view('admin_courses.transfers.list', ['participants' => $participants, 'transfers' => $transfers]);
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
      //  dump($id);
        $course_participant = CourseParticipants::find($id);
      //  dd($course_participant);
        $course_participant->course_batch_id = $request->input('course_batch_id');
        $course_participant->save();

        //dd($course_participant);

        return redirect()->route('batch_transfer.index');
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
