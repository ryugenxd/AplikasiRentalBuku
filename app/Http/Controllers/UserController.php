<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): View
    {
        return view('users');
    }
    public function profile(): View
    {
        //dd(Auth::user());
        return view('profile');
    }

}
