<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required',
            'name_cmt' => 'required',
            'email' => 'required|email:true'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Vui lòng nhập nội dung bình luận',
            'name_cmt.required' => 'Vui lòng nhập tên của bạn',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
        ];
    }
}
