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

    public function index()
    {
        $checkID = Auth::user()->id;

        $month=Carbon::now()->format('Y-m');
        $month_get = $month;

        $from = $month_get . '-01';
        $to = $month_get . '-' . Carbon::parse($month_get)->daysInMonth;

        $begin = new \DateTime($from);
        $end = new \DateTime($to);
        $arrDate = [];
        $key = 0;
        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$key] = $i->format("Y-m-d");
            $key++;
        }
        $find_month=Month::where('month', $month)->first();

        $data = DB::table('timesheets')
            ->where('user_id', '=', $checkID)
            ->where('month_id', '=', $find_month->id)
            ->get();

        $note = DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $find_month->id)
            ->select('notes.note')->distinct()
            ->first();

        $dataX= DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $find_month->id)
            ->where('timesheets.data', '=', 'X')
            ->count('timesheets.data');

        $dataX_2= DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $find_month->id)
            ->where('timesheets.data', '=', 'X/2')
            ->count('timesheets.data');

        $dataPL= DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $find_month->id)
            ->where('timesheets.data', '=', 'PL')
            ->count('timesheets.data');

        $dataP= DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $find_month->id)
            ->where('timesheets.data', '=', 'P')
            ->count('timesheets.data');

        $dataKP= DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $find_month->id)
            ->where('timesheets.data', '=', 'KP')
            ->count('timesheets.data');

        $total=$dataX-($dataX_2/2)+$dataPL;
        return view('user.timesheet.index', compact('arrDate', 'month', 'data', 'note', 'dataX', 'dataX_2', 'dataPL', 'dataP', 'dataKP', 'total'));
    }

    public function show($id)
    {
        $checkID = Auth::user()->id;

        $month = Month::findOrFail($id);
        $month_get = $month->month;
        $from = $month_get . '-01';
        $to = $month_get . '-' . Carbon::parse($month_get)->daysInMonth;

        $begin = new \DateTime($from);
        $end = new \DateTime($to);
        $arrDate = [];
        $key = 0;
        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$key] = $i->format("Y-m-d");
            $key++;
        }

        $data = DB::table('timesheets')
            ->where('user_id', '=', $checkID)
            ->where('month_id', '=', $month->id)
            ->get();

        $note = DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $id)
            ->select('notes.note')->distinct()
            ->get();

        $dataX= DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $id)
            ->where('timesheets.data', '=', 'X')
            ->count('timesheets.data');

        $dataX_2= DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $id)
            ->where('timesheets.data', '=', 'X/2')
            ->count('timesheets.data');

        $dataPL= DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $id)
            ->where('timesheets.data', '=', 'PL')
            ->count('timesheets.data');

        $dataP= DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $id)
            ->where('timesheets.data', '=', 'P')
            ->count('timesheets.data');

        $dataKP= DB::table('timesheets')
            ->join('notes', 'timesheets.note_id', '=', 'notes.id')
            ->join('users','timesheets.user_id', '=', 'users.id')
            ->where('timesheets.user_id', '=', $checkID)
            ->where('timesheets.month_id', '=', $id)
            ->where('timesheets.data', '=', 'KP')
            ->count('timesheets.data');

        $total=$dataX-($dataX_2/2)+$dataPL;

        return view('user.timesheet.show', compact('arrDate', 'month', 'data', 'note', 'dataX', 'dataX_2', 'dataPL', 'dataP', 'dataKP', 'total'));
    }
}
