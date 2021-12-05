<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FileExport;
use App\Imports\FileImport;

class TimeKeepingController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.timekeeping.index', compact('users'));
    }

    public function export()
    {
        return Excel::download(new FileExport, 'cham-cong.xlsx');
    }

    public function import()
    {
        Excel::import(new FileImport, request()->file('file'));
    }
}
