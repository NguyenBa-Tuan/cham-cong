<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Onleave;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OnleaveMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserOnLeaveController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->month) $request->month = Carbon::now()->month  < 10 ? '0' . Carbon::now()->month : Carbon::now()->month;
        if (!$request->year) $request->year = Carbon::now()->year;

        $date = $request->year . '-' . $request->month;

        $listYear = Onleave::select(DB::raw('SUBSTR(timeStart, 1, 4) as year'))->groupBy('year')->pluck('year')->toArray();

        if (!in_array(Carbon::now()->year, $listYear)) {
            array_push($listYear, Carbon::now()->year);
        }
        sort($listYear);

        $from = $date . '-01';

        $to = $date . '-' . Carbon::parse($date)->daysInMonth;

        $begin = new \DateTime($from);
        $end = new \DateTime($to);
        $arrDate = [];
        $arrTimeStart = [];
        $arrTimeEnd = [];
        $arrReason = [];
        $arrStatus = [];

        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$i->format("Y-m-d")] = $i->format("Y-m-d");
            $arrTimeStart[$i->format("Y-m-d")] = false;
            $arrTimeEnd[$i->format("Y-m-d")] = false;
            $arrReason[$i->format("Y-m-d")] = false;
            $arrStatus[$i->format("Y-m-d")] = false;
        }
        $on_leave_accept = Onleave::where('user_id', Auth::id())
            // ->where(DB::raw('DATE_FORMAT(timeStart, "%Y-%m")'), $date)
            ->where(DB::raw('DATE_FORMAT(timeStart, "%Y-%m")'), $date)
            ->get();
        $time_end_data = Onleave::where('user_id', Auth::id())
            ->where(DB::raw('DATE_FORMAT(timeEnd, "%Y-%m")'), $date)
            ->get();


        foreach ($on_leave_accept as $item) {
            $arrTimeStart[Carbon::parse($item->timeStart)->format('Y-m-d')] = [
                'timeStart' => $item->timeStart,
            ];
            $arrReason[Carbon::parse($item->timeStart)->format('Y-m-d')] = [
                'reason' => $item->reason,
            ];
            $arrStatus[Carbon::parse($item->timeStart)->format('Y-m-d')] = [
                'status' => $item->status,
            ];
        }

        foreach ($time_end_data as $item) {
            $arrTimeEnd[Carbon::parse($item->timeEnd)->format('Y-m-d')] = [
                'timeEnd' => $item->timeEnd,
            ];
        }

        return view('user.onleave.index', compact('arrTimeStart', 'arrTimeEnd', 'listYear', 'arrDate', 'arrReason', 'arrStatus'));
    }

    public function create()
    {
        return view('user.onleave.create');
    }

    public function store(Request $request)
    {
        $checkDate = Carbon::now()->addDays(1);

        $admin = User::where('role', '0')->get();
        $arrAdminMail = [];

        foreach ($admin as $adminMail) {
            $arrAdminMail[] = ['email' => $adminMail->email];
        }

        $store = new Onleave();
        $store->user_id = Auth::id();
        $store->timeStart = $request->timeStart;
        $store->timeEnd = $request->timeEnd;
        $store->reason = $request->reason;
        $store->ongoing = $request->on_going;
        $store->status = 2;

        $date_start = Onleave::where(DB::raw('DATE_FORMAT(timeStart, "%Y-%m-%d")'), Carbon::parse($request->timeStart)->toDateString())->where('user_id',  Auth::id())->first();

        $check_timeStart = Onleave::where('timeStart', $store->timeStart)->where('user_id',  Auth::id())->first();
        $check_timeEnd = Onleave::where('timeEnd', $store->timeEnd)->where('user_id',  Auth::id())->first();

        if ($check_timeStart) return redirect()->route('user.onleave.index')->with('fail', 'Thời gian bắt đầu nghỉ đã được đăng ký!');
        if ($check_timeEnd) return redirect()->route('user.onleave.index')->with('fail', 'Thời gian kết thúc nghỉ đã được đăng ký!');
        if ($date_start) return redirect()->route('user.onleave.index')->with('fail', 'Thời gian nghỉ đã được đăng ký!');

        if ($store->timeStart < $checkDate) return redirect()->route('user.onleave.index')->with('fail', 'Thời gian bắt đầu nghỉ phải từ ngày mai trở đi !');
        if ($store->timeEnd < $store->timeStart) return redirect()->route('user.onleave.index')->with('fail', 'Thời gian kết thúc nghỉ phải lớn hơn thời gian bắt đầu nghỉ !');

        else {
            foreach ($arrAdminMail as $emails) {
                // dd($emails['email']);
                Mail::to($emails['email'])->send(new OnleaveMail($store));
            }
            $store->save();
            Log::info('he thong cham cong xin nghi phep: ' . $store);
            return redirect()->route('user.onleave.index')->with('success', 'success');
        }
    }
}
