<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Overtime;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserOverTimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkUser');
    }

    public function index()
    {
        $data = Overtime::where('user_id', Auth::id())->get();
        return view('user.overtime.index', compact('data'));
    }

    public function create()
    {
        return view('user.overtime.create');
    }

    public function store(Request $request)
    {
        $create = new Overtime();
        $create->user_id = Auth::id();
        $create->date = $request->date;
        $create->checkin = Carbon::parse($request->checkin);
        $create->checkout = Carbon::parse($request->checkout);
        $create->totalTime = $create->checkout->diff($create->checkin)->format('%H:%I:%S');
        $create->note = $request->note;
        $create->projectName = $request->projectName;
        $create->save();
        return redirect()->route('user_overtime');
    }
}
