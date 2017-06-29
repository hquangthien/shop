<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = ['code', 'name'];

    public $timestamps = false;

    public function getPaymentOfShopToEdit($shop_id)
    {
        return DB::table('payment')
            ->leftJoin('payment_shop', 'payment_shop.pay_id', '=', 'payment.id')
            //->leftJoin('shops', 'shops.id', '=', 'payment_shop.shop_id')
            ->where('shop_id', '=', $shop_id)
            ->orWhere('shop_id', '=', null)
            ->selectRaw('payment.*, payment_shop.shop_id, payment_shop.pay_id, payment.code')
            ->get();
    }
}
