<?php

namespace Allay\Base\app\Http\Controllers\Auth;

use Allay\Base\app\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    protected $data = []; // the information we send to the view

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    // if not logged in redirect to
    protected $loginPath = 'admin/login';
    
    // after you've logged in redirect to
    protected $redirectTo = 'admin/dashboard';
    
    // after you've logged out redirect to
    protected $redirectAfterLogout = 'admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

        $this->loginPath = config('allay.base.route_prefix', 'admin').'/login';
        $this->redirectTo = config('allay.base.route_prefix', 'admin').'/dashboard';
        $this->redirectAfterLogout = config('allay.base.route_prefix', 'admin');
    }

    // -------------------------------------------------------
    // Laravel overwrites for loading allay views
    // -------------------------------------------------------

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $this->data['title'] = trans('allay::base.login'); // set the page title

        return view('allay::auth.login', $this->data);
    }
}
