<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserLevel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $levels = UserLevel::toSelectArray();

        if ($request->active == 'sheet') {
            $users = User::all();

            return view('admin.user.index', compact('levels', 'users'));
        }

        return view('admin.user.index', compact('levels'));
    }

    public function store(CreateUserRequest $request)
    {
        $createUser = new User;
        $createUser->name = $request->name;
        $createUser->username = $request->username;
        $createUser->email = $request->email;
        $createUser->password = $request->password;
        $createUser->phone = $request->phone;
        $createUser->address = $request->address;
        $createUser->dayOfBirth = $request->dayOfBirth;
        $createUser->dayOfJoin = $request->dayOfJoin;
        $createUser->level = $request->level;
        $createUser->user_id = $request->user_id;
        $createUser->save();

        // Mail::to($createUser['email'])->send(new WelcomeMail($createUser));
        return redirect()->route('adminUserIndex')->with('message', __('Đăng ký tài khoản thành công!'));
    }

    public function edit(User $user, Request $request)
    {
        $levels = UserLevel::toSelectArray();

        return view('admin.user.index', compact('levels', 'user'));
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->dayOfBirth = $request->dayOfBirth;
        $user->dayOfJoin = $request->dayOfJoin;
        $user->level = $request->level;
        $user->user_id = $request->user_id;

        if ($request->password)
            $user->password = $request->password;

        $user->save();

        // Mail::to($createUser['email'])->send(new WelcomeMail($createUser));
        return redirect()->back()->with('message', __('Cập tài khoản thành công!'));
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('adminUserIndex')->with('message', __('Xóa tài khoản thành công!'));
    }
}
