<?php

namespace App\Http\Controllers\Ban;

use App\Model\Bill;
use App\Model\Shop;
use App\Http\Controllers\Controller;
use App\Model\Statistic;
use App\Model\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index()
    {
        $shopModel = new Shop();
        $billModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        $sttModel = new Statistic();
        $sumProduct = $sttModel->getSumProductByShopId($objShop->id)[0]->sum_product;
        $sumBill = $sttModel->getSumBillByShopId($objShop->id)[0]->sum_bill;
        $sumContact = $sttModel->getSumMessageByShopId($objShop->id)[0]->sum_contact;
        $sumComment = $sttModel->getSumCmtByShopId($objShop->id)[0]->sum_comment;

        $sttBills = $sttModel->getBillByDateByShopId($objShop->id);
        $sttRevenue = $sttModel->getRevenueByDateByShopId($objShop->id);

        $billModel = new Bill();
        $objBill = $billModel->getBillByShopIdAndStatus($objShop->id, 1);
        $objStatus = Status::all();

        return view('ban.index.index', [
            'sumProduct' => $sumProduct,
            'sumBill' => $sumBill,
            'sumContact' => $sumContact,
            'sumComment' => $sumComment,
            'sttBills' => $sttBills,
            'sttRevenue' => $sttRevenue,
            'objBill' => $objBill,
            'objStatus' => $objStatus,
        ]);
    }
}
