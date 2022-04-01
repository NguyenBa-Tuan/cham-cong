<?php

namespace App\Http\Controllers\User;

use App\Enums\OvertimePermission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Overtime;
use App\Models\OvertimeHistory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserOverTimeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('checkUser');
    }

    public function index(Request $request)
    {

        if (!$request->month) $request->month = Carbon::now()->month  < 10 ? '0' . Carbon::now()->month : Carbon::now()->month;
        if (!$request->year) $request->year = Carbon::now()->year;

        $date1 = $request->year . '-' . $request->month;
        $listYear = Overtime::select(DB::raw('SUBSTR(date, 1, 4) as year'))->groupBy('year')->pluck('year')->toArray();

        if (!in_array(Carbon::now()->year, $listYear)) {
            array_push($listYear, Carbon::now()->year);
        }

        sort($listYear);


        $from = $date1 . '-01';

        $to = $date1 . '-' . Carbon::parse($date1)->daysInMonth;

        $begin = new \DateTime($from);
        $end = new \DateTime($to);
        $arrDate = [];
        $arrCheckin = [];
        $arrCheckout = [];
        $arrTotalTime = [];
        $arrProjectName = [];
        $arrNote = [];

        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$i->format("Y-m-d")] = $i->format("Y-m-d");
            $arrCheckin[$i->format("Y-m-d")] = false;
            $arrCheckout[$i->format("Y-m-d")] = false;
            $arrTotalTime[$i->format("Y-m-d")] = false;
            $arrProjectName[$i->format("Y-m-d")] = false;
            $arrNote[$i->format("Y-m-d")] = false;
        }

        $data = Overtime::where('user_id', Auth::id())
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date1)
            ->orderby('date', 'DESC')
            ->get();

        $count = Overtime::where('user_id', Auth::id())
            ->select('totalTime')
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date1)
            ->sum(DB::raw("TIME_TO_SEC(totalTime)"));


        $h = floor($count / 60 / 60);
        $m = $count / 60 % 60;
        $getTotal = "$h" . ":" . "$m";


        foreach ($data as $item) {
            $arrCheckin[$item->date] = [
                'checkin' => $item->checkin,
            ];
        }

        foreach ($data as $item) {
            $arrCheckout[$item->date] = [
                'checkout' => $item->checkout,
            ];
        }

        foreach ($data as $item) {
            $arrTotalTime[$item->date] = [
                'totalTime' => $item->totalTime,
            ];
        }

        foreach ($data as $item) {
            $arrProjectName[$item->date] = [
                'projectName' => $item->projectName,
            ];
        }

        foreach ($data as $item) {
            $arrNote[$item->date] = [
                'note' => $item->note,
            ];
        } 
        return view('user.overtime.index', compact('listYear', 'data', 'arrDate', 'arrCheckin', 'arrCheckout', 'arrTotalTime', 'arrProjectName', 'arrNote', 'getTotal'));
    }

    public function create()
    {
        return view('user.overtime.create');
    }

    public function store(Request $request)
    {
        //$create->checkin = Carbon::parse($request->checkin);
        $data_check = DB::table('overtimes')->select('user_id', 'date', 'id')
            ->where('user_id', '=', Auth::id())
            ->where('date', '=',  $request->date)->first();

        $create = new Overtime();

        if ($data_check) {
            $create = Overtime::findOrFail($data_check->id);
            $create->permission = OvertimePermission::VIEW;
        }

        $create->user_id = Auth::id();
        $create->date = Carbon::parse($request->date)->format('Y-m-d');
        $create->checkin = Carbon::createFromTimestamp(strtotime($request->date . $request->checkin . ":00"));
        // $create->checkin = Carbon::parse($request->checkin);
        $create->checkout = Carbon::parse($request->checkout);
        $create->totalTime = $create->checkout->diff($create->checkin)->format('%H:%I:%S');
        $create->note = $request->note;
        $create->projectName = $request->projectName;

        // $data_check = DB::table('overtimes')->select('user_id', 'date')
        //     ->where('user_id', '=', $create->user_id)
        //     ->where('date', '=',  $create->date)->first();
        // if ($data_check) return redirect()->route('user_overtime')->with('error', 'Ngày ' . Carbon::parse($request->date)->format('d/m/Y') . ' đã đăng ký làm đêm!');

        //        dd($request->totalInput);
        //
        //        $check_total= Carbon::parse($request->totalInput);
        //        if($check_total != $create->totalTime) return  redirect()->route('user_overtime')->with('error', 'Lỗi: Nhập checkin và checkout không đúng!');
        if ($create->checkout <= $create->checkin) return redirect()->route('user_overtime')->with('error', 'Lỗi: thời gian checkout nhỏ hơn thời gian checkin!');

        $create->save();

        //create History

        $otHistory = new OvertimeHistory();
        $otHistory->overtime_id = $create->id;
        $otHistory->user_id = Auth::id();
        $otHistory->date = Carbon::parse($request->date)->format('Y-m-d');
        $otHistory->checkin = Carbon::createFromTimestamp(strtotime($request->date . $request->checkin . ":00"));
        // $create->checkin = Carbon::parse($request->checkin);
        $otHistory->checkout = Carbon::parse($request->checkout);
        $otHistory->totalTime = $create->checkout->diff($create->checkin)->format('%H:%I:%S');
        $otHistory->note = $request->note;
        $otHistory->projectName = $request->projectName;

        $otHistory->save();

        return redirect()->route('user_overtime')->with('success', 'Đăng ký thành công!');
    }

    public function history(Request $request)
    {
        $history = Overtime::where(['date' => $request->date, 'user_id' => Auth::user()->id])->first();

        if ($history) {
            if ($history->permission == OvertimePermission::EDIT)
                return response()->json(['code' => 200, 'data' => $history]);

            return response()->json(['code' => 400, 'data' => $history]);
        }

        return response()->json(['code' => 100]);
    }
}
