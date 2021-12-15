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
        $month_get = Carbon::now()->format('Y-m');

        $from = $month_get . '-01';
<<<<<<< HEAD
=======

        $to = $month_get . '-' . Carbon::parse($month_get)->daysInMonth;

        $begin = new \DateTime($from);
        $end = new \DateTime($to);
        $arrDate = [];
        $arrCheckin = [];
        $arrCheckout = [];
        $arrTotalTime = [];
        $arrProjectName = [];
        $arrNote = [];

        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$i->format("Y-m-d")] = $i->format("Y-m-d");
            $arrCheckin[$i->format("Y-m-d")] = false;
            $arrCheckout[$i->format("Y-m-d")] = false;
            $arrTotalTime[$i->format("Y-m-d")] = false;
            $arrProjectName[$i->format("Y-m-d")] = false;
            $arrNote[$i->format("Y-m-d")] = false;
        }
>>>>>>> 7cb24b7 (fe user)

        $to = $month_get . '-' . Carbon::parse($month_get)->daysInMonth;

        $begin = new \DateTime($from);
        $end = new \DateTime($to);
        $arrDate = [];
        $key = 0;
        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$key] = $i->format("Y-m-d");
            $key++;
        }
        $data = Overtime::where('user_id', Auth::id())
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->orderby('date', 'DESC')
            ->get();
<<<<<<< HEAD

        return view('user.overtime.index', compact('data', 'arrDate'));
=======
        $count = Overtime::where('user_id', Auth::id())
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->select('totalTime')->get();

        foreach ($data as $item) {
            $arrCheckin[$item->date] = [
                'checkin' => $item->checkin,
            ];
        }

        foreach ($data as $item) {
            $arrCheckout[$item->date] = [
                'checkout' => $item->checkout,
            ];
        }

        foreach ($data as $item) {
            $arrTotalTime[$item->date] = [
                'totalTime' => $item->totalTime,
            ];
        }

        foreach ($data as $item) {
            $arrProjectName[$item->date] = [
                'projectName' => $item->projectName,
            ];
        }

        foreach ($data as $item) {
            $arrNote[$item->date] = [
                'note' => $item->note,
            ];
        }

        return view('user.overtime.index', compact('data', 'arrDate', 'arrCheckin', 'arrCheckout', 'arrTotalTime', 'arrProjectName', 'arrNote'));
>>>>>>> 7cb24b7 (fe user)
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
