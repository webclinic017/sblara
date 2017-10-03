<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses;
use App\CourseVenues;
use App\CourseFacilitators;
use App\CourseCategories;
use App\CourseBatches;

class CourseManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = CourseBatches::all();
        return view('admin_courses.batches.list', ['batches' => $batches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $courses = Courses::all();
        $venues = CourseVenues::all();
        $facilitators = CourseFacilitators::all();
        // $batches = [
        //   'Workshop','Batch-01','Batch-02','Batch-03','Batch-04','Batch-05','Batch-06','Batch-07','Batch-08','Batch-09','Batch-10',
        //   'Batch-11','Batch-12','Batch-13','Batch-14','Batch-15','Batch-16','Batch-17','Batch-18','Batch-19','Batch-20','Batch-21',
        //   'Batch-22','Batch-23','Batch-24','Batch-25','Batch-26','Batch-27','Batch-28','Batch-29','Batch-30','Batch-31','Batch-32',
        //   'Batch-33','Batch-34','Batch-35','Batch-36','Batch-37','Batch-38','Batch-39','Batch-40','Batch-41','Batch-42','Batch-43',
        //   'Batch-44','Batch-45','Batch-46','Batch-47','Batch-48','Batch-49','Batch-50','Batch-51','Batch-52','Batch-53','Batch-54',
        //   'Batch-55','Batch-56','Batch-57','Batch-58','Batch-59','Batch-60','Batch-61','Batch-62','Batch-63','Batch-64','Batch-65',
        //   'Batch-66','Batch-67','Batch-68','Batch-69','Batch-70'
        // ];
        //
        //SELECT DISTINCT `batch_name` FROM course_batches

        $batches =  CourseBatches::select('batch_name')->distinct()->get();
        return view('admin_courses.batches.create', ['courses' => $courses, 'venues' => $venues, 'facilitators' => $facilitators, 'batches' => $batches]);
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
           'course_id' => 'required',
           'course_venue_id' => 'required',
           'course_facilitator_id' => 'required',
           'batch_name' => 'required|max:10',
           'c_start_date' => 'required',
           'c_end_date' => 'required',
           'course_days_oftheweek' => 'required|max:20',
           'c_reg_last_date' => 'required',
           'c_start_time' => 'required',
           'c_end_time' => 'required',
           'course_duration' => 'required|max:20',
           'course_fees' => 'required',
           'course_discount' => 'required|max:2',
           'course_vat' => 'required',
           'discounted_course_fees' => 'required',
           'batch_status' => 'required',
           'certificate_status' => 'required'
        ]);

        $batch = new CourseBatches();
        $batch->course_id = $request->input('course_id');
        $batch->course_venue_id = $request->input('course_venue_id');
        $batch->course_facilitator_id = $request->input('course_facilitator_id');
        $batch->batch_name = $request->input('batch_name');

        $batch->c_start_date = $request->input('c_start_date');
        $batch->c_end_date = $request->input('c_end_date');
        $batch->course_days_oftheweek = $request->input('course_days_oftheweek');
        $batch->c_reg_last_date = $request->input('c_reg_last_date');

        $batch->c_start_time = $request->input('c_start_time');
        $batch->c_end_time = $request->input('c_end_time');
        $batch->course_duration = $request->input('course_duration');
        $batch->course_fees = $request->input('course_fees');
        $batch->course_discount = $request->input('course_discount');
        $batch->course_vat = $request->input('course_vat');

        $batch->discounted_course_fees = $request->input('discounted_course_fees');
        $batch->batch_status = $request->input('batch_status');
        $batch->certificate_status = $request->input('certificate_status');
        $batch->save();

        $batches = CourseBatches::all();

        return view('admin_courses.batches.list', ['batches' => $batches, 'message_success' => 'Batch successfully added']);
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
        $batch = CourseBatches::find($id);

        return view('admin_courses.batches.show', ['batch' => $batch]);
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
        $course_batch = CourseBatches::where('id', $id)->take(1)->get()[0];
        $courses = Courses::all();
        $venues = CourseVenues::all();
        $facilitators = CourseFacilitators::all();
        // $batches = [
        //   'Workshop','Batch-01','Batch-02','Batch-03','Batch-04','Batch-05','Batch-06','Batch-07','Batch-08','Batch-09','Batch-10',
        //   'Batch-11','Batch-12','Batch-13','Batch-14','Batch-15','Batch-16','Batch-17','Batch-18','Batch-19','Batch-20','Batch-21',
        //   'Batch-22','Batch-23','Batch-24','Batch-25','Batch-26','Batch-27','Batch-28','Batch-29','Batch-30','Batch-31','Batch-32',
        //   'Batch-33','Batch-34','Batch-35','Batch-36','Batch-37','Batch-38','Batch-39','Batch-40','Batch-41','Batch-42','Batch-43',
        //   'Batch-44','Batch-45','Batch-46','Batch-47','Batch-48','Batch-49','Batch-50','Batch-51','Batch-52','Batch-53','Batch-54',
        //   'Batch-55','Batch-56','Batch-57','Batch-58','Batch-59','Batch-60','Batch-61','Batch-62','Batch-63','Batch-64','Batch-65',
        //   'Batch-66','Batch-67','Batch-68','Batch-69','Batch-70'
        // ];
        $batches =  CourseBatches::select('batch_name')->distinct()->get();

        return view('admin_courses.batches.edit', ['course_batch' => $course_batch,'batches' => $batches, 'courses' => $courses, 'venues' => $venues, 'facilitators' => $facilitators]);
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
           'course_id' => 'required',
           'course_venue_id' => 'required',
           'course_facilitator_id' => 'required',
           'batch_name' => 'required|max:10',
           'c_start_date' => 'required',
           'c_end_date' => 'required',
           'course_days_oftheweek' => 'required|max:20',
           'c_reg_last_date' => 'required',
           'c_start_time' => 'required',
           'c_end_time' => 'required',
           'course_duration' => 'required|max:20',
           'course_fees' => 'required',
           'course_discount' => 'required|max:2',
           'course_vat' => 'required',
           'discounted_course_fees' => 'required',
           'batch_status' => 'required',
           'certificate_status' => 'required'
        ]);

        $batch = CourseBatches::find($id);
        $batch->course_id = $request->input('course_id');
        $batch->course_venue_id = $request->input('course_venue_id');
        $batch->course_facilitator_id = $request->input('course_facilitator_id');
        $batch->batch_name = $request->input('batch_name');

        $batch->c_start_date = $request->input('c_start_date');
        $batch->c_end_date = $request->input('c_end_date');
        $batch->course_days_oftheweek = $request->input('course_days_oftheweek');
        $batch->c_reg_last_date = $request->input('c_reg_last_date');

        $batch->c_start_time = $request->input('c_start_time');
        $batch->c_end_time = $request->input('c_end_time');
        $batch->course_duration = $request->input('course_duration');
        $batch->course_fees = $request->input('course_fees');
        $batch->course_discount = $request->input('course_discount');
        $batch->course_vat = $request->input('course_vat');

        $batch->discounted_course_fees = $request->input('discounted_course_fees');
        $batch->batch_status = $request->input('batch_status');
        $batch->certificate_status = $request->input('certificate_status');
        $batch->save();

        return redirect()->route('batches.index')->with('message_success', 'Batch successfully updated');
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
        return redirect()->back()->with(['message_success' => 'Batch successfully removed']);
    }
}
