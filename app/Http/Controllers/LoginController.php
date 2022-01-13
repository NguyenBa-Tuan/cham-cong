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
            if (Auth::user()->role == UserRole::ADMIN)
                return redirect()->route('admin_index');
            else return redirect()->route('user_timesheet');
        }
        return view('auth.login');
    }

    public function login(LoginFormRequest $request)
    {
        $input = $request->all();

        $fieldTypeID = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_id';
        $fieldTypeUsername = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt(array($fieldTypeUsername => $input['email'], 'password' => $input['password'])) || Auth::attempt(array($fieldTypeID => $input['email'], 'password' => $input['password']))) {
            if (Auth::user()->role == 0) {
                return redirect()->route('admin_index');
            } else {
                return redirect()->route('user_timesheet');
            }
        } else {
            return redirect()->route('login')->with('alert', __('Email hoặc mật khẩu không chính xác!'));
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
