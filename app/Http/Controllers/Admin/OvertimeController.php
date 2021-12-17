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
        if (!$request->month) $request->month = Carbon::now()->month;
        if (!$request->year) $request->year = Carbon::now()->year;

        $date = $request->year . '-' . $request->month;

        $listYear = DB::table('overtimes')
            ->select(DB::raw('DATE_FORMAT(date, "%Y") as year'))->groupBy('year')->pluck('year');

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
            $checkout = $item->checkin ? Carbon::parse($item->checkout)->format('H:i') : '';

            $totalTime = (strtotime($checkout) - strtotime($checkin)) / 60 / 60;

            $arrData[$item->user_id][$item->date] = [
                'checkin' => $checkin,
                'checkout' => $checkout,
                'note' => $item->note,
                'total_time' => $totalTime,
            ];

//            $totalHour = floor(($totalTime * 60) / 60);
//            $totalMin = ($totalTime * 60) % 60;
//            $getTime=$totalHour . ":" . $totalMin;
//            dd($getTime);

            if (!isset($arrData[$item->user_id]['total'])) $arrData[$item->user_id]['total'] = 0;

            $arrData[$item->user_id]['total'] += $totalTime;
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
