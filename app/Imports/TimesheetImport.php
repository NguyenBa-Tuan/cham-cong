<?php

namespace App\Imports;

use App\Enums\UserLevel;
use App\Enums\UserRole;
use App\Models\Month;
use App\Models\Note;
use App\Models\Timesheet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class TimesheetImport implements ToCollection, WithCalculatedFormulas
{
    public $response = [];

    public function collection(Collection $collection)
    {
        error_reporting(0);

        $arrError = [];

        $date = $collection[4][26] . '-' . (strlen($collection[4][23]) < 2 ? '0' . $collection[4][23] : $collection[4][23]);
        $check_date = Month::where('month', $date)->first();

        if ($check_date) {
            $check_date_id = $check_date->id;
            Timesheet::where('month_id', $check_date_id)->delete();
            // Note::where('id', )
            $check_date->delete();

            if (date('Y-m', strtotime($date)) != $date) {
                $date = Carbon::now()->format('Y-m');
                $arrError['date_error'] = 1;
            }

            $month = new Month();
            $month->month = $date;
            $month->save();


            $month_id = $month->id;
            $from = $date . '-01';
            $to = $date . '-' . Carbon::parse($date)->daysInMonth;

            $begin = new \DateTime($from);
            $end = new \DateTime($to);
            $arrDate = [];
            $key = 3;

            for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                $arrDate[$key] = $i->format("Y-m-d");
                $key++;
            }

            $listUser = User::where('role', UserRole::USER)->pluck('name', 'id')->toArray();
            foreach ($collection as $key => $row) {
                if ($key >= 8 && $row[0]) {
                    $name = $row[1];
                    $full_job = $row[34];
                    $half_job = $row[35];
                    $ncl = $row[36];
                    $np = $row[37];
                    $kp = $row[38];
                    $total = $row[39];
                    $note = $row[40];

                    if ($id = array_search($name, $listUser)) {
                        $notes = Note::create([
                            'full_job' => $full_job,
                            'half_job' => $half_job,
                            'ncl' => $ncl,
                            'np' => $np,
                            'kp' => $kp,
                            'total' => $total,
                            'note' => $note,
                        ]);
                        dd($notes);
                        foreach ($arrDate as $key => $item) {
                            Timesheet::create([
                                'user_id' => $id,
                                'month_id' => $month_id,
                                'date' => $item,
                                'data' => $row[$key],
                                'note_id' => $notes->id,
                            ]);
                        }

                        unset($listUser[$id]);
                    } else {
                        $arrError['user_none'][] = $name;
                    }
                }
            }

            if (count($listUser) > 0) {
                $arrError['user_missing'] = $listUser;
            } else {
                $arrError['override'] = 1;
            }
        } else {
            if (date('Y-m', strtotime($date)) != $date) {
                $date = Carbon::now()->format('Y-m');
                $arrError['date_error'] = 1;
            }

            $month = new Month();
            $month->month = $date;
            $month->save();


            $month_id = $month->id;
            $from = $date . '-01';
            $to = $date . '-' . Carbon::parse($date)->daysInMonth;

            $begin = new \DateTime($from);
            $end = new \DateTime($to);
            $arrDate = [];
            $key = 3;

            for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                $arrDate[$key] = $i->format("Y-m-d");
                $key++;
            }

            $listUser = User::where('role', UserRole::USER)->pluck('name', 'id')->toArray();
            foreach ($collection as $key => $row) {
                if ($key >= 8 && $row[0]) {
                    $name = $row[1];
                    $full_job = $row[34];
                    $half_job = $row[35];
                    $ncl = $row[36];
                    $np = $row[37];
                    $kp = $row[38];
                    $total = $row[39];
                    $note = $row[40];

                    if ($id = array_search($name, $listUser)) {
                        $notes = Note::create([
                            'note' => $note,
                            'full_job' => $full_job,
                            'half_job' => $half_job,
                            'ncl' => $ncl,
                            'np' => $np,
                            'kp' => $kp,
                            'total' => $total,
                        ]);

                        foreach ($arrDate as $key => $item) {
                            Timesheet::create([
                                'user_id' => $id,
                                'month_id' => $month_id,
                                'date' => $item,
                                'data' => $row[$key],
                                'note_id' => $notes->id,
                            ]);
                        }

                        unset($listUser[$id]);
                    } else {
                        $arrError['user_none'][] = $name;
                    }
                }
            }
            if (count($listUser) > 0) {
                $arrError['user_missing'] = $listUser;
                $arrError['upload'] = 0;
            } else {
                $arrError['upload'] = 1;
            }
        }

        $this->response = $arrError;

        return $this->response;
    }
}
