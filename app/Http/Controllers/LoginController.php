<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            if (Auth::user()->role == UserRole::ADMIN) {
                return redirect()->route('admin_index');
            } else {
                return redirect()->route('user_index');
            }
        }
        return view('auth.login');
    }

    public function login(LoginFormRequest $request)
    {
        $login = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($login)) {
            if (Auth::user()->role == 0) {
                return redirect()->route('admin_index');
            } else {
                return redirect()->route('user_index');
            }
        } else {
            return redirect()->route('login')->with('alert', __('Email hoặc mật khẩu nhập vào không đúng, xin mời nhập lại!'));
        }
        return redirect("login");
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
