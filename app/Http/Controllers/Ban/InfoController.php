<?php

namespace App\Http\Controllers\Ban;

use App\Http\Requests\InfoEditRequest;
use App\Model\Payment;
use App\Model\Shop;
use App\Http\Controllers\Controller;
use App\Model\Shop_Payment;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function getInfo()
    {
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];

        $paymentModel = new Payment();
        $objPayment = $paymentModel->getPaymentOfShopToEdit($objShop->id);

        return view('ban.info.index', ['objShop' => $objShop, 'objPayment' => $objPayment]);
    }

    public function postInfo(InfoEditRequest $request)
    {
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];

        $objShop = $shopModel->find($objShop->id);

        $objShop->name = $request->name;
        $objShop->phone = $request->phone;
        $objShop->address = $request->address;

        $objShop->save();

        Shop_Payment::where('shop_id', '=', $objShop->id)->delete();
        foreach ($request->payment as $payment) {
            Shop_Payment::create(['shop_id' => $objShop->id, 'pay_id' => $payment]);
        }

        return redirect()->route('ban.info.edit')->with('msg', 'Cập nhật thành công');
    }
}
