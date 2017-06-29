<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{

    protected $table = 'products';
    protected $fillable = ['name', 'cat_id', 'description', 'price', 'promotion_price', 'picture', 'new', 'status', 'active_product', 'shop_id', 'created_at', 'updated_at', 'pin'];
    public $timestamps = true;

    public function getProductToShowAdmin()
    {
        return DB::table('products')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->selectRaw('products.*, shops.name as name_shop')
            ->paginate(10);
    }

    public function getProductToShowBan($shop_id)
    {
        return DB::table('products')
            ->leftJoin('detail_bill', 'detail_bill.product_id', '=', 'products.id')
            ->leftJoin('bills', 'detail_bill.bill_id', '=', 'bills.id')
            ->where('products.shop_id', '=', $shop_id)
            ->orderBy('products.created_at', 'DESC')
            ->groupBy('products.id', 'products.name', 'products.cat_id', 'products.description', 'products.price', 'products.promotion_price', 'products.picture',
                'products.new', 'products.status', 'products.active_product', 'products.shop_id', 'products.created_at', 'products.updated_at', 'pin')
            ->selectRaw('products.id, products.name, products.cat_id, products.description, products.price, products.promotion_price, 
            products.picture, products.new, products.status, products.active_product, products.shop_id, products.created_at, products.updated_at, products.pin, 
            count(if(bills.status in (3, 6), 1, 0)) as count_sales')
            ->paginate(10);
    }

    public function getProductOfCatPublic($id, $limit)
    {
        return DB::table('products')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->whereRaw(
            'products.active_product = 1 and products.status = 1  and
                (cat_id in (
                    select categories.id 
                        from categories 
                        where parrent_cat = '.$id.' 
                ) OR cat_id = '.$id.')'
            )
            ->orderByRaw('price*(1 - promotion_price/100) ASC')
            ->selectRaw('products.*, shops.name as shop_name')
            ->paginate(10);
    }

    public function getProductOfCatOfShop($id, $limit, $shop_id)
    {
        return DB::table('products')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->whereRaw(
                'products.shop_id = '.$shop_id.' and products.active_product = 1 and products.status = 1  and
                (cat_id in (
                    select categories.id 
                        from categories 
                        where parrent_cat = '.$id.' 
                ) OR cat_id = '.$id.')'
            )
            ->orderBy('')
            ->orderBy('created_at', 'DESC')
            ->selectRaw('products.*, "" as user_id, shops.name as shop_name')
            ->paginate(10);
    }

    public function getProductSameSearch($key_search)
    {
        return DB::table('products')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->whereRaw(
                'products.name like "%'.$key_search.'%" and products.active_product = 1 and products.status = 1'
            )
            ->orderByRaw('price*(1 - promotion_price/100) ASC')
            ->selectRaw('products.*, shops.name as shop_name')
            ->paginate(10);
    }

    public function countProductOfCat($id)
    {
        return DB::table('products')
            ->where('cat_id', '=', $id)
            ->where('products.active_product', '=', 1)
            ->where('products.status', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->groupBy('id')
            ->selectRaw('id, count(products.id) as sum_product')
            ->get();
    }

    public function getHotProduct()
    {
        return DB::table('products')
            ->join('detail_bill', 'detail_bill.product_id', '=', 'products.id')
            ->join('bills', 'detail_bill.bill_id', '=', 'bills.id')
            ->join('shops', 'bills.shop_id', '=', 'shops.id')
            ->whereRaw('products.active_product = 1 and products.status = 1  and shops.active_shop = 1')
            ->groupBy('products.id', 'shops.name', 'products.id', 'products.name', 'products.price', 'products.promotion_price', 'products.picture',
                'products.new', 'products.shop_id')
            ->selectRaw('products.id, "" as user_id, shops.name as shop_name, products.id, products.name, products.price, products.promotion_price, 
        products.picture, products.new, products.shop_id,
        count(bills.status) as count_sales')
            ->orderBy('count_sales', 'DESC')
            ->take(6)
            ->get();

    }

    public function getHotProductOfShop($shop_id)
    {
        return DB::table('products')
            ->join('detail_bill', 'detail_bill.product_id', '=', 'products.id')
            ->join('bills', 'detail_bill.bill_id', '=', 'bills.id')
            ->join('shops', 'bills.shop_id', '=', 'shops.id')
            ->whereRaw('products.active_product = 1  and shops.active_shop = 1 and products.status = 1 and products.shop_id = '.$shop_id.'')
            ->groupBy('shops.name', 'products.id', 'products.name', 'products.price', 'products.promotion_price', 'products.picture',
                'products.new', 'products.shop_id')
            ->selectRaw('"" as user_id, shops.name as shop_name, products.id, products.name, products.price, products.promotion_price, 
            products.picture, products.new, products.shop_id,
            count(bills.status) as count_sales')
            ->orderBy('count_sales', 'DESC')
            ->take(4)
            ->get();
    }

    public function getNewProductOfShop($shop_id)
    {
        return DB::table('products')
            ->join('shops', 'products.shop_id', '=', 'shops.id')
            ->whereRaw('products.active_product = 1 and products.status = 1 and shops.active_shop = 1 and products.shop_id = '.$shop_id.'')
            ->selectRaw('"" as user_id, shops.name as shop_name, products.id, products.name, products.price, products.promotion_price, 
            products.picture, products.new, products.shop_id')
            ->orderBy('products.created_at', 'DESC')
            ->take(8)
            ->get();
    }

    public function getCatOfShop($shop_id)
    {
        return DB::table('categories')
            ->join('products', 'products.cat_id', '=', 'categories.id')
            ->where('products.shop_id', '=', $shop_id)
            ->groupBy('categories.id', 'categories.name', 'parrent_cat')
            ->selectRaw('categories.*')
            ->get();
    }

    public function getPinProduct()
    {
        return DB::table('products')
            ->leftJoin('user_product', 'user_product.product_id', '=', 'products.id')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->where('pin', '=', '1')
            ->where('products.status', '=', '1')
            ->where('products.active_product', '=', '1')
            ->where('shops.active_shop', '=', 1)
            ->orderBy('updated_at', 'DESC')
            ->selectRaw('products.*, user_product.user_id, shops.name as shop_name')
            ->take(10)
            ->get();
    }

    public function getRecentProduct()
    {
        return DB::table('products')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->where('products.status', '=', '1')
            ->where('products.active_product', '=', '1')
            ->orderBy('created_at', 'DESC')
            ->whereRaw('products.status = 1 and products.active_product = 1')
            ->selectRaw('products.*, shops.name as shop_name')
            ->take(4)
            ->get();
    }

    public function getFavProductOfUser($limit, $user_id)
    {
        return DB::table('products')
            ->leftJoin('user_product', 'products.id', '=', 'user_product.product_id')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->whereRaw(
                'products.active_product = 1 and products.status = 1 and user_product.user_id  = '.$user_id
            )
            ->orderBy('created_at', 'DESC')
            ->selectRaw('products.*, user_product.user_id, shops.name as shop_name')
            ->paginate(10);
    }

    public function filter($query, $order)
    {
        return DB::table('products')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->whereRaw($query)
            ->orderByRaw('price*(1 - promotion_price/100) '.$order)
            ->selectRaw('products.*, shops.name as shop_name')
            ->paginate(4);
    }

    public function getPopularProduct()
    {
        return DB::table('products')
            ->orderBy('views', 'DESC')
            ->whereRaw('created_at >= DATE(NOW()) - INTERVAL 3 DAY')
            ->select('products.*')
            ->take(3)
            ->get();
    }

    public function getProOfTag($tag_id)
    {
        return DB::table('products')
            ->join('product_tag', 'products.id', '=', 'product_tag.product_id')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->whereRaw(
                'products.active_product = 1 and products.status = 1 and product_tag.id = '.$tag_id
            )
            ->orderBy('created_at', 'DESC')
            ->selectRaw('products.*, shops.name as shop_name')
            ->paginate(10);
    }

    public function getRecentProductComment()
    {
        return DB::table('products')
            ->join('comments', 'comments.products_id', '=', 'products.id')
            ->orderBy('comments.created_at', 'DESC')
            ->select('products.id', 'products.title', 'products.preview', 'products.picture')
            ->groupBy('products.id', 'products.title', 'products.preview', 'products.picture')
            ->take(3)
            ->get();
    }

    public function getProductOfSuperCat($id, $limit)
    {
        return DB::table('products')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->whereRaw(
                'products.active_product = 1 and  shops.active_shop = 1 and  products.status = 1 and
                (cat_id in (
                    select categories.id 
                        from categories 
                        where parrent_cat = '.$id.' 
                ) OR cat_id = '.$id.') '
            )
            ->orderBy('created_at', 'DESC')
            ->selectRaw('products.*, "" as user_id, shops.name as shop_name')
            ->take($limit)
            ->get();
    }


    public function paginateProductOfSuperCat($id, $limit)
    {
        return DB::table('products')
            ->whereIn('cat_id', function ($query) use ($id) {
                $query->select('id')->from('categories')
                    ->where('parrent_cat', '=', $id);

            })
            ->orWhere('cat_id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
    }

    public function getProductOfCat($id, $limit)
    {
        return DB::table('products')
            ->where('cat_id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
    }

    public function countCommentOfProduct($products_id){
        return DB::table('comments')
            ->where('products_id', '=', $products_id)
            ->selectRaw('COUNT(comments.id) as count_cmt')
            ->get();
    }

    public function getProductById($id)
    {
        return DB::table('products')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->where('products.id', '=', $id)
            ->selectRaw('products.*, shops.name as shop_name')
            ->get();
    }

    public function getTagsOfProduct($id)
    {
        return DB::table('product_tag')
            ->join('tags', 'tags.id', '=', 'product_tag.tag_id')
            ->where('product_id', '=', $id)
            ->get();
    }

    public function getRelateProduct($id, $cat_id)
    {
        return DB::table('products')
            ->where('id', '<>', $id)
            ->where('cat_id', '=', $cat_id)
            ->orderBy('created_at')
            ->take(5)
            ->get();
    }

    public function getCommentsOfProduct($id)
    {
        return DB::table('comments')
            ->where('product_id', '=', $id)
            ->where('active_cmt', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getAllProductToShow()
    {
        return DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.cat_id')
            ->join('users', 'users.id', '=', 'products.created_by')
            ->orderBy('id', 'DESC')
            ->selectRaw('products.*, categories.name as cat_name, users.username')
            ->paginate(10);
    }

    public function insertGetId($data){
        DB::table('products')
            ->insertGetId($data);
    }

    public function deleteAllTagsOfProduct($id)
    {
        return DB::table('product_tag')
            ->join('tags', 'tags.id', '=', 'product_tag.tag_id')
            ->where('product_id', '=', $id)
            ->delete();
    }

    public function searchByTitle($key)
    {
        return DB::table('products')
            ->whereRaw('title LIKE "%'.$key.'%"')
            ->orWhereRaw('preview LIKE "%'.$key.'%"')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    public function getProductOfTag($tag_id)
    {
        return DB::table('products')
            ->join('products_tags', 'products.id', '=', 'products_tags.products_id')
            ->where('products_tags.tag_id', '=', $tag_id)
            ->orderBy('created_at', 'DESC')
            ->selectRaw('products.*')
            ->paginate(10);
    }

    public function getAllProductSearching($key)
    {
        return DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.cat_id')
            ->join('users', 'users.id', '=', 'products.created_by')
            ->whereRaw('title like "%'.$key.'%"')
            ->orderBy('id', 'DESC')
            ->selectRaw('products.*, categories.name as cat_name, users.username')
            ->paginate(10);
    }
}
