<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getlogin()
    {
        return view("login");
    }
    public function getregister()
    {
        return view("register");
    }

    public function dologin(Request $request)
    {
        $credentials = ['password' => $request->password];

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->username;
        } else {
            $credentials['username'] = $request->username;
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status != 1) {
                return redirect()->route('website.getlogin')->with('message', 'Tài khoản chưa kích hoạt');
            }
            return redirect()->route('site.home')->with('message', 'Đăng nhập thành công');
        }

        return redirect()->route('website.getlogin')->with('message', 'Đăng nhập thất bại');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('site.home');
    }
}
