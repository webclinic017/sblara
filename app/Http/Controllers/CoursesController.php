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
}
