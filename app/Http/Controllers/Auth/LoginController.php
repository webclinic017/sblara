<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    protected $redirectTo = '/';
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /*protected $redirectTo = '/test';*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        /*if (auth()->check() && auth()->user()->isAdmin()) {
            return 'Admin View.';
        }*/

        return redirect()->intended('/');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        /*login old users*/
        $this->loginOldUser($request);
        // dd($request->all());
        /*login old users*/

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

    //////////////////////////////////////////////////////////////////////    
    if ($this->guard()->validate($this->credentials($request))) {
        $user = $this->guard()->getLastAttempted();

        // Make sure the user is verified
        if ($user->verified && $this->attemptLogin($request)) {
            // Send the normal successful login response
            return $this->sendLoginResponse($request);
        } else {
            // Increment the failed login attempts and redirect back to the
            // login form with an error message.
            $this->incrementLoginAttempts($request);
            return redirect()
                ->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors(['active' => 'Please verify your email.']);
        }
    }
    //////////////////////////////////////////////////////////////////

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function loginOldUser($request)
    {
        $username = $this->username();
        $user = \App\User::where($username, $request->{$username})->where('password', '')->where('password_old', md5($request->password))->where('verified', 1)->first();
        // dd($user);
        if($user)
        {
            $user->password = bcrypt($request->password);
            $user->save();
            \Auth::login($user);
            return redirect()->intended('/');
        }
    }

    public function username()
    {

        if(filter_var(request()->email, FILTER_VALIDATE_EMAIL))
        {
            return 'email';
        }
        if(!isset( request()->username))
        {
            // dd('username');
            $request = request()->all();
            $request['username'] = $request['email'];
            unset($request['email']);
            request()->replace($request);  
        }
        return 'username';
    }
}
