<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses;
use App\CourseCategories;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Courses::all();
        return view('admin_courses.courses.list', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = CourseCategories::all();

        return view('admin_courses.courses.create', ['categories' => $categories]);
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
           'course_category_id' => 'required',
           'course_name' => 'required|max:255',
           'course_heading' => 'required|max:255',
           'who_should_attend_title' => 'required|max:255',
           'who_should_attend' => 'required',
           'special_notes_title' => 'required|max:255',
           'who_should_attend' => 'required',
           'who_should_attend_title' => 'required|max:255',
           'special_notes_title' => 'required|max:255',
           'special_notes' => 'required',
           'course_overview_title' => 'required|max:255',
           'course_overview' => 'required',
           'objectives_of_course_title' => 'required|max:255',
           'objectives_of_course' => 'required',
           'course_benefit_title' => 'required|max:255',
           'course_benefit' => 'required',
           'why_sb_title' => 'required|max:255',
           'why_sb' => 'required',
           'course_details_title' => 'required|max:255',
           'course_details' => 'required',
        ]);

        $courses = new Courses();
        $courses->course_category_id = $request->input('course_category_id');
        $courses->course_name = $request->input('course_name');
        $courses->course_heading = $request->input('course_heading');
        $courses->who_should_attend_title = $request->input('who_should_attend_title');
        $courses->who_should_attend = $request->input('who_should_attend');
        $courses->special_notes_title = $request->input('special_notes_title');
        $courses->special_notes = $request->input('special_notes');
        $courses->course_overview_title = $request->input('course_overview_title');
        $courses->course_overview = $request->input('course_overview');
        $courses->objectives_of_course_title = $request->input('objectives_of_course_title');
        $courses->objectives_of_course = $request->input('objectives_of_course');
        $courses->course_benefit_title = $request->input('course_benefit_title');
        $courses->course_benefit = $request->input('course_benefit');
        $courses->why_sb_title = $request->input('why_sb_title');
        $courses->why_sb = $request->input('why_sb');
        $courses->course_details_title = $request->input('course_details_title');
        $courses->course_details = $request->input('course_details');
        $courses->save();

        $courses = Courses::all();

        return view('admin_courses.courses.list', ['courses' => $courses, 'message_success' => 'Course is add']);
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
        //  dd("sdf2");
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
        $course = Courses::where('id', $id)->take(1)->get()[0];
        $categories = CourseCategories::all();

        return view('admin_courses.courses.edit', ['course' => $course, 'categories' => $categories]);
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
        $this->validate($request, [
           'course_category_id' => 'required',
           'course_name' => 'required|max:255',
           'course_heading' => 'required|max:255',
           'who_should_attend_title' => 'required|max:255',
           'who_should_attend' => 'required',
           'special_notes_title' => 'required|max:255',
           'who_should_attend' => 'required',
           'who_should_attend_title' => 'required|max:255',
           'special_notes' => 'required',
           'special_notes_title' => 'required|max:255',
           'course_overview_title' => 'required|max:255',
           'course_overview' => 'required',
           'objectives_of_course_title' => 'required|max:255',
           'objectives_of_course' => 'required',
           'course_benefit_title' => 'required|max:255',
           'course_benefit' => 'required',
           'why_sb_title' => 'required|max:255',
           'why_sb' => 'required',
           'course_details_title' => 'required|max:255',
           'course_details' => 'required',
        ]);

        $courses = Courses::find($id);
        $courses->course_category_id = $request->input('course_category_id');
        $courses->course_name = $request->input('course_name');
        $courses->course_heading = $request->input('course_heading');
        $courses->who_should_attend_title = $request->input('who_should_attend_title');
        $courses->who_should_attend = $request->input('who_should_attend');
        $courses->special_notes_title = $request->input('special_notes_title');
        $courses->special_notes = $request->input('special_notes');
        $courses->course_overview_title = $request->input('course_overview_title');
        $courses->course_overview = $request->input('course_overview');
        $courses->objectives_of_course_title = $request->input('objectives_of_course_title');
        $courses->objectives_of_course = $request->input('objectives_of_course');
        $courses->course_benefit_title = $request->input('course_benefit_title');
        $courses->course_benefit = $request->input('course_benefit');
        $courses->why_sb_title = $request->input('why_sb_title');
        $courses->why_sb = $request->input('why_sb');
        $courses->course_details_title = $request->input('course_details_title');
        $courses->course_details = $request->input('course_details');
        $courses->save();

        $courses = Courses::all();

        return redirect()->route('courses.index')->with('message_success', 'Facilitator is update');
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
        Courses::where('id',$id)->delete();
        return redirect()->back()->with(['message_success' => 'Course is remove']);
    }

    public function dataImport()
    {
        //$result = DB::select("SELECT * FROM `sb_course_batch` ");

        /*
        $result = DB::table('sb_course_batch')->get();
        foreach($result as $data)
        {
            dump($data->batch);
            DB::table('course_batches')->insert(
                [     'id' => $data->batch_id
                    , 'course_id' => $data->course_id
                    , 'course_venue_id' => $data->venue_id
                    , 'course_facilitator_id' => $data->faci_id
                    , 'batch_name' => $data->batch
                    , 'c_start_date' => date('Y-m-d',$data->c_start_date).' '.date('H:i:s',strtotime($data->c_start_time))
                    , 'c_end_date' => date('Y-m-d', $data->c_end_date) . ' ' . date('H:i:s', strtotime($data->c_end_time))
                    , 'course_days_oftheweek' => $data->course_days_oftheweek
                    , 'c_reg_last_date' => date('Y-m-d', $data->c_reg_last_date)
                    , 'c_start_time' => date('Y-m-d', $data->c_start_date) . ' ' . date('H:i:s', strtotime($data->c_start_time))
                    , 'c_end_time' => date('Y-m-d', $data->c_end_date) . ' ' . date('H:i:s', strtotime($data->c_end_time))
                    , 'course_duration' => $data->course_duration
                    , 'course_fees' => $data->course_fees
                    , 'course_vat' => $data->course_vat
                    , 'course_discount' => $data->course_discount
                    , 'discounted_course_fees' => $data->discounted_course_fees
                    , 'certificate_status' => $data->certificate_status
                    , 'course_certificate_status' => $data->course_certificate_status
                    , 'num_participants' => $data->num_participants
                    , 'batch_status' => $data->batch_status
                    , 'filled_up' => $data->filled_up
                    , 'previous_event' => $data->previous_event
                    , 'testimonials' => $data->batch_id

                ]
            );
        }
        */

        /*$result = DB::table('sb_course_participants')->get();
        foreach($result as $data)
        {
            dump($data->p_name);
            DB::table('course_participants')->insert(
                [     'id' => $data->p_id
                    , 'course_batch_id' => $data->batch_id
                    , 'p_name' => $data->p_name
                    , 'p_identification_no' => $data->p_identification_no
                    , 'p_email' => $data->p_email
                    , 'p_phone' => $data->p_phone
                    , 'p_address' => $data->p_address
                    , 'p_profession' => $data->p_profession
                    , 'p_organisation' => $data->p_organisation
                    , 'p_designation' => $data->p_designation
                    , 'where_heard' => $data->where_heard
                    , 'p_comments' => $data->p_comments
                    , 'our_comments' => $data->our_comments
                    , 'paid_status' => $data->paid_status
                    , 'p_certificate_status' => $data->p_certificate_status
                    , 'reg_date' => date('Y-m',$data->last_update).'-'.$data->reg_date
                    , 'last_update' => date('Y-m-d', $data->last_update)
                    , 'batch_want' => $data->batch_want
                ]
            );
        }*/

        $result = DB::table('sb_participants_payment')->get();
        foreach ($result as $data) {
            dump($data->payment_amount);
            DB::table('course_participant_payments')->insert(
                ['id' => $data->payment_id
                    , 'course_participant_id' => $data->p_id
                    , 'payment_mr_no' => $data->payment_mr_no
                    , 'payment_type' => $data->p_payment_type
                    , 'payment_amount' => $data->p_payment
                    , 'payment_due' => $data->p_payment_due
                    , 'payment_vat_chalan_no' => $data->p_payment_vat_chalan_no
                    , 'payment_date' => date('Y-m-d H:i:s', $data->p_payment_date)

                ]
            );
        }
        //dd($result);
        exit;
    }
}
