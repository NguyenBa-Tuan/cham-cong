<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $createUser = new User;
        $createUser->name = $request->name;
        $createUser->email = $request->email;
        $createUser->password = $request->password;
        $createUser->phone = $request->phone;
        $createUser->address = $request->address;
        $createUser->dayOfBirth = $request->dayOfBirth;
        $createUser->dayOfJoin = $request->dayOfJoin;
        $createUser->role = $request->role;
        $createUser->level = $request->level;
        $createUser->save();
        Mail::to($createUser['email'])->send(new WelcomeMail($createUser));
        return redirect()->route('adminUserIndex');
    }

    public function editPassword($id)
    {
        $user=User::findOrFail($id);
        return view('user.password.edit', compact('user'));
    }

    public function updatePassword($id, Request $request)
    {

        $resetPassword = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
        ]);


        $resetPassword->password = $request->password;

        if($validator->fails()){
            echo 'false';
        }
        else{
            $resetPassword->save();
            return redirect()->route('adminUserIndex');
        }
    }
}
