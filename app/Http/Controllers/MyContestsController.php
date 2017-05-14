<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyContestsController extends Controller
{
    public function index()
    {
    	return view('my_contests.index');
    }
}
