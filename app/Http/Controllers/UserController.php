<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserLevel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkUser');
    }

//    public function index()
//    {
//        $user = Auth::user();
//        return view('user.index', compact('user'));
//    }

    public function edit()
    {
        $user = Auth::user();
        $levels = UserLevel::toSelectArray();
        return view('user.edit', compact('user', 'levels'));
    }

    public function update(EditUserFormRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->dayOfBirth = $request->dayOfBirth;
        $user->dayOfJoin = $request->dayOfJoin;
        $user->level = $request->level;
        $user->save();
        return redirect()->route('user_edit');
    }
}
