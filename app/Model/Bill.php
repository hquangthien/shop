<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill extends Model
{
    protected $table = 'bills';
    protected $fillable = ['shop_id', 'name', 'phone', 'address', 'email', 'status', 'total', 'payment', 'note', 'user_id'];

    public function getBill()
    {
        return DB::table('bills')
            ->join('status', 'bills.status', '=', 'status.id')
            ->join('shops', 'shops.id', '=', 'bills.shop_id')
            ->selectRaw('bills.*, status.name_status, shops.name as shop_name')
            ->orderBy('bills.created_at', 'DESC')
            ->paginate(10);
    }

    public function getBillByShopId($id)
    {
        return DB::table('bills')
            ->join('status', 'bills.status', '=', 'status.id')
            ->where('shop_id', '=', $id)
            ->selectRaw('bills.*, status.name_status')
            ->orderBy('bills.created_at', 'DESC')
            ->paginate(10);
    }

    public function getBillByShopIdAndStatus($id, $status)
    {
        return DB::table('bills')
            ->join('status', 'bills.status', '=', 'status.id')
            ->where('shop_id', '=', $id)
            ->where('status', '=', $status)
            ->selectRaw('bills.*, status.name_status')
            ->orderBy('bills.created_at', 'DESC')
            ->get();
    }

    public function getDetailByBillId($shop_id, $bill_id)
    {
        return DB::table('detail_bill')
            ->join('products', 'products.id', '=', 'detail_bill.product_id')
            ->where('shop_id', '=', $shop_id)
            ->where('bill_id', '=', $bill_id)
            ->selectRaw('detail_bill.*, products.name as product_name, products.picture as product_picture')
            ->get();
    }

    public function getBillOfUser($user_id)
    {
        return DB::table('bills')
            ->join('status', 'bills.status', '=', 'status.id')
            ->where('user_id', '=', $user_id)
            ->selectRaw('bills.*, status.name_status')
            ->orderBy('bills.created_at', 'DESC')
            ->paginate(10);
    }
}

