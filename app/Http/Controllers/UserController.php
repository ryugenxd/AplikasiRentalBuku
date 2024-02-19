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
    public function profile(): View
    {
        
        return view('profile');
    }

    public function disapproved(): View
    {
        $users = User::latest()->where('status','inactive')->get();
        return view('user_disapproved_list',compact('users'));
    }

    public function approved(string $slug): RedirectResponse
    {
        $user = User::where('status','inactive')->firstOrFail();
        $user -> status = 'active';
        $user -> save();
        return back();
    }

 
    public function update(): View
    {
        return view('edit_user');
    }

    public function updated(Request $request): RedirectResponse
    {
        $validated = $request -> validate([
            'username'=>'nullable|unique:users',
            'password'=>'nullable|min:8',
            'phone'=>'nullable|max:100',
            'address'=>'nullable|max:100'
        ]);

        if($request->has('password')){
            $validated['password'] = bcrypt($validated['password']);
        }else{
            unset($validated['password']);
        }
        if(!$request->has('username')){
            unset($validated['username']);
        }

        if(!$request->has('phone')){
            unset($validated['phone']);
        }

        if(!$request->has('address')){
            unset($validated['address']);
        }

        if(!isset($validated)){
            Session::flash('message','Input must be null');
        }else{
            $user = User::where('id',$request->id)->firstOrFail();
            $user -> fill($validated);
            $user -> save();
            Session::flash('message','User Has Been Updated');
        }
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
        Session::flash('message','User Has Been Restored');
        return back();
    }

}
