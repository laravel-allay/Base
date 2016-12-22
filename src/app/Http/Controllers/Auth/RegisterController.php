<?php

namespace Allay\Base\app\Http\Controllers\Auth;

use Allay\Base\app\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jrean\UserVerification\Facades\UserVerification;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends Controller
{
    protected $data = []; // the information we send to the view

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    use VerifiesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getVerification', 'getVerify', 'getResendVerification']]);

        $this->redirectIfVerified = config('allay.base.route_prefix', 'admin').'/dashboard';
        $this->redirectTo = config('allay.base.route_prefix', 'admin').'/dashboard';
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $user_model_fqn = config('allay.base.user_model_fqn');
        $user = new $user_model_fqn();

        return $user->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        // if registration is closed, deny access
        if (!config('allay.base.registration_open')) {
            abort(403, trans('allay::base.registration_closed'));
        }

        $this->data['title'] = trans('allay::base.register'); // set the page title

        return view('allay::auth.register', $this->data);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // if registration is closed, deny access
        if (!config('allay.base.registration_open')) {
            abort(403, trans('allay::base.registration_closed'));
        }

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        $this->guard()->login($user);

        $emailSubject = \Lang::get('allay::base.user_verification_mail.subject');
        UserVerification::generate($user);
        UserVerification::send($user, $emailSubject);

        return redirect($this->redirectPath());
    }

    /**
     * Show the verification error view.
     *
     * @return Response
     */
    public function getVerify()
    {
        return view('allay::auth.user-verification');
    }

    public function getResendVerification()
    {
        $user = \Auth::user();

        if (!$user) {
            // TODO : redirect to proper route if no user
            exit;
        }

        $emailSubject = \Lang::get('allay::base.user_verification_mail.subject');
        UserVerification::generate($user);
        UserVerification::send($user, $emailSubject);

        return view('allay::auth.resend-user-verification');
    }
}
