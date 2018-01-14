<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordChangeFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userInformationChange()
    {
        return response()-> view('user.index');
    }

    public function userNameChange()
    {

        $user = User::find(Auth::user()->id);
        $user->name = request('name');
        $user->save();

        return redirect()->back();
    }

    public function passwordChange(UserPasswordChangeFormRequest $request)
    {


        if (Hash::check(request('password'), Auth::user()->password)) {
            if (request('newPassword') == request('rePassword')) {
                $user = User::find(Auth::user()->id);
                $user->password = bcrypt(request('newPassword'));
                $result = $user->save();
                if($result){
                    $request->session()->flash('type', 'success');
                    $request->session()->flash('msg', 'Your password has been successfully changed.');
                }

            }
        } else {
            $request->session()->flash('type', 'error');
            $request->session()->flash('msg', 'Previous password incorrect');
        }

        return redirect()->back();
    }
}
