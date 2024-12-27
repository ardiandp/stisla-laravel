<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;


class AuthController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        //dd ($request->all());
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        $request->session()->forget('user');
        return redirect('/');
    }

    public function register(){
        return view('auth.register');
    }

    public function registerPost(Request $request){
        return redirect('/');
    }

    public function profile(){
        return view('auth.profile');
    }
}
