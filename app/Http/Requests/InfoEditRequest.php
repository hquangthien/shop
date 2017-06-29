<?php

namespace App\Http\Requests;

use App\Model\Shop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class InfoEditRequest extends FormRequest
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
        $shopModel = new Shop();
        return [
            'name' => 'required|unique:shops,name,'.$shopModel->getShopByUserId(Auth::user()->id)[0]->id,
            'phone' => 'required',
            'address' => 'required',
            'payment' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên shop',
            'name.unique' => 'Tên này đã được đăng ký',
            'phone.required' => 'Vui lòng nhập số điện thoại shop',
            'address.required' => 'Vui lòng nhập địa chỉ shop',
            'payment.required' => 'Vui lòng chọn hình thức thanh toán',
        ];
    }
}
