<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cat extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'parrent_cat'];

    public $timestamps = false;

    public function getSuperCat()
    {
        return DB::table('categories')
            ->where('parrent_cat', '=', null)
            ->select('categories.*')
            ->get();
    }

    public function getCatById($id)
    {
        return DB::table('categories')
            ->where('id', '=', $id)
            ->select('categories.*')
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

    public function getSubCat($superCatId)
    {
        return DB::table('categories')
            ->where('parrent_cat', '=', $superCatId)
            ->select('categories.*')
            ->get();
    }

    public function deleteCat($id)
    {
        return DB::table('categories')
            ->where('id', '=', $id)
            ->orWhere('parrent_cat', '=', $id)
            ->delete();
    }
}
