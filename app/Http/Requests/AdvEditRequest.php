<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvEditRequest extends FormRequest
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
            'name' => 'required',
            'link' => 'required',
            'position' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên quảng cáo',
            'link.required' => 'Vui lòng nhập link quảng cáo',
            'position.required' =>'Vui lòng chọn vị trí quảng cáo',
        ];
    }
}
