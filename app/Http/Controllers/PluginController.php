<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PluginController extends Controller
{
    public function requests()
    {
    	return view('admin.plugin-requests');
    }
}
