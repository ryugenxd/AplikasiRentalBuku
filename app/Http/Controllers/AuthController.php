<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('login');
    }

    public function login_authentication(Request $request): RedirectResponse
    {
        $credentials = $request -> validate([
            'username'=>['required'],
            'password'=>['required']
        ]);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            if($user->status != 'active'){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Session::flash('status','failed');
                Session::flash('message','Your account is not active. please contact admin!');
                return redirect()->route('login');
            }
            $request->session()->regenerate();
            if($user->role_id === 1){
                return redirect()->route('dashboard');
            }else if($user->role_id === 2){
                return redirect()->route('profile');
            }
        }

        Session::flash('status','failed');
        Session::flash('message','Login invalid');
        // dd($request);
        return redirect()->route('login');
    }

    public function register(): View
    {
        return view('register');
    }

    public function register_authentication(Request $request): RedirectResponse
    {
        $validated = $request -> validate([
            'username'=>'required|unique:users',
            'password'=>'required|min:8',
            'phone'=>'nullable|max:100',
            'address'=>'required'
        ]);
        $validated['password'] = bcrypt($validated['password']);
        // dd($validated);
        User::create($validated);
        Session::flash("message","Registrasi Berhasil Di Lakukan");
        return redirect()->route('register');
    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
