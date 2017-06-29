<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required',
            'cat_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'picture' => 'required|file',
            'new' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nhập tên sản phẩm',
            'cat_id.required' => 'Chọn danh mục sản phẩm',
            'description.required' => 'Nhập chi tiết sản phẩm',
            'price.required' => 'Nhập giá sản phẩm',
            'picture.required' => 'Chọn ảnh bìa cho tin',
            'picture.file' => 'Chọn ảnh bìa cho tin',
            'new.required' => 'Nhập tình trạng sản phẩm',
        ];
    }
}
