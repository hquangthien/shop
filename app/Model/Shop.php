<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shop extends Model
{
    protected $table = 'shops';
    protected $fillable = ['user_id', 'name', 'phone', 'active_shop', 'website'];

    public function insertGetId($data){
        return DB::table('shops')
            ->insertGetId($data);
    }

    public function getShopByUserId($id)
    {
        return DB::table('shops')
            ->where('user_id', '=', $id)
            ->get();
    }

    public function getShopToShowAdmin()
    {
        return DB::table('shops')
            ->join('users', 'users.id', '=', 'shops.user_id')
            ->leftJoin('bills', 'bills.shop_id', '=', 'shops.id')
            ->groupBy('users.username', 'shops.id', 'shops.user_id', 'shops.name', 'shops.phone', 'shops.address', 'shops.active_shop', 'shops.website', 'shops.created_at', 'shops.updated_at')
            ->selectRaw('users.username, shops.id, shops.user_id, shops.name, shops.phone, shops.address, shops.active_shop, shops.website, shops.created_at, shops.updated_at, max(bills.updated_at) as last_activity')
            ->paginate(10);
    }
}
