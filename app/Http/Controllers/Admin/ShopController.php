<?php

namespace App\Http\Controllers\Admin;

use App\Model\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    private $shopModel;

    public function __construct(Shop $shopModel)
    {
        $this->shopModel = $shopModel;
    }

    public function index()
    {
        $objShop = $this->shopModel->getShopToShowAdmin();
        return view('admin.shop.index', ['objShop' => $objShop]);
    }

    public function destroy($id)
    {
        if ($this->shopModel->destroy($id))
        {
            return redirect()->route('admin.shop.index')->with('msg_dlt', 'Xóa shop thành công');
        } else{
            return redirect()->route('admin.shop.index')->with('msg_dlt', 'Có lỗi khi xóa shop');
        }
    }

    public function updateActive($id)
    {
        $objShop = $this->shopModel->find($id);
        
        if ($objShop->active_shop == 0){
            $objShop->active_shop = 1;
            $active = 1;
        } else{
            $objShop->active_shop = 0;
            $active = 0;
        }
        $objShop->save();
        return response()->json([
            'message'=>'Update thành công !',
            'active'=> $active
        ]);
    }
}
