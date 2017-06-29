<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserEditRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $id = Request::segment(3);
        if ($request->has('check'))
        {
            return [
                'email' => 'required|unique:users,email,'.$id.'|email:true',
                'confirm-email' => 'same:email',
                'fullname' => 'required',
                'password' => 'required|min:6|max:32',
                'confirm-password' => 'same:password'
            ];
        } else{
            return [
                'email' => 'required|unique:users,email,'.$id.'|email:true',
                'confirm-email' => 'same:email',
                'fullname' => 'required',
            ];
        }

    }

    public function messages()
    {
        return [
            'role.required' => 'Vui lòng chọn quyền cho người dùng',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email này đã được sử dụng',
            'email.email' => 'Vui lòng nhập chính xác định dạng email',
            'confirm-email' => 'Email không trùng khớp',
            'fullname.required' => 'Vui lòng nhập họ tên',
            'password.required' => 'Vui lòng nhập password',
            'password.min' => 'Mật khẩu không được ít hơn 6 ký tự',
            'password.max' => 'Mật khẩu không được nhiều hơn 32 ký tự',
            'confirm-password' => 'Mật khẩu không trùng khớp'
        ];
    }
}
