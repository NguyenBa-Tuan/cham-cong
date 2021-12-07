<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TimeSheetImport;
use App\Models\Timesheet;
use App\Models\User;

class TimeKeepingController extends Controller
{
    public function index()
    {
        $users=User::all();
        return view('admin.timekeeping.index', compact('users'));
    }

    public function import()
    {
        return view('admin.timekeeping.create');
    }

    public function upload()
    {
        Excel::import(new TimeSheetImport(), request()->file('file'));
        return redirect()->route('time_keeping');
    }

//    public function export()
//    {
//        return Excel::download(new T(), 'cham-cong.xlsx');
//    }
}
