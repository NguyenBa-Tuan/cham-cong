<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Overtime;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserOverTimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkUser');
    }

    public function index()
    {
        $monthList = DB::table('overtimes')
            ->select(DB::raw('DATE_FORMAT(date, "%m-%Y") as collect'))
            ->where('user_id', '=', Auth::id())
            ->orderBy('collect', 'DESC')
            ->distinct()
            ->get();

        $data = Overtime::where('user_id', Auth::id())
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->orderby('date', 'DESC')
            ->get();
        return view('user.overtime.index', compact('data', 'monthList'));
    }

    public function mount($month)
    {
        $monthList = DB::table('overtimes')
            ->select(DB::raw('DATE_FORMAT(date, "%m-%Y") as collect'))
            ->where('user_id', '=', Auth::id())
            ->orderBy('collect', 'DESC')
            ->distinct()
            ->get();

        $data = DB::table('overtimes')
            ->where(DB::raw('DATE_FORMAT(date, "%m-%Y")'), $month)
            ->where('user_id', '=', Auth::id())
            ->get();

        return view('user.overtime.index', compact('data', 'month', 'monthList'));
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
