<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Imports\PayrollImport;
use App\Models\PayRoll;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
// use Illuminate\Http\UploadedFile;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->month) $request->month = Carbon::now()->month  < 10 ? '0' . Carbon::now()->month : Carbon::now()->month;
        if (!$request->year) $request->year = Carbon::now()->year;

        $date = $request->year . '-' . $request->month;
        $listYear = PayRoll::select(DB::raw('SUBSTR(date, 1, 4) as year'))->groupBy('year')->pluck('year')->toArray();

        if (!in_array(Carbon::now()->year, $listYear)) {
            array_push($listYear, Carbon::now()->year);
        }
        sort($listYear);

        $listUser = User::where('role', UserRole::USER)
            ->whereHas('payroll', function ($query) use ($date) {
                $query->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date);
            })
            ->pluck('name', 'id')->toArray();

        $listSalary = PayRoll::where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)->get();

        $arrData  = [];
        foreach ($listSalary as $item) {
            $arrData[$item->user_id]  = [
                'basic_salary' => $item->basic_salary,
                'standard_date' => $item->standard_date,
                'paid_leave' => $item->paid_leave,
                'overtime_date' => $item->overtime_date,
                'number_working_day' => $item->number_working_day,
                'punish' => $item->punish,
                'bonus' => $item->bonus,
                'overtime' => $item->overtime,
                'note' => $item->note,
                'daily_salary' => $item->daily_salary,
                'overtime_salary' => $item->overtime_salary,
                'hourly_overtime' => $item->hourly_overtime,
                'bhxh' => $item->bhxh,
                'salary' => $item->salary,
            ];
        }
        return view('admin.payroll.index', compact('listUser', 'arrData', 'listYear'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = new PayrollImport();
            Excel::import($data, request()->file('file'));

            if ($data->response) {
                // $checkfile = request()->file('file');
              
                DB::rollBack();
                return redirect()->route('payroll.index')->with('errorUser', $data->response, ['path'=>$path]);
            } else {
                DB::commit();
                return redirect()->route('payroll.index')->with('success', __('Upload bảng lương thành công!'));
            }
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function overwrite()
    {
        // $data=Session::get('checkfile');dd($data);
    }

    public function show($id)
    {
    }
    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
