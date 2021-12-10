<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Overtime;
use Illuminate\Support\Facades\DB;

class OvertimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkAdmin');
    }

    public function index()
    {
        $monthList = DB::table('overtimes')
            ->select(DB::raw('DATE_FORMAT(date, "%m-%Y") as collect'))
            ->orderBy('collect', 'ASC')
            ->distinct()
            ->get();

        $data = Overtime::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->get();

        return view('admin.overtime.index', compact('data', 'monthList'));
    }

    public function mount($month)
    {
        $monthList = DB::table('overtimes')
            ->select(DB::raw('DATE_FORMAT(date, "%m-%Y") as collect'))
            ->orderBy('collect', 'DESC')
            ->distinct()
            ->get();

        $data = DB::table('overtimes')->where(DB::raw('DATE_FORMAT(date, "%m-%Y")'), $month)->get();

        return view('admin.overtime.show', compact('data', 'month', 'monthList'));
    }

    public function edit($id)
    {
        $data = Overtime::findOrFail($id);
        return view('admin.overtime.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $update = Overtime::findOrFail($id);
        $update->note = $request->note;
        $update->save();
        return redirect()->route('overtime_index');
    }
}
