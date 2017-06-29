<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|min:6|max:32|unique:users,username',
            'email' => 'required|unique:users,email|email:true',
            'confirm-email' => 'same:email',
            'fullname' => 'required',
            'password' => 'required|min:6|max:32',
            'confirm-password' => 'same:password'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập tên tài khoản',
            'username.min' => 'Tên tài khoản không được ít hơn 6 ký tự',
            'username.max' => 'Tên tài khoản không được nhiều hơn 32 ký tự',
            'username.unique' => 'Tài khoản này đã được sử dụng',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email này đã được sử dụng',
            'email.email' => 'Vui lòng nhập chính xác định dạng email',
            'confirm-email.same' => 'Email không trùng khớp',
            'fullname.required' => 'Vui lòng nhập họ tên',
            'password.required' => 'Vui lòng nhập password',
            'password.min' => 'Mật khẩu không được ít hơn 6 ký tự',
            'password.max' => 'Mật khẩu không được nhiều hơn 32 ký tự',
            'confirm-password' => 'Mật khẩu không trùng khớp'
        ];
    }
}
