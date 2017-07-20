<?php

namespace App\Http\Controllers\Shop;

use App\Model\Cat;
use App\Model\Comment;
use App\Model\Product;
use App\Http\Controllers\Controller;
use App\Model\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function cat($slug, $id)
    {
        $objCat = Cat::find($id);
        if (sizeof($objCat) == 0) {
            return redirect()->route('shop.error');
        }
        if (str_slug($objCat->name) != $slug) {
            return redirect()->route('shop.product.cat', ['slug' => str_slug($objCat->name), 'id' => $objCat->id]);
        }
        $modelProduct = new Product();
        $objProductOfCat = $modelProduct->getProductOfCatPublic($id, 10);

        return view('shop.product.cat', [
            'objProduct' => $objProductOfCat,
            'objCat' => $objCat,
        ]);
    }

    public function detail($slug, $id)
    {
        $productModel = new Product();
        $product = $productModel->getProductById($id);
        if (sizeof($product) == 0) {
            return redirect()->route('shop.error');
        }
        if (str_slug($product[0]->name) != $slug) {
            return redirect()->route('shop.product.detail', ['slug' => str_slug($product[0]->name), 'id' => $product[0]->id]);
        }
        $tagModel = new Tag();

        $relativeProduct = $productModel->getRelateProduct($id, $product[0]->cat_id);

        $objCmt = $productModel->getCommentsOfProduct($id);

        $objTag = $tagModel->getTagOfProductId($id);

        return view('shop.product.detail',[
            'product' => $product[0],
            'relativeProduct' => $relativeProduct,
            'objCmt' => $objCmt,
            'objTag' => $objTag
        ]);
    }

    public function comment(Request $request)
    {
        $productModel = new Product();
        if(Comment::create($request->toArray())){
            $objCmt = $productModel->getCommentsOfProduct($request->product_id);
            return view('shop.product.comment', ['objCmt' => $objCmt]);
        }
    }

    public function filter(Request $request)
    {
        $productModel = new Product();

        $query = '1';

        $objCurrentCat = Cat::find($request->current_cat);

        if ($objCurrentCat->parrent_cat == null && $request->cat_filter == "all"){
            $query .= ' AND cat_id IN (select id from categories where parrent_cat = '.$request->current_cat.')';
        }elseif($objCurrentCat->parrent_cat == null && $request->cat_filter == null){
            $query .= ' AND cat_id IN (select id from categories where parrent_cat = '.$request->current_cat.')';
        }elseif($objCurrentCat->parrent_cat == null && $request->cat_filter != null) {
            $query .= ' AND cat_id = '.$request->cat_filter;
        }
        elseif($objCurrentCat->parrent_cat != null && $request->cat_filter == "all"){
            $query .= ' AND cat_id IN (select id from categories where parrent_cat = '.$objCurrentCat->parrent_cat.')';
        } elseif($objCurrentCat->parrent_cat != null && $request->cat_filter == "")
        {
            $query .= ' AND cat_id = '.$request->current_cat;
        } elseif($objCurrentCat->parrent_cat != null && $request->cat_filter != null)
        {
            $query .= ' AND cat_id = '.$request->cat_filter;
        }

        if ($request->price_filter != null) {
            switch ($request->price_filter) {
                case '1':
                    $query .= ' AND price*(1 - promotion_price/100) < 1000000';
                    break;
                case '2':
                    $query .= ' AND price*(1 - promotion_price/100) >= 1000000 AND price*(1 - promotion_price/100) < 2000000';
                    break;
                case '3':
                    $query .= ' AND price*(1 - promotion_price/100) >= 2000000 AND price*(1 - promotion_price/100) < 3000000';
                    break;
                case '4':
                    $query .= ' AND price*(1 - promotion_price/100) >= 3000000 AND price*(1 - promotion_price/100) < 5000000';
                    break;
                case '5':
                    $query .= ' AND price*(1 - promotion_price/100) >= 5000000 AND price*(1 - promotion_price/100) < 8000000';
                    break;
                case '6':
                    $query .= ' AND price*(1 - promotion_price/100) >= 8000000 AND price*(1 - promotion_price/100) < 12000000';
                    break;
                case '7':
                    $query .= ' AND price*(1 - promotion_price/100) >= 12000000';
                    break;
            }
        }

        if ($request->status_filter != null) {
            switch ($request->status_filter) {
                case '1':
                    $query .= ' AND new = "new"';
                    break;
                case '2':
                    $query .= ' AND new <> "new"';
                    break;
            }
        }

        if ($request->promotion_filter == "1") {
            $query .= ' AND promotion_price <> 0';
        }

        $objProduct = $productModel->filter($query, $request->order_filter);

        $filter = [
            'current_cat' => ''.$request->current_cat,
            'cat_filter' => ''.$request->cat_filter,
            'price_filter' => ''.$request->price_filter,
            'status_filter' => ''.$request->status_filter,
            'promotion_filter' => ''.$request->promotion_filter,
            'order_filter' => ''.$request->order_filter,
        ];

        return view('shop.product.filter', [
            'filter' => $filter,
            'objProduct' => $objProduct,
            'totalPage' => $objProduct->lastPage(),
            'currentPage' => $objProduct->currentPage()+1
        ]);
    }

    public function tag($slug, $id)
    {
        $modelProduct = new Product();
        $objProductOfCat = $modelProduct->getProOfTag($id);

        $objTag = Tag::find($id);
        return view('shop.product.tag', [
            'objProduct' => $objProductOfCat,
            'objTag' => $objTag,
        ]);
    }
}
