<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserLevel;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Month;
use App\Models\Timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Http\Requests\ImportExcelRequest;
use App\Imports\TimesheetImport;
use Exception;

class TimeKeepingController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if (!$request->month) $request->month = Carbon::now()->month  < 10 ? '0' . Carbon::now()->month : Carbon::now()->month;
        if (!$request->year) $request->year = Carbon::now()->year;

        $date = $request->year . '-' . $request->month;
        $listYear = Month::select(DB::raw('SUBSTR(month, 1, 4) as year'))->groupBy('year')->pluck('year')->toArray();

        if (!in_array(Carbon::now()->year, $listYear)) {
            array_push($listYear, Carbon::now()->year);
        }

        sort($listYear);

        $listUser = User::where('role', UserRole::USER)
        ->whereHas('timesheet', function ($query) use ($date) {
            $query->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date);
        })
        ->pluck('name', 'id')->toArray();

        $listCheckin = Timesheet::where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $date)->get();

        $begin = new \DateTime($date . '-01');
        $end   = new \DateTime($date . '-' . Carbon::parse($date)->daysInMonth);

        $arrDate = [];
        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$i->format("Y-m-d")] = [
                'date' => $i->format("Y-m-d"),
                'day' => $i->format("d"),
                'day_of_week' => $this->getDayOfWeek($i->format("Y-m-d")),
            ];
        }

        $arrData = [];

        foreach ($listCheckin as $item) {
            $arrData[$item->user_id][$item->date] = [
                'data' => $item->data,
            ];

            if (!isset($arrData[$item->user_id][$item->data]))
                $arrData[$item->user_id][$item->data] = 0;

            $arrData[$item->user_id][$item->data] += 1;
            $arrData[$item->user_id]['note'] = $item->note;
        }

        return view('admin.timekeeping.index', [
            'listYear' => $listYear,
            'listUser' => $listUser,
            'arrDate' => $arrDate,
            'arrData' => $arrData,
        ]);
    }

    public function show($id)
    {
        $month = Month::findOrFail($id);
        $month_get = $month->month;

        $from = $month_get . '-01';
        $to = $month_get . '-' . Carbon::parse($month_get)->daysInMonth;

        $begin = new \DateTime($from);
        $end = new \DateTime($to);
        $arrDate = [];
        $key = 0;
        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $arrDate[$key] = $i->format("Y-m-d");
            $key++;
        }

        $users = User::all();
        $data = Timesheet::with('notes')->where('month_id', $id)->get();
        $note = DB::table('notes')
            ->join('timesheets', 'notes.id', '=', 'timesheets.note_id')
            ->select('notes.note', 'timesheets.month_id', 'timesheets.user_id')
            ->where('timesheets.month_id', '=', $id)
            ->distinct()
            ->get();
        return view('admin.timekeeping.show', compact('month', 'arrDate', 'users', 'data', 'note'));
    }

    public function import()
    {
        return view('admin.timekeeping.create');
    }

    public function upload(ImportExcelRequest $request)
    {
        DB::beginTransaction();

        try {
            // $create = new Month;
            // $create->month = $request->month;
            // $create->save();

            $data = new TimesheetImport();
            Excel::import($data, request()->file('file'));

            if ($data->response) {
                DB::rollBack();
                return redirect()->route('time_keeping_index')->with('errorUser', $data->response);
            } else {
                DB::commit();

                return redirect()->route('time_keeping_index')->with('success', __('Upload bảng chấm công thành công!'));
            }
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
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
