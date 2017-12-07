<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewspaperNews;

class newspaperNewsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $news = NewspaperNews::all();
        return view('admin_newspaper_news.list', ['news' => $news]);
    }
    
    public function collectiveNews(){
        $news = NewspaperNews::all();
        return view('newspaper_news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('admin_newspaper_news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $this->validate($request, [
            'title' => 'required',
            'details' => 'required',
            'published_date' => 'required|date',
        ]);

        $news = new NewspaperNews();
        $news->title = $request->input('title');
        $news->details = $request->input('details');
        $news->published_date = date("Y-m-d", strtotime($request->input('published_date')));
        $news->save();

        $news = NewspaperNews::all();

        return view('admin_newspaper_news.list', ['news' => $news, 'message_success' => 'News successfully added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        //  dd("sdf2");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $news = NewspaperNews::where('id', $id)->take(1)->get()[0];

        return view('admin_newspaper_news.edit', ['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $this->validate($request, [
            'title' => 'required',
            'details' => 'required',
            'published_date' => 'required|date',
        ]);
        $news = NewspaperNews::where('id', $id)->update(
                [
                    'title' => $request->input('title'),
                    'details' => $request->input('details'),
                    'published_date' => date("Y-m-d", strtotime($request->input('published_date'))),
                ]
        );
        $news = NewspaperNews::all();
        return view('admin_newspaper_news.list', ['news' => $news, 'message_success' => 'News successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        NewspaperNews::where('id', $id)->delete();
        return redirect()->back()->with(['message_success' => 'News successfully removed']);
    }

}
