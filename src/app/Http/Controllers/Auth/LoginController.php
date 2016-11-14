<?php

namespace Vice\Base\app\Http\Controllers\Auth;

use Vice\Base\app\Http\Controllers\Controller;
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

        $this->loginPath = config('vice.base.route_prefix', 'admin').'/login';
        $this->redirectTo = config('vice.base.route_prefix', 'admin').'/dashboard';
        $this->redirectAfterLogout = config('vice.base.route_prefix', 'admin');
    }

    // -------------------------------------------------------
    // Laravel overwrites for loading vice views
    // -------------------------------------------------------

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $this->data['title'] = trans('vice::base.login'); // set the page title

        return view('vice::auth.login', $this->data);
    }
}
