<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Month;
use App\Models\Timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TimeSheetImport;
use App\Models\User;

class TimeKeepingController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkAdmin');
    }

    public function index()
    {
        $month = Month::all();
        return view('admin.timekeeping.index', compact('month'));
    }

    public function show($id)
    {
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

        $users = User::all();
        $data = Timesheet::with('notes')->where('month_id', $id)->get();
        $note = DB::table('notes')
            ->join('timesheets', 'notes.id', '=', 'timesheets.note_id')
            ->select('notes.note', 'timesheets.month_id', 'timesheets.user_id')
            ->where('timesheets.month_id', '=', $id)
            ->distinct()
            ->get();
        return view('admin.timekeeping.show', compact('month', 'arrDate', 'users', 'data', 'note'));
    }

    public function import()
    {
        return view('admin.timekeeping.create');
    }

    public function upload(Request $request)
    {
        $create = new Month;
        $create->month = $request->month;
        $create->save();

        Excel::import(new TimeSheetImport(), request()->file('file'));
        return redirect()->route('time_keeping_index');
    }

//    public function export()
//    {
//        return Excel::download(new T(), 'cham-cong.xlsx');
//    }
}
