<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserLevel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Overtime;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OvertimeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('checkAdmin');
    }

    public function index(Request $request)
    {
        if (!$request->month) $request->month = Carbon::now()->month  < 10 ? '0' . Carbon::now()->month : Carbon::now()->month;
        if (!$request->year) $request->year = Carbon::now()->year;

        $date = $request->year . '-' . $request->month;

        $listYear = DB::table('overtimes')
            ->select(DB::raw('DATE_FORMAT(date, "%Y") as year'))->groupBy('year')->pluck('year')->toArray();

        if (!in_array(Carbon::now()->year, $listYear)) {
            array_push($listYear, Carbon::now()->year);
        }

        sort($listYear);

        $listUser = User::where('level', UserLevel::Employee)->pluck('name', 'id')->toArray();

        $begin = new \DateTime($date . '-01');
        $end = new \DateTime($date . '-' . Carbon::parse($date)->daysInMonth);
        $arrDate = [];

        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$i->format("Y-m-d")] = [
                'date' => $i->format("Y-m-d"),
                'day' => $i->format("d"),
            ];
        }
        $listOverTime = Overtime::where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)->get();

        $arrData = [];
        $totalTime = 0;

        foreach ($listOverTime as $item) {
            $checkin = $item->checkin ? Carbon::parse($item->checkin)->format('H:i') : '';
            $checkout = $item->checkout ? Carbon::parse($item->checkout)->format('H:i') : '';

            $totalTime = (strtotime($checkout) - strtotime($checkin)) / 60 / 60;

            $arrData[$item->user_id][$item->date] = [
                'checkin' => $checkin,
                'checkout' => $checkout,
                'note' => $item->note,
                'total_time' => $totalTime,
                'project_name' =>  $item->projectName,
            ];

            if (!isset($arrData[$item->user_id]['total_time'])) $arrData[$item->user_id]['total_time'] = 0;

            $arrData[$item->user_id]['total_time'] += $totalTime;
        }

      
        
        return view('admin.overtime.index', compact('listYear', 'listUser', 'arrDate', 'arrData'));
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
