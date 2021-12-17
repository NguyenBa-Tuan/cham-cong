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

    public function index(Request $request)
    {
        if (!$request->month) $request->month = Carbon::now()->month;
        if (!$request->year) $request->year = Carbon::now()->year;

        $date = $request->year . '-' . $request->month;
        $listYear=Overtime::select(DB::raw('SUBSTR(date, 1, 4) as year'))->groupBy('year')->pluck('year');

//        $month_get = Carbon::now()->format('Y-m');

        $from = $date . '-01';

        $to = $date . '-' . Carbon::parse($date)->daysInMonth;

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

        $data = Overtime::where('user_id', Auth::id())
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)
//            ->whereMonth('date', Carbon::now()->month)
//            ->whereYear('date', Carbon::now()->year)
            ->orderby('date', 'DESC')
            ->get();

        $count = Overtime::where('user_id', Auth::id())
            ->select('totalTime')
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)
//            ->whereMonth('date', Carbon::now()->month)
//            ->whereYear('date', Carbon::now()->year)
            ->sum(DB::raw("TIME_TO_SEC(totalTime)"));

        $h = floor($count / 60 / 60);
        $m = $count / 60 % 60;
        $getTotal = "$h" . ":" . "$m";


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
        return view('user.overtime.index', compact('listYear', 'data', 'arrDate', 'arrCheckin', 'arrCheckout', 'arrTotalTime', 'arrProjectName', 'arrNote', 'getTotal'));
    }

//    public function mount($month)
//    {
//        $monthList = DB::table('overtimes')
//            ->select(DB::raw('DATE_FORMAT(date, "%m-%Y") as collect'))
//            ->where('user_id', '=', Auth::id())
//            ->orderBy('collect', 'DESC')
//            ->distinct()
//            ->get();
//
//        $data = DB::table('overtimes')
//            ->where(DB::raw('DATE_FORMAT(date, "%m-%Y")'), $month)
//            ->where('user_id', '=', Auth::id())
//            ->get();
//
//        return view('user.overtime.index', compact('data', 'month', 'monthList'));
//    }

    public function create()
    {
        return view('user.overtime.create');
    }

    public function store(Request $request)
    {
        $create = new Overtime();
        $create->user_id = Auth::id();
        $create->date = Carbon::parse($request->date)->format('Y-m-d');
        $create->checkin = Carbon::parse($request->checkin);
        $create->checkout = Carbon::parse($request->checkout);
        $create->totalTime = $create->checkout->diff($create->checkin)->format('%H:%I:%S');
        $create->note = $request->note;
        $create->projectName = $request->projectName;
        $create->save();
        return redirect()->route('user_overtime');
    }
}
