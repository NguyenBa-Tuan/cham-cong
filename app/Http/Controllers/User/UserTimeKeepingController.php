<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Month;
use App\Models\Timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserTimeKeepingController extends Controller
{
    public function __construct()
    {
        // $this->middleware('checkUser');
    }

    public function index(Request $request)
    {
        if (!$request->month) $request->month = Carbon::now()->month  < 10 ? '0' . Carbon::now()->month : Carbon::now()->month;
        if (!$request->year) $request->year = Carbon::now()->year;

        $date = $request->year . '-' . $request->month;

        $checkID = Auth::user()->id;

        $listYear = Month::select(DB::raw('SUBSTR(month, 1, 4) as year'))->groupBy('year')->pluck('year')->toArray();

        if (!in_array(Carbon::now()->year, $listYear)) {
            array_push($listYear, Carbon::now()->year);
        }

        sort($listYear);



        $begin = new \DateTime($date . '-01');
        $end = new \DateTime($date . '-' . Carbon::parse($date)->daysInMonth);

        $arrDate = [];
        $key = 0;
        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$key] = $i->format("Y-m-d");
            $key++;
        }

        $listYear = Month::select(DB::raw('SUBSTR(month, 1, 4) as year'))->groupBy('year')->pluck('year')->toArray();

        if (!in_array(Carbon::now()->year, $listYear)) {
            array_push($listYear, Carbon::now()->year);
        }

        sort($listYear);

        $data = DB::table('timesheets')
            ->where('user_id', '=', $checkID)
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)
            ->get();

        $count_total = DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users', 'timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)
            ->select('notes.note', 'notes.total', 'notes.full_job', 'notes.half_job', 'notes.np', 'notes.kp', 'notes.ncl')->distinct()
            ->get();
        return view('user.timesheet.index', compact('listYear',  'arrDate', 'data', 'count_total'));
    }
}
