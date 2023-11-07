<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {

        return view('auth.index');
    }
    public function login_action(Request $request) {

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id === 1) {
                return redirect()->intended('/admin-dashboard');
            } else {
                return redirect()->intended('/teacher-dashboard');
            }
        }else {
            return back()->with('error', 'Email or password wrong!');
        }
    
    }
}
