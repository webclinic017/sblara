<?php

namespace App\Http\Controllers\Passport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PassportController extends Controller
{
    /**
     * Display the page to manage passport clients.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('passport.show');
    }
}
