<?php

namespace App\Http\Controllers\Shop;

use App\Model\Cat;
use App\Model\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $modelCat = new Cat();
        $modelProduct = new Product();
        $objPinProduct = $modelProduct->getPinProduct();

        $objHotProduct = $modelProduct->getHotProduct();

        $arRemainCat = $modelCat->getSuperCat();
        $arProductInRemainCat = [];
        foreach ($arRemainCat as $key => $remainCat){
            $tmp = $modelProduct->getProductOfSuperCat($remainCat->id, 4);
            if (sizeof($tmp) > 0){
                $arProductInRemainCat[$remainCat->id.'|'.$remainCat->name] = $tmp;
            }
        }

        return view('shop.index.index', [
            'objPinProduct' => $objPinProduct,
            'objHotProduct' => $objHotProduct,
            'arProductInRemainCat' => $arProductInRemainCat,
        ]);
    }
}
