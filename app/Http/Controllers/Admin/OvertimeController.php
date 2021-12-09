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
        $data = Overtime::whereMonth('date', Carbon::now()->month)->get();
        $month = DB::table('overtimes')->select('date')->get();
        return view('admin.overtime.index', compact('data', 'month'));
    }

    public function mount()
    {
        $data = Overtime::all();
        $month = DB::table('overtimes')->select('date')->get();

        $monthList = DB::table('overtimes')
            ->select('date')
            ->get();

        foreach ($monthList as $m) {
            $date = date_create_from_format('Y-m-d', $m->date);
            $arr = array(
                (int)$date->format('Y'),
                (int)$date->format('m'),
                (int)$date->format('d'),
            );

            foreach ($arr->unique('value') as $key => $value) {
                if ($key == 1) {
                    print_r("<p>" . $value . "</p>");
                }
            }
        }

//        foreach ($monthList->unique(Carbon::parse(date('M'))->month) as $m) {
//            print_r("<p>" . \Carbon\Carbon::parse($m->date)->month . "</p>");
//        }

        return view('admin.overtime.show', compact('data', 'month'));
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
