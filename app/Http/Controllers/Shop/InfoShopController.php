<?php

namespace App\Http\Controllers\Shop;

use App\Model\Cat;
use App\Model\Comment;
use App\Model\Product;
use App\Model\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoShopController extends Controller
{
    public function index($slug, $id)
    {
        $modelPro = new  Product();
        $catModel = new Cat();

        $objHotProductOfShop = $modelPro->getHotProductOfShop($id);
        $objNewProductOfShop = $modelPro->getNewProductOfShop($id);

        $objCatOfShop = $modelPro->getCatOfShop($id);
        $objSubCatOfShop = [];
        $objSuperCatOfShop = [];
        $i = 0;
        $j = 0;
        foreach ($objCatOfShop as $objCat) {
            if ($objCat->parrent_cat == null) {
                $objSuperCatOfShop[$i++] = $objCat;
            } else {
                $objSuperCatOfShop[$i++] = $catModel->find($objCat->parrent_cat);
                $objSubCatOfShop['' . $objCat->parrent_cat][$j++] = $objCat;
            }
        }

        $objShop = Shop::find($id);

        return view('shop.info_shop.index', [
            'objHotProductOfShop' => $objHotProductOfShop,
            'objNewProductOfShop' => $objNewProductOfShop,
            'objSuperCatOfShop' => $objSuperCatOfShop,
            'objSubCatOfShop' => $objSubCatOfShop,
            'objShop' => $objShop
        ]);
    }

    public function cat($slug, $id, $cat_name, $cat_id)
    {
        $objCurrentCat = Cat::find($cat_id);
        if (sizeof($objCurrentCat) == 0)
        {
            return redirect()->route('shop.page.error');
        }
        $modelProduct = new Product();

        $objProductOfCat = $modelProduct->getProductOfCatOfShop($cat_id, 10, $id);

        $objShop = Shop::find($id);

        $objCatOfShop = $modelProduct->getCatOfShop($id);
        $objSubCatOfShop = [];
        $objSuperCatOfShop = [];
        $i = 0;
        $j = 0;
        $catModel = new Cat();
        foreach ($objCatOfShop as $objCat) {
            if ($objCat->parrent_cat == null) {
                $objSuperCatOfShop[$i++] = $objCat;
            } else {
                $objSuperCatOfShop[$i++] = $catModel->find($objCat->parrent_cat);
                $objSubCatOfShop['' . $objCat->parrent_cat][$j++] = $objCat;
            }
        }

        return view('shop.info_shop.cat', [
            'objProduct' => $objProductOfCat,
            'objCurrentCat' => $objCurrentCat,
            'objShop' => $objShop,
            'objSuperCatOfShop' => $objSuperCatOfShop,
            'objSubCatOfShop' => $objSubCatOfShop
        ]);
    }

    public function feedback($slug, $id)
    {

        $catModel = new Cat();
        $cmtModel = new Comment();

        $objCatOfShop = $catModel->getCatOfShop($id);
        $objSubCatOfShop = [];
        $objSuperCatOfShop = [];
        $i = 0;
        $j = 0;
        foreach ($objCatOfShop as $objCat) {
            if ($objCat->parrent_cat == null) {
                $objSuperCatOfShop[$i++] = $objCat;
            } else {
                $objSuperCatOfShop[$i++] = $catModel->find($objCat->parrent_cat);
                $objSubCatOfShop['' . $objCat->parrent_cat][$j++] = $objCat;
            }
        }

        $objShop = Shop::find($id);
        $objCmt = $cmtModel->getCommentAboutShop($id);

        return view('shop.info_shop.feedback', [
            'objSuperCatOfShop' => $objSuperCatOfShop,
            'objSubCatOfShop' => $objSubCatOfShop,
            'objShop' => $objShop,
            'objCmt' => $objCmt,
        ]);

    }

    public function comment($slug, $id, Request $request)
    {
        $cmtModel = new Comment();
        if($cmtModel->create($request->toArray())){
            $objCmt = $cmtModel->getCommentAboutShop($id);
            return view('shop.info_shop.comment', ['objCmt' => $objCmt]);
        }
    }

    public function getContact($slug, $id)
    {
        return view('shop.page.contact');
    }
}
