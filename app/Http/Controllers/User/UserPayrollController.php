<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPayrollController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->month) $request->month = Carbon::now()->month  < 10 ? '0' . Carbon::now()->month : Carbon::now()->month;
        if (!$request->year) $request->year = Carbon::now()->year;

        $date = $request->year . '-' . $request->month;

        $checkID = Auth::user()->id;

        $listYear = PayRoll::select(DB::raw('SUBSTR(date, 1, 4) as year'))->groupBy('year')->pluck('year')->toArray();

        if (!in_array(Carbon::now()->year, $listYear)) {
            array_push($listYear, Carbon::now()->year);
        }
        sort($listYear);

        $listSalary = PayRoll::where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)->where('user_id', $checkID)->get();
        return view('user.payroll.index', compact('listSalary', 'listYear'));
    }
}
