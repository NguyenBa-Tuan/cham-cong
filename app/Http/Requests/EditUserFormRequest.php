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
            'password' => 'confirmed|min:8|max:25',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được để trống',
            'password.min' => 'Độ dài mật khẩu không được ít hơn 8 ký tự!',
            'password.max' => 'Độ dài mật khẩu không được nhiều hơn 25 ký tự!',
            'password.confirmed' => 'Mật khẩu nhập lại không đúng!',
        ];
    }
}
