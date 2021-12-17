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
        $this->middleware('checkUser');
    }

    public function index(Request $request)
    {
        if (!$request->month) $request->month = Carbon::now()->month;
        if (!$request->year) $request->year = Carbon::now()->year;

        $date = $request->year . '-' . $request->month;

        $checkID = Auth::user()->id;

        $month = Carbon::now()->format('Y-m');
        $month_get = $month;

        $begin = new \DateTime($date . '-01');
        $end = new \DateTime($date . '-' . Carbon::parse($month_get)->daysInMonth);

        $arrDate = [];
        $key = 0;
        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$key] = $i->format("Y-m-d");
            $key++;
        }
        $listYear = Month::select(DB::raw('SUBSTR(month, 1, 4) as year'))->groupBy('year')->pluck('year');

        $data = DB::table('timesheets')
            ->where('user_id', '=', $checkID)
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)
            ->get();

        $note = DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users', 'timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)
            ->select('notes.note')->distinct()
            ->get();

        $dataX = DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users', 'timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)
            ->where('timesheets.data', '=', 'X')
            ->count('timesheets.data');

        $dataX_2 = DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users', 'timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)
            ->where('timesheets.data', '=', 'X/2')
            ->count('timesheets.data');

        $dataPL = DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users', 'timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)
            ->where('timesheets.data', '=', 'PL')
            ->count('timesheets.data');

        $dataP = DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users', 'timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)
            ->where('timesheets.data', '=', 'P')
            ->count('timesheets.data');

        $dataKP = DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users', 'timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)
            ->where('timesheets.data', '=', 'KP')
            ->count('timesheets.data');

        $total = $dataX - ($dataX_2 / 2) + $dataPL;
        return view('user.timesheet.index', compact('listYear',  'arrDate', 'month', 'data', 'note', 'dataX', 'dataX_2', 'dataPL', 'dataP', 'dataKP', 'total'));
    }
}
