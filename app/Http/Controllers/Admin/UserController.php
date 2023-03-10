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
use App\Models\Level;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $levels = Level::orderBy('id', 'DESC')->get();

        if ($request->active == 'sheet') {
            $users = User::orderBy('id', 'DESC')->get();

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
        $createUser->role = $request->role;
        $createUser->salary_per_day = $request->salary_per_day;
        $createUser->save();

        // $setToken = DB::table('password_resets')->insert([
        //     'email' => $createUser->email,
        //     'token' => Str::random(60),
        //     'created_at' => Carbon::now(),
        //     'expire_at' => Carbon::now()->addHours(24),
        // ]);

        // $token_data = DB::table('password_resets')->where('email', $createUser->email)->first();
        // if (!$token_data) return redirect()->to('login');

        // Mail::to($createUser['email'])->send(new WelcomeMail($createUser, $token_data));
        return redirect()->route('adminUserIndex')->with('message', __('????ng k?? t??i kho???n th??nh c??ng!'));
    }

    public function edit(User $user, Request $request)
    {
        $levels = Level::orderBy('id', 'DESC')->get();

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
        $user->role = $request->role;
        $user->salary_per_day = $request->salary_per_day;

        if ($request->password)
            $user->password = $request->password;

        $user->save();

        // Mail::to($createUser['email'])->send(new WelcomeMail($createUser));
        return redirect()->back()->with('message', __('C???p nh???t t??i kho???n th??nh c??ng!'));
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('adminUserIndex')->with('message', __('X??a t??i kho???n th??nh c??ng!'));
    }
}
