<?php

namespace App\Imports;

use App\Models\Note;
use App\Models\Timesheet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class TimesheetImport implements ToCollection
{
    public $check = false;

    public function collection(Collection $collection)
    {
        $d = DB::table('months')->latest('created_at')->first();
        $date = $d->month;
        $month_id = $d->id;
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
        foreach ($collection as $key => $row) {
            if ($key >= 8 && $row[0]) {
                $name = $row[1];
                $note = $row[40];

                $users = User::where('name', $name)->first();

                if ($users) {
                    $this->check = true;

                    Note::create([
                        'note' => $row[40],
                    ]);
                    $notes = Note::where('note', $note)->first();

                    foreach ($arrDate as $key => $item) {
                        Timesheet::create([
                            'user_id' => $users->id,
                            'month_id' => $month_id,
                            'date' => $item,
                            'data' => $row[$key],
                            'note_id' => $notes->id,
                        ]);
                    }
                }
                else{
                    return 1;
                }
            }
        }
    }

}

