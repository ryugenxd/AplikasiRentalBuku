<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index(): View
    {

        $users = User::all();
        return view('users',compact('users'));
    }
    public function profile(string $slug): View
    {
        //dd(Auth::user());
        return view('profile');
    }

    public function updated(Request $request): RedirectResponse
    {
        return back();
    }

    public function delete(): RedirectResponse
    {
        return back();
    }

}
