<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bug;

class FeedbackController extends Controller
{
    public function index()
    {
        $bug = new Bug;
        $bug->content = request()->feedback;
        $bug->save();
        return 1;
    }
}
