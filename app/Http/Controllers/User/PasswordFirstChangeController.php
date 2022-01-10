<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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

    public function update(Request $request, $id)
    {
        $reset = User::find($id);
        $reset->password = $request->password;
        $check = $reset->save();
        if ($check) {
            DB::table('password_resets')->where('email', $reset->email)->delete();
            return redirect('login');
        } else return redirect('reset_password_index');
    }

    protected function tokenExpired($createdAt){
        return Carbon::parse($createdAt)->addSeconds($this->expires)->isPast();
    }
}
