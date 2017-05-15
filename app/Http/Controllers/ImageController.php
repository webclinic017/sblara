<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function changeImage(Request $request)
    {
        $name = uniqid(). $request->file('image')->getClientOriginalName();
        $img = Image::make($request->file('image')->getRealPath());
        $img->resize(149, 149);
        $img->save("img/149x149/".$name);
        $img = Image::make($request->file('image')->getRealPath());
        $img->resize(35, 35);
        $img->save("img/35x35/".$name);
        $user = User::find(Auth::user()->id);
        $user->image = $name;
        $user->save();

        return redirect()->back();
    }
}
