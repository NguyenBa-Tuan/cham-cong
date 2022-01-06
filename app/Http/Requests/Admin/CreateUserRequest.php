<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'user_id' => 'required|numeric|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8|max:25',
            'password_confirmation' => 'same:password',
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
            'password_confirmation.same' => 'Mật khẩu không trùng khớp!',
            'email.email' => 'Không đúng định dạng email!',
            'email.unique' => 'Email này đã được sử dụng!',
            'user_id.unique' => 'ID này đã được sử dụng!',
            'user_id.required' => 'Chưa nhập ID!',
            'username.required' => 'Chưa nhập username!',
            'username.unique' => 'Username đã được đăng ký!',
        ];
    }
}
