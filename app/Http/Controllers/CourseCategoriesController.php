<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseCategories;

class CourseCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_categories = CourseCategories::all();
        return view('admin_courses.category.list', ['course_categories' => $course_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin_courses.category.create');
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
           'category' => 'required|unique:course_categories,course_cat|max:255',
        ]);

        $category = new CourseCategories();
        $category->course_cat = $request->input('category');
        $category->save();

        $course_categories = CourseCategories::all();

        return view('admin_courses.category.list', ['course_categories' => $course_categories, 'message_success' => 'Category successfully added']);
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
          dd("sdf2");
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
        $category = CourseCategories::find($id);

        return view('admin_courses.category.edit', ['category' => $category]);
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
           'category' => 'required|unique:course_categories,course_cat|max:255',
        ]);

        $category = CourseCategories::find($id);
        $category->course_cat = $request->input('category');
        $category->save();

        $course_categories = CourseCategories::all();
        return redirect()->route('categories_course.index')->with('message_success', 'Category successfully updated');
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
        CourseCategories::find($id)->delete();
        return redirect()->back()->with(['message_success' => 'Category successfully removed']);
    }
}
