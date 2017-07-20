<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['product_id','shop_id', 'comment_id', 'content', 'active_cmt', 'email', 'name_cmt', 'user_id'];

    public function getCommentToShow()
    {
        return DB::table('comments')
            ->join('product', 'product.id', '=', 'comments.product_id')
            ->orderBy('created_at', 'DESC')
            ->orderBy('comments.id', 'DESC')
            ->selectRaw('comments.*, product.title')
            ->paginate(10);
    }

    public function getCommentAboutShop($shop_id)
    {
        return DB::table('comments')
            ->join('shops', 'shops.id', '=', 'comments.shop_id')
            ->where('shop_id', '=', $shop_id)
            ->where('product_id', '=', null)
            ->where('active_cmt', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->selectRaw('comments.*, shops.name as name_shop')
            ->paginate(10);
    }

    public function getCommentProductOfShop($shop_id)
    {
        return DB::table('comments')
            ->join('products', 'products.id', '=', 'comments.product_id')
            ->where('comments.shop_id', '=', $shop_id)
            ->where('product_id', '<>', null)
            ->orderBy('created_at', 'DESC')
            ->orderBy('comments.id', 'DESC')
            ->selectRaw('comments.*, products.name as name_product')
            ->paginate(10);
    }
}
