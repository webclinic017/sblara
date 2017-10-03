<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseVenues;

class CourseVenuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_venues = CourseVenues::all();
        return view('admin_courses.venues.list', ['course_venues' => $course_venues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin_courses.venues.create');
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
           'venue_name' => 'required|unique:course_venues,venue_name|max:255',
           'venue_phone' => 'required',
           'venue_mobile' => 'required',
           'venue_email' => 'required|email',
           'venue_address' => 'required',
        ]);

        $venues = new CourseVenues();
        $venues->venue_name = $request->input('venue_name');
        $venues->venue_phone = $request->input('venue_phone');
        $venues->venue_mobile = $request->input('venue_mobile');
        $venues->venue_email = $request->input('venue_email');
        $venues->venue_address = $request->input('venue_address');
        $venues->save();

        $course_venues = CourseVenues::all();

        return view('admin_courses.venues.list', ['course_venues' => $course_venues, 'message_success' => 'Venue successfully added']);
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
        $venues = CourseVenues::where('venue_id', $id)->take(1)->get()[0];

        return view('admin_courses.venues.edit', ['venues' => $venues]);
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
           'venue_name' => 'required',
           'venue_phone' => 'required',
           'venue_mobile' => 'required',
           'venue_email' => 'required|email',
           'venue_address' => 'required',
        ]);

        $venues = CourseVenues::where('venue_id', $id)->update(
          [
            'venue_name' => $request->input('venue_name'),
            'venue_phone' => $request->input('venue_phone'),
            'venue_mobile' => $request->input('venue_mobile'),
            'venue_email' => $request->input('venue_email'),
            'venue_address' => $request->input('venue_address')
          ]
        );
        $course_venues = CourseVenues::all();
        return redirect()->route('venues_course.index')->with('message_success', 'Venue successfully updated');
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
        CourseVenues::where('venue_id',$id)->delete();
        return redirect()->back()->with(['message_success' => 'Venue successfully removed']);
    }
}
