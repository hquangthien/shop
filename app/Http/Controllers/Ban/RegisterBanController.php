<?php

namespace App\Http\Controllers\Ban;

use App\Http\Requests\BanRegisterRequest;
use App\Model\Payment;
use App\Http\Controllers\Controller;
use App\Model\Shop;
use App\Model\Shop_Payment;
use Illuminate\Support\Facades\Auth;

class RegisterBanController extends Controller
{
    public function create()
    {
        if (Auth::check()){
            $objPayment = Payment::all();
            return view('ban.auth.register', ['objPayment' => $objPayment]);
        } else{
            return redirect()->route('login')->with('msg', 'Bạn cần đăng nhập để tạo shop');
        }
    }
    public function store(BanRegisterRequest $request)
    {
        $shopModel = new Shop();
        if (sizeof($shopModel->getShopByUserId(Auth::user()->id)) > 0){
            return redirect()->route('ban.register.create')->with('msg', 'Tài khoản này đã đăng ký mở shop');
        }

        $shopModel->user_id = Auth::user()->id;
        $shopModel->name = $request->name;
        $shopModel->phone = $request->phone;
        $shopModel->address = $request->address;

        if ($shopModel->save()){
            $shop_id = $shopModel->id;
            foreach ($request->payment as $payment) {
                Shop_Payment::create(['shop_id' => $shop_id, 'pay_id' => $payment]);
            }
        }

        return redirect()->route('ban.index.index')->with('Đăng ký shop thành công');
    }
}
