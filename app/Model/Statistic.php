<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Statistic extends Model
{

    public function getNewProduct()
    {
        return DB::table('products')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->whereRaw('active_product = 2')
            ->selectRaw('products.*, shops.name as name_shop')
            ->get();
    }

    public function countShop()
    {
        return DB::table('shops')
            ->selectRaw('count(shops.name) as count_shop')
            ->get();
    }

    public function getSumProductByShopId($shop_id)
    {
        return DB::table('products')
            ->where('shop_id', '=', $shop_id)
            ->where('status', '=', 1)
            ->selectRaw('count(products.id) as sum_product')
            ->get();
    }

    public function getSumProduct()
    {
        return DB::table('products')
            ->where('status', '=', 1)
            ->selectRaw('count(products.id) as sum_product')
            ->get();
    }

    public function getSumBillByShopId($shop_id)
    {
        return DB::table('bills')
            ->where('shop_id', '=', $shop_id)
            ->whereRaw('status in (6, 7)')
            ->selectRaw('count(bills.id) as sum_bill')
            ->get();
    }

    public function getSumBill()
    {
        return DB::table('bills')
            ->where('status', '=', 7)
            ->selectRaw('count(bills.id) as sum_bill')
            ->get();
    }

    public function getSumBillPending()
    {
        return DB::table('bills')
            ->whereRaw('status in (1, 2, 3)')
            ->selectRaw('count(bills.id) as sum_bill')
            ->get();
    }

    public function getSumMessageByShopId($shop_id)
    {
        return DB::table('contacts')
            ->where('shop_id', '=', $shop_id)
            ->selectRaw('count(contacts.id) as sum_contact')
            ->get();
    }

    public function getSumCmtByShopId($shop_id)
    {
        return DB::table('comments')
            ->where('shop_id', '=', $shop_id)
            ->selectRaw('count(comments.id) as sum_comment')
            ->get();
    }

    public function getBillByDateByShopId($shop_id)
    {
        return DB::table('bills')
            ->where('shop_id', '=', $shop_id)
            ->groupBy(DB::raw('date(created_at)'))
            ->selectRaw('date(created_at) as date, count(bills.id) as count_bill')
            ->get();
    }

    public function getBillByDate()
    {
        return DB::table('bills')
            ->groupBy(DB::raw('date(created_at)'))
            ->selectRaw('date(created_at) as date, count(bills.id) as count_bill')
            ->get();
    }

    public function getRevenueByDateByShopId($shop_id)
    {
        return DB::table('bills')
            ->where('shop_id', '=', $shop_id)
            ->whereRaw('status in (6, 7)')
            ->groupBy(DB::raw('date(created_at)'))
            ->selectRaw('date(created_at) as date, sum(bills.total) as total')
            ->get();
    }

    public function getRevenueByDate()
    {
        return DB::table('bills')
            ->where('status', '=', 6)
            ->orWhere('status', '=', 7)
            ->groupBy(DB::raw('date(updated_at)'))
            ->selectRaw('date(updated_at) as date, sum(bills.total) as total')
            ->get();
    }
}
