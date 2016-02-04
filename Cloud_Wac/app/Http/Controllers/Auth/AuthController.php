<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public $username = 'username';
    public $redirectPath = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birthdate' => 'required|date|before:tomorrow',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'birthdate' => $data['birthdate'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'admin' => isset($data['admin'])
            ]);
    }

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
                );
        }

        $activation_code = str_random(60) . $request->input('email');
        $user = new User;
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->birthdate = $request->input('birthdate');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->activation_code = $activation_code;

        if ($user->save()) {
            $data = array(
                'name' => $user->name,
                'code' => $activation_code,
                );
            \Mail::queue('emails.activateAccount', $data, function($message) use ($user) {
                $message->to($user->email, 'Please activate your account.');
            });
            return view('user.activateAccount');
        }
        else {
            Flash::message('Your account couldn\'t be create please try again');
            return redirect()->back()->withInput();
        }
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
            ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember, false)) {
            $user = Auth::getLastAttempted();
            if ((int)$user->active === 1) 
            {
                Auth::login($user, $remember);
                return $this->handleUserWasAuthenticated($request, $throttles);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
        ->withInput($request->only($this->loginUsername(), 'remember'))
        ->withErrors([
            $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }
    public function activateAccount($code, User $user)
    {

       if($user->accountIsActive($code)) {
        Flash::message('Success, your account has been activated.');
        return redirect('auth/login');
    }
    Flash::message('Your account couldn\'t be activated, please try again');
    return redirect('/');
}
}
