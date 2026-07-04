<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth\LoginController;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Driver\Driver;

class UserController extends Controller
{
    public function index()
    {
        $email = Session::get('email');
        $user = User::getCustomRoute('user/'.$email.'getByEmail');
        dd($user);
        //$user = User::get();

    }
    public function show(string $email)
    {
        //dd($email);
        //$user = User::getOne('/'.Auth::id());
        //dd(Auth::getUser());

    }

}
