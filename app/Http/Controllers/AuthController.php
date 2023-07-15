<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Phương thức hiển thị form đăng nhập
    public function login()
    {
        return view('frontend.auth.login');
    }

    // Phương thức xử lý đăng nhập
    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/account');
        }

        return redirect()->back()->with('errors','Invalid email or password');
    }

    // Phương thức xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
