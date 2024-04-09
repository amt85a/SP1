<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        //$user = User::get();
        dd(Auth::id());

    }
    public function show()
    {
        $user = User::getOne('/'.Auth::id());
        dd($user);

    }

}
