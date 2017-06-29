<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product_User extends Model
{
    protected $table = 'user_product';
    protected $fillable = ['user_id', 'product_id'];

    public $timestamps = false;

    public function getProIdByUserId($user_id)
    {
        return DB::table('user_product')
            ->where('user_id', '=', $user_id)
            ->selectRaw('product_id')
            ->get();
    }
}
