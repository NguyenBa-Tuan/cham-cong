<?php

namespace App\Imports;

use App\Enums\UserRole;
use App\Models\PayRoll;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PayrollImport implements ToCollection, WithCalculatedFormulas
{
    public $response = [];

    public function collection(Collection $collection)
    {
        error_reporting(0);
        $arrError = [];

        $dateInt = $collection->toArray()[3][0];
        $date = date('Y-m-d', strtotime('1899-12-31+' . ($dateInt - 1) . ' days'));
        $check_data = PayRoll::where('date', $date);
        if ($check_data->count() > 0) {
            $arrError['date_exist'] = 1;
        }
        //     $arrError['data_override']=1;
        //     $check_data->delete();

        //     $listUser = User::where('role', UserRole::USER)->pluck('name', 'id')->toArray();
        //     foreach ($collection as $key => $item) {
        //         if ($key >= 8 && $item[0] && $item[1]) {
        //             $name = $item[1];
        //             if ($id = array_search($name, $listUser)) {
        //                 PayRoll::create([
        //                     'date' => $date,
        //                     'user_id' => $id,
        //                     'basic_salary' => $item[2],
        //                     'standard_date' => $item[3],
        //                     'daily_salary' => round($item[4]),
        //                     'paid_leave' => $item[5],
        //                     'overtime_date' => $item[6],
        //                     'overtime_salary' => round($item[7]),
        //                     'number_working_day' => $item[8],
        //                     'punish' => $item[9],
        //                     'bonus' => $item[10],
        //                     'overtime' => $item[11],
        //                     'hourly_overtime' => round($item[12]),
        //                     'bhxh' => $item[13],
        //                     'salary' => round($item[14]),
        //                     'note' => $item[15],
        //                 ]);

        //                 unset($listUser[$id]);
        //             } else {
        //                 $arrError['user_none'][] = $name;
        //             }
        //         }
        //     }
        // } else {

        $listUser = User::where('role', UserRole::USER)->pluck('name', 'id')->toArray();
        foreach ($collection as $key => $item) {
            if ($key >= 8 && $item[0] && $item[1]) {
                $name = $item[1];

                if ($id = array_search($name, $listUser)) {

                    PayRoll::create([
                        'date' => $date,
                        'user_id' => $id,
                        'basic_salary' => $item[2],
                        'standard_date' => $item[3],
                        'daily_salary' => round($item[4]),
                        'paid_leave' => $item[5],
                        'overtime_date' => $item[6],
                        'overtime_salary' => round($item[7]),
                        'number_working_day' => $item[8],
                        'punish' => $item[9],
                        'bonus' => $item[10],
                        'overtime' => $item[11],
                        'hourly_overtime' => round($item[12]),
                        'bhxh' => $item[13],
                        'salary' => round($item[14]),
                        'note' => $item[15],
                    ]);

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
