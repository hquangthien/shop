<?php

namespace App\Http\Controllers\Ban;

use App\Model\Bill;
use App\Http\Controllers\Controller;
use App\Model\Shop;
use App\Model\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index()
    {
        $shopModel = new Shop();
        $billModel = new Bill();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];

        $objBill = $billModel->getBillByShopId($objShop->id);
        $objStatus = Status::all();
        return view('ban.bill.index', ['objBill' => $objBill, 'objStatus' => $objStatus]);

    }

    public function filter(Request $request)
    {
        $shopModel = new Shop();
        $objStatus = Status::all();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        $query = 'shop_id = '.$objShop->id.'';
        if ($request->created_at != null){
            $query = $query.' AND date(created_at) = "'.$request->created_at.'"';
        }

        if ($request->status != null){
            $query = $query.' AND status = '.$request->status;
        }
        $objBill = DB::table('bills')
            ->join('status', 'bills.status', '=', 'status.id')
            ->whereRaw(''.$query)
            ->selectRaw('bills.*, status.name_status')
            ->paginate(5);
        ;

        $querystringArray = ['created_at' => $request->created_at, 'status' => $request->status];

        $objBill->appends($querystringArray);

        return view('ban.bill.index', [
            'objBill' => $objBill,
            'objStatus' => $objStatus,
            'date_filter' => $request->created_at,
            'status_filter' => $request->status,
        ]);
    }

    public function detail($id)
    {
        $billModel = new Bill();
        $objBill = $billModel->find($id);
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objBill->shop_id != $objShop->id)
        {
            return false;
        }

        $objDetail = $billModel->getDetailByBillId($objShop->id, $id);

        return view('ban.bill.detail', [
            'objShop' => $objShop,
            'objBill' => $objBill,
            'objDetail' => $objDetail,
        ]);
    }

    public function destroy($id)
    {
        $objBill = Bill::find($id);
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objBill->shop_id != $objShop->id)
        {
            Auth::logout();
            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
        }
        if ($objBill->delete())
        {
            return redirect()->route('ban.bill.index')->with('msg', 'Xóa thành công');
        } else{
            return redirect()->route('ban.bill.index')->with('msg', 'Có lỗi khi xóa');
        }
    }

    public function updateStatus($bill_id, $status_id)
    {
        $objBill = Bill::find($bill_id);
        $objBill->status = $status_id;

        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objBill->shop_id != $objShop->id)
        {
            return false;
        }

        $objBill->save();
        return response()->json([
            'msg'=>'Update thành công !'
        ]);
    }
}
