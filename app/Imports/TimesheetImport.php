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

class TimesheetImport implements ToCollection
{
    public $response = [];

    public function collection(Collection $collection)
    {
        error_reporting(0);

        $arrError = [];
        // $d = DB::table('months')->latest('created_at')->first();
        // $date = $d->month;

        $date = $collection[4][26] . '-' . (strlen($collection[4][23]) < 2 ? '0' . $collection[4][23] : $collection[4][23]);
        //create month 

        if (Month::where('month', $date)->count() > 0) {
            $arrError['date_exist'] = 1;
        }
        
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
                $note = $row[40];

                if ($id = array_search($name, $listUser)) {
                    $notes = Note::create([
                        'note' => $note,
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


        if (count($listUser) > 0)
            $arrError['user_missing'] = $listUser;

        $this->response = $arrError;

        return $this->response;
    }
}
