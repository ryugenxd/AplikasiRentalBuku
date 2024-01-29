<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index(): View
    {

        $users = User::where('role_id',2)->get();
        return view('users',compact('users'));
    }
    public function profile(string $slug): View
    {
        //dd(Auth::user());
        return view('profile');
    }

    public function create(): View
    {
        return view('add_user');
    }

    public function add(Request $request): RedirectResponse
    {
        return back();
    }

    public function update(): View
    {
        return view('edit_user');
    }

    public function updated(Request $request): RedirectResponse
    {
        return back();
    }

    public function deleted(): View
    {
        $users = User::onlyTrashed()->get();
        return view('users_deleted',compact('users'));
    }

    public function delete(string $slug): RedirectResponse
    {
        $user = User::where('slug',$slug)->firstOrFail();
        $user -> delete();
        Session::flash('message','User Has Been Banned');
        return back();
    }

    public function restore(string $slug): RedirectResponse
    {
        $user = User::withTrashed() -> where('slug', $slug);
        $user -> restore();
        return back();
    }

}
