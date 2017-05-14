<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userInformationChange()
    {
        return view('user.index');
    }

    public function userNameChange()
    {

        $user = User::find(Auth::user()->id);
        $user->name = request('name');
        $user->save();

        return redirect()->back();
    }

    public function passwordChange()
    {
        if (Hash::check(request('password'), Auth::user()->password)) {
            if (request('newPassword') == request('rePassword')) {
                $user = User::find(Auth::user()->id);
                $user->password = bcrypt(request('newPassword'));
                $user->save();
            }
        }

        return redirect()->back();
    }
}
