<?php

namespace App\Http\Controllers\Admin;

use App\Model\Bill;
use App\Model\Shop;
use App\Model\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index()
    {
        $billModel = new Bill();

        $objShop = Shop::all();
        $objBill = $billModel->getBill();
        $objStatus = Status::all();
        return view('admin.bill.index', [
            'objBill' => $objBill,
            'objStatus' => $objStatus,
            'objShop' => $objShop
        ]);

    }

    public function filter(Request $request)
    {
        $objStatus = Status::all();
        $query = '1';
        if ($request->created_at != null){
            $query = $query.' AND date(bills.created_at) = "'.$request->created_at.'"';
        }

        if ($request->status != null){
            $query = $query.' AND status = '.$request->status;
        }

        if ($request->shop != null)
        {
            $query = $query.' AND shop_id = '.$request->shop;
        }
        $objBill = DB::table('bills')
            ->join('status', 'bills.status', '=', 'status.id')
            ->join('shops', 'shops.id', '=', 'bills.shop_id')
            ->whereRaw(''.$query)
            ->selectRaw('bills.*, status.name_status, shops.name as shop_name')
            ->paginate(5);
        ;

        $querystringArray = ['created_at' => $request->created_at, 'status' => $request->status, 'shop' => $request->shop];

        $objBill->appends($querystringArray);

        $objShop = Shop::all();
        return view('admin.bill.index', [
            'objBill' => $objBill,
            'objStatus' => $objStatus,
            'date_filter' => $request->created_at,
            'status_filter' => $request->status,
            'shop_filter' => $request->shop,
            'objShop' => $objShop,
        ]);
    }

    public function detail($shop_id, $id)
    {
        $billModel = new Bill();
        $objBill = $billModel->find($id);
        $objShop = Shop::find($shop_id);

        $objDetail = $billModel->getDetailByBillId($shop_id, $id);

        return view('admin.bill.detail', [
            'objShop' => $objShop,
            'objBill' => $objBill,
            'objDetail' => $objDetail,
        ]);
    }

    public function destroy($id)
    {
        if (Bill::destroy($id)){
            return redirect()->route('admin.bill.index')->with('msg', 'Xóa thành công');
        } else{
            return redirect()->route('admin.bill.index')->with('msg', 'Xóa thất bại');
        }
    }

    public function updateStatus($bill_id, $status_id)
    {
        $objBill = Bill::find($bill_id);
        $objBill->status = $status_id;

        $objBill->save();
        return response()->json([
            'msg'=>'Update thành công !'
        ]);
    }
}
