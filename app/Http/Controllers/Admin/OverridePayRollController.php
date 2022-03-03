<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\CheckOverridePayRollImport;
use Maatwebsite\Excel\Facades\Excel;

class OverridePayRollController extends Controller
{
    public function checkOverride(Request $request)
    {
        $data = new CheckOverridePayRollImport();
        $d=Excel::import($data, request()->file('file'));
        if ($data->response) {
            return redirect()->route('payroll.index')->with('check_data', $data->response);
        }
    }
    public function override(Request $request)
    {
    }
}
