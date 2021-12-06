<?php

namespace App\Imports;

//use App\Models\Day;
use App\Models\Timesheet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Enums\Day;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class TimeSheetImport implements ToModel, WithHeadingRow
{
    public function headingRow() : array
    {
        return [
            
        ];
    }

    public function model(array $row)
    {
        dd($row);
    }

//    public function collection(Collection $rows)
//    {
//        for ($i = 0; $i < count($rows); $i++) {
//            dd($rows[$i]);
//        }
//    }
}
