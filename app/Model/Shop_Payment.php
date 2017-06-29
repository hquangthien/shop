<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop_Payment extends Model
{
    protected $table = 'payment_shop';
    protected $fillable = ['shop_id', 'pay_id'];

    public $timestamps = false;
}
