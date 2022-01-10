<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PasswordFirstChangeController extends Controller
{
    public function index($token)
    {
        $user = DB::table('users')->select('password')
            ->join('password_resets', 'password_resets.email', '=', 'users.email')
            ->select('users.email', 'password_resets.token', 'users.id', 'password_resets.expire_at')
            ->where('password_resets.token', $token)->first();
        if (!$user || Carbon::now()->greaterThan($user->expire_at)) return abort(404);
        return view('user.password.edit', compact('user'));
    }

    public function update(ResetPasswordFormRequest $request, $id)
    {
        $reset = User::find($id);
        $reset->password = $request->password;
        $check = $reset->save();
        if ($check) {
            DB::table('password_resets')->where('email', $reset->email)->delete();
            return redirect()->route('login')->with('success', 'Bạn đã đổi mật khẩu thành công, bạn hãy login để đăng nhập hệ thống!');
        } else return redirect()->route('reset_password_index')->with('warning', 'Có lỗi!');
    }
}
