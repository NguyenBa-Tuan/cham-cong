<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'level' => 'required'
        ];
    }

    public function messages()
    {
//        return parent::messages();
        return [
            'name.required' => 'Họ tên không được để trống',
            'level.required' => 'Chức vụ không được để trống',
        ];
    }
}
