<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TimeSheetImport;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TimeKeepingController extends Controller
{
    public function index()
    {
        $datas = Timesheet::all();
        return view('admin.timekeeping.index', compact('datas'));
    }
//
//    public function export()
//    {
//        return Excel::download(new T(), 'cham-cong.xlsx');
//    }

    public function import()
    {
        Excel::import(new TimeSheetImport(), request()->file('file'));
        return redirect()->route('time_keeping');
    }
}
