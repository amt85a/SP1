<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ApiModel;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $response = ApiModel::loginPost($credentials);
        if ($response->successful()) {
            $token = $response->object()->success->token;
            Session::put('apitoken', $token);
            Session::put('email', $credentials['email']);
            $user = new User($credentials);
            Auth::setUser($user);
            //$userEmail = $credentials['email'];
            //putenv("MAIL_FROM_ADDRESS=$userEmail");
            //dd(getenv("MAIL_FROM_ADDRESS"));
            return to_route('booking.index');
        } else {
            return to_route('login');
        }
    }
}
