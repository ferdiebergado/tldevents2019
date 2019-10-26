<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @inheritDoc
     */
    protected function authenticated(Request $request, $user)
    {
        $user->timestamps = false;
        $user->update([
            'last_login_at' => now()->toDateTimeString(),
            'last_login_ip' => $request->ip()
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function loggedOut(Request $request)
    {
        $response = new RedirectResponse('/');

        $response->header('Pragma', 'no-cache');
        $response->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        $response->header('Cache-Control', 'no-cache, must-revalidate, no-store, max-age=0, private');

        return $response;
    }
}
