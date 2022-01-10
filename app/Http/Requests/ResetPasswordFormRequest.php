<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|min:8|max:25|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Thiếu mật khẩu!',
            'password.min' => 'Độ dài mật khẩu không được ít hơn 8 ký tự!',
            'password.max' => 'Độ dài mật khẩu không được nhiều hơn 25 ký tự!',
            'password.confirmed' => 'Mật khẩu nhập lại không đúng!',
        ];
    }
}
