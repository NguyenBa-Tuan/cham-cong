<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserTimeKeepingController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkUser');
    }

    public function index()
    {
        $d = Auth::user()->id;
        $data = User::where('id', $d)->get();
        $check=Timesheet::where('user_id', $d)->first();

        return view('user.timesheet.index', compact('data', 'check'));
    }
}
