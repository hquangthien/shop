<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\SearchRequest;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchAjax(Request $request)
    {
        $objProductSearch = DB::table('products')
            ->where('name', 'like', '%'.$request->key_search.'%')
            ->take(6)
            ->get();
        return view('shop.search.list_search', ['objProductSearch' => $objProductSearch, 'key_search' => $request->key_search]);
    }

    public function search(SearchRequest $request)
    {
        $modelProduct = new Product();
        $objProductOfCat = $modelProduct->getProductSameSearch($request->key_search);

        return view('shop.search.search', [
            'objProduct' => $objProductOfCat,
            'key_search' => $request->key_search
        ]);
    }

    public function filterSearch(Request $request)
    {
        /*dd($request);*/
        $key_search = $request->key_search;
        $productModel = new Product();

        $query = 'products.name like "%'. $key_search .'%"';

        if ($request->cat_filter != null){
            $query .= ' AND cat_id IN (select id from categories where parrent_cat = '.$request->cat_filter.')';
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
            'key_search' => ''.$request->key_search,
            'cat_filter' => ''.$request->cat_filter,
            'price_filter' => ''.$request->price_filter,
            'status_filter' => ''.$request->status_filter,
            'promotion_filter' => ''.$request->promotion_filter,
            'order_filter' => ''.$request->order_filter,
        ];

        return view('shop.search.filter', [
            'filter' => $filter,
            'objProduct' => $objProduct,
            'totalPage' => $objProduct->lastPage(),
            'currentPage' => $objProduct->currentPage()+1
        ]);
    }
}
