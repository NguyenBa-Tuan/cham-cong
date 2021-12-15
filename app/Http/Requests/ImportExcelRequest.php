<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportExcelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required',
            // 'file' => 'required|mimes:csv,xlsx,xls',
            // 'month' => 'required|date_format:Y-m',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => __('Chưa thêm file excel!'),
            'file.mimes' => __('Không đúng định dạng file'),
            // 'month.required' => __('Chưa nhập tháng chấm công!'),
            // 'month.date_format' => __('Không dúng định dạng tháng- năm')
        ];
    }
}
