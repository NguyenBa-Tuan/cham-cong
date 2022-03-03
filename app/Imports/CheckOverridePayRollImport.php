<?php

namespace App\Imports;

use App\Models\PayRoll;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CheckOverridePayRollImport implements ToCollection
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
            $arrError['data_e'] = 1;
        }

        $this->response = $arrError;
        return $this->response;
    }
}
