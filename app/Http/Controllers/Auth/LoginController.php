<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function loginForm()
    {
        return view('admin.login');
    }

    public function employerLoginForm()
    {
        return view('employer.auth.login');
    }

    public function employerLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $filedType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ($this->guard()->attempt([$filedType => $request->username, 'password' => $request->password], $request->boolean('remember'))) {
            // if (auth()->attempt(array($filedType => $request->username, 'password' => $request->password))); {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
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
        //for super admin
        if (Auth::user()->hasRole('super-admin')) {
            if (Auth::user()->suspended == 1) {
                return to_route('login')->with('error', 'Your Account has been suspended');
            }
            return redirect()->route('admin.dashboard');
        }
        
        // for employer
        if (Auth::user()->hasRole('employer')) {
            if (@$request->redirect_to) {
                return to_route($request->redirect_to);
            }
            return redirect()->route('employers.index');
        }

        // for job seeker
        if (Auth::user()->hasRole('job-seeker')) {
            if (url()->previous() == route('index') . '/') {
                return to_route('user.dashboard', auth()->user()->username)->with('status', 'Logged In Successfully');
            } else {
                return back()->with('status', 'Logged In Successfully');
            }
        }
    }
}