<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsChartController extends Controller
{
    public function index($ticker)
    {
    	return view('news-chart');
    }
}
