<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseFacilitators;

class CourseFacilitatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_facilitators = CourseFacilitators::all();
        return view('admin_courses.facilitators.list', ['course_facilitators' => $course_facilitators]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin_courses.facilitators.create');
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
           'faci_name' => 'required|unique:course_facilitators,faci_name|max:255',
           'faci_designation' => 'required',
           'faci_profile' => 'required',
        ]);

        $facilitator = new CourseFacilitators();
        $facilitator->faci_name = $request->input('faci_name');
        $facilitator->faci_designation = $request->input('faci_designation');
        $facilitator->faci_profile = $request->input('faci_profile');
        $facilitator->save();

        $course_facilitators = CourseFacilitators::all();

        return view('admin_courses.facilitators.list', ['course_facilitators' => $course_facilitators, 'message_success' => 'Category is add']);
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
        $facilitator = CourseFacilitators::where('id', $id)->take(1)->get()[0];

        return view('admin_courses.facilitators.edit', ['facilitator' => $facilitator]);
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
           'faci_name' => 'required|max:255',
           'faci_designation' => 'required',
           'faci_profile' => 'required',
        ]);

        $venues = CourseFacilitators::where('id', $id)->update(
          [
            'faci_name' => $request->input('faci_name'),
            'faci_designation' => $request->input('faci_designation'),
            'faci_profile' => $request->input('faci_profile')
          ]
        );

        return redirect()->route('facilitators_course.index')->with('message_success', 'Facilitator is update');
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
        CourseFacilitators::where('id',$id)->delete();
        return redirect()->back()->with(['message_success' => 'Category is remove']);
    }
}
