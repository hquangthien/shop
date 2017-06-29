<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Statistic;

class IndexController extends Controller
{
    public function index()
    {
        $sttModel = new Statistic();

        $objNewProduct = $sttModel->getNewProduct();
        $countShop = $sttModel->countShop()[0]->count_shop;
        $sumBill = $sttModel->getSumBill()[0]->sum_bill;
        $sumProduct = $sttModel->getSumProduct()[0]->sum_product;
        $sumBillPending = $sttModel->getSumBillPending()[0]->sum_bill;

        $sttBills = $sttModel->getBillByDate();
        $sttRevenue = $sttModel->getRevenueByDate();

        return view('admin.index.index', [
            'objNewProduct' => $objNewProduct,
            'countShop' => $countShop,
            'sumBill' => $sumBill,
            'sumProduct' => $sumProduct,
            'sumBillPending' => $sumBillPending,
            'sttBills' => $sttBills,
            'sttRevenue' => $sttRevenue,
        ]);
    }
}
