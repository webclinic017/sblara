<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Screener;
class ScreenerController extends Controller
{
	public function index()
	{
		return view('screener.index');
	}

	public function show($slug = null)
	{
		if(!$slug){return $this->index();}
	    $screener = \App\Screener::where('slug', $slug)->first();
	    return view('screener.screener')->with(compact('screener'));		
	}

	public function save()
	{
		if(request()->has('id'))
		{
			//update
			$screener = Screener::findOrFail(request()->id);
			$screener->query = request()->get('query');
			$screener->save();
			return redirect()->back()->with(['success' => 'Screener successfully updated.']);
		}
	    $data = request()->except('_token');
	    $slug = str_slug($data['title']);
	    $data['user_id'] = request()->user()->id;
	    $c = \App\Screener::where('slug', $slug)->count();
	    if($c != 0)
	    {
	        $slug .= "-".$c;
	    }
	    $data['slug'] = $slug;
	    \App\Screener::forceCreate($data);
	    return redirect('/screeners/'.$slug)->with(['success' => 'Screener successfully saved.']);	
	}

	public function create()
	{
		return view('screener.screener')->with(['screener' => false]);
	}

	public function result()
	{
	    if(request()->has('q'))
	    {
	         $screener = new \App\Classes\Screener(base64_decode(str_replace(" ", "+", request()->q)));
	         return view('screener.result')->with(compact('screener'));
	    }
	}
}
