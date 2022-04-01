<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Onleave;
use App\Models\User;
use App\Enums\UserRole;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResponseOnleaveMail;

class AdminOnLeaveController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->month) $request->month = Carbon::now()->month  < 10 ? '0' . Carbon::now()->month : Carbon::now()->month;
        if (!$request->year) $request->year = Carbon::now()->year;

        $date = $request->year . '-' . $request->month;
        $listYear = DB::table('overtimes')->select(DB::raw('DATE_FORMAT(date, "%Y") as year'))->groupBy('year')->pluck('year')->toArray();

        if (!in_array(Carbon::now()->year, $listYear)) {
            array_push($listYear, Carbon::now()->year);
        }

        sort($listYear);

        $begin = new \DateTime($date . '-01');
        $end = new \DateTime($date . '-' . Carbon::parse($date)->daysInMonth);
        $arrDate = [];

        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$i->format("Y-m-d")] = [
                'date' => $i->format("Y-m-d"),
                'day' => $i->format("d"),
                'day_of_week' => $this->getDayOfWeek($i->format("Y-m-d")),
            ];
        }

        $listUser = User::where('role', UserRole::USER)->whereHas('onleave', function ($query) use ($date) {
            $query->where(DB::raw('DATE_FORMAT(timeStart, "%Y-%m")'), $date);
        })->pluck('name', 'id')->toArray();

        $listOnleaveAccept = Onleave::where('status', '!=', 2)->Where(DB::raw('DATE_FORMAT(timeStart, "%Y-%m")'), $date)->get();

        $arrData = [];

        foreach ($listOnleaveAccept as $item) {
            $arrData[$item->user_id][Carbon::parse($item->timeStart)->toDateString()] = [
                'status' => $item->status,
                'timeStart' => $item->timeStart,
                'timeEnd' => $item->timeEnd,
                'reason' => $item->reason,
                'ongoing' => $item->ongoing,
                'id' => $item->id,
                'name' => $item->user->name,
            ];

            // if (!isset($arrData[$item->user_id]['status'])) $arrData[$item->user_id]['status'] = 3;
        }

        $request_employee = Onleave::with('user')->where('status', 2)->get();

        return view('admin.onleave.index', compact('request_employee', 'listYear', 'listOnleaveAccept', 'listUser', 'arrDate', 'arrData'));
    }

    public function update(Request $request, $id)
    {
        $update = Onleave::findOrFail($id);
        $update->status = $request->status;
        $update->save();
        Mail::to($update->user->email)->send(new ResponseOnleaveMail($update));
        if ($update->status == 1) return redirect()->route('admin.onleave.index')->with('status', 'Đã chấp thuận cho ' . $update->user->name . ' nghỉ phép!');
        else if ($update->status == 0) return redirect()->route('admin.onleave.index')->with('status', 'Từ chối cho ' . $update->user->name . ' nghỉ phép!');
    }
    public function getDayOfWeek($day)
    {
        $arr = [
            0 => 'CN',
            1 => 'T2',
            2 => 'T3',
            3 => 'T4',
            4 => 'T5',
            5 => 'T6',
            6 => 'T7',
        ];

        return $arr[Carbon::parse($day)->dayOfWeek];
    }
}
