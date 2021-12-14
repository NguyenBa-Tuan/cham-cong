<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|',
            'email' => 'required|email',
            'password' => 'required|min:8|max:25',
            'role' => 'required',
            'level' => 'required',
        ];
    }

    public function messages()
    {
//        return parent::messages();
        return [
            'name.required' => 'Thiếu họ tên!',
            'email.required' => 'Thiếu email!',
            'password.required' => 'Thiếu mật khẩu!',
            'role.required' => 'Thiếu quyền sử dụng!',
            'level.required' => 'Thiếu chức vụ!',
            'password.min' => 'Độ dài mật khẩu không được ít hơn 8 ký tự!',
            'password.max' => 'Độ dài mật khẩu không được nhiều hơn 25 ký tự!',
            'email.email' => 'Không đúng định dạng email!',
        ];
    }
}
