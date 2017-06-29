<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'detail_bill';
    protected $fillable = ['bill_id', 'product_id', 'quantity', 'price'];
}
