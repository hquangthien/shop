<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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
            'new.required' => 'Nhập tình trạng sản phẩm',
        ];
    }
}
