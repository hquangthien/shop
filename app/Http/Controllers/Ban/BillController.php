<?php

namespace App\Http\Controllers\Ban;

use App\Model\Bill;
use App\Http\Controllers\Controller;
use App\Model\Shop;
use App\Model\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
            return redirect()->route('ban.bill.index')->with('msg_dlt', 'Xóa thành công');
        } else{
            return redirect()->route('ban.bill.index')->with('msg_dlt', 'Có lỗi khi xóa');
        }
    }

    public function updateStatus($bill_id, $status_id)
    {
        $objBill = Bill::find($bill_id);
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objBill->shop_id != $objShop->id)
        {
            Auth::logout();
            return false;
        }

        if ($status_id == 2 || $status_id == 4)
        {
            $data = [
                'name' => "E-Shopper",
                'email' => "hquangthien1@gmail.com",
                'links' => ''.route('blank.page.bill.detail', ['id' => $bill_id])
            ];
            $objBill->status = $status_id;
            switch ($status_id){
                case 2:
                    if ($objBill->payment == 1)
                    {
                        $objBill->status = 3;
                    } else{
                        $objBill->status = 2;
                    }
                    $data['subject'] = "Thông báo xác nhận đơn hàng #{$objBill->id}";
                    $data['detail'] = $objShop->name." đã xác nhận còn hàng đối với đơn hàng #".$objBill->id;
                    Mail::to('hquangthien1@gmail.com', 'Hoàng Quang Thiên')->send(new \App\Mail\Notification($data));
                    break;
                case 4:
                    $data['subject'] = "Thông báo hủy đơn hàng #{$objBill->id}";
                    $data['detail'] = "Đơn hàng #{$objBill->id} đã bị hủy vì shop không đáp ứng được sản phẩm đặt hàng. Chúng tôi vô cùng lấy làm tiếc về sự bất tiện này";
                    Mail::to('' . $objBill->email, '' . $objBill->name)->send(new \App\Mail\Notification($data));
                    break;

            }

            $objBill->save();
            $nameStatus = Status::where('id', '=', $objBill->status)->first()->name_status;
            return response()->json([
                'msg'=>'Update thành công !',
                'name_status' => $nameStatus,
                'id_status' => $objBill->status
            ]);
        }
    }
}
