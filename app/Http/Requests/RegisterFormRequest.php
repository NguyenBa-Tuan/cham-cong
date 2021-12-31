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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:25|confirmed',
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
            'level.required' => 'Thiếu chức vụ!',
            'password.min' => 'Độ dài mật khẩu không được ít hơn 8 ký tự!',
            'password.max' => 'Độ dài mật khẩu không được nhiều hơn 25 ký tự!',
            'password.confirmed' => 'Mật khẩu nhập lại không đúng!',
            'email.email' => 'Không đúng định dạng email!',
            'email.unique' => 'Email này đã được sử dụng!',
        ];
    }
}
