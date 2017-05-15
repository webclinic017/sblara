<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function changeImage(Request $request)
    {
        File::delete('img/149x149/'.Auth::user()->image);
        File::delete('img/35x35/'.Auth::user()->image);

        $name = uniqid();
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
