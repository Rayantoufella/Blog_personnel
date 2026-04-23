<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentails = $request->only('email','password');
        if(Auth::attempt($credentails))
        {
            return redirect('/dashboard');
        }
        return back()->with('error','credentials invalides');
    }

    public function logout(){
        Auth::logout();
        return redirect('/'); 
        
    }
}
