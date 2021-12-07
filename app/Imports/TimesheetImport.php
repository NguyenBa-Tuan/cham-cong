<?php

namespace App\Imports;

use App\Models\Timesheet;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Status;
use PhpOffice\PhpSpreadsheet\Calculation\DateTime;

class TimesheetImport implements ToCollection
{
//    public function model(array $row)
//    {
//
//        return new Timesheet([
//            'date' => $row['date'],
//        ]);
//    }


    public function collection(Collection $collection)
    {
        $date = '2021-10';
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

        $dataInsert = [];
        foreach ($collection as $key => $row) {
            if ($key >= 8 && $row[0]) {
                $name = $row[1];
                $users = User::where('name', $name)->first();

                foreach ($arrDate as $key => $item) {
                    if ($users) {
                        Timesheet::create([
                            'user_id' => $users->id,
                            'date' => $item,
                            'data' => $row[$key],
                        ]);
                    }
                }
            }


            foreach ($dataInsert as $key => $value) {
//            print_r("<p>" . $key . "</p>");
                Status::create([
                    'status' => $value,
                ]);
            }

//        $users = User::all();
//        foreach ($users as $user) {
//            foreach ($dataInsert as $item => $data) {
//                if ($user->name == $item) {
//
//                }
//            }
//        }
        }
    }
}
