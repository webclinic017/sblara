<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MyApiLoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            // Authentication passed...


            $user = Auth::user();

            if ($user->role_id == 3) {
                $request->request->add([
                    'scope' => 'paid-plugin-data' // correct scope sending
                ]);
            } else {
                $request->request->add([
                    'scope' => 'not-allowed' // incorrect scope sending so that invalid_scope error return
                ]);
            }


            // forward the request to the oauth token request endpoint
            $tokenRequest = Request::create(
                '/oauth/token',
                'post'
            );
            return Route::dispatch($tokenRequest);


            return redirect()->intended('dashboard');
        }
    }
}
