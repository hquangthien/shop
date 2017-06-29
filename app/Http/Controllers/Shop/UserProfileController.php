<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\GuestEditRequest;
use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Product;
use App\Model\Shop;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index($slug)
    {
        return view('shop.profile.profile');
    }

    public function update(GuestEditRequest $request, $slug)
    {
        $objUser = User::find(Auth::user()->id);
        if (isset($request->password)){
            $objUser->password = bcrypt(trim($request->password));
        }
        $objUser->fullname = $request->fullname;
        $objUser->phone = $request->phone;
        $objUser->address = $request->address;

        if ($objUser->save())
        {
            return redirect()->route('shop.profile.index', ['slug' => str_slug($objUser->username)])->with('msg', 'Cập nhật thông tin thành công');
        }
    }

    public function history($slug)
    {
        $billModel = new Bill();

        $objBill = $billModel->getBillOfUser(Auth::user()->id);
        return view('shop.profile.history', ['objBill' => $objBill]);
    }

    public function favorite($slug)
    {
        $proModel = new Product();

        $objProduct = $proModel->getFavProductOfUser(10, Auth::user()->id);

        return view('shop.profile.favorite', ['objProduct' => $objProduct]);
    }

    public function detail($id)
    {
        $billModel = new Bill();
        $objBill = $billModel->find($id);
        if ($objBill->user_id != Auth::user()->id)
        {
            return false;
        }
        $shopModel = new Shop();
        $objShop = Shop::find($objBill->shop_id);
        $objDetail = $billModel->getDetailByBillId($objShop->id, $id);
        return view('shop.profile.detail', [
            'objShop' => $objShop,
            'objBill' => $objBill,
            'objDetail' => $objDetail,
        ]);
    }

}
