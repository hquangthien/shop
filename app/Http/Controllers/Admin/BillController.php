<?php

namespace App\Http\Controllers\Admin;

use App\Model\Bill;
use App\Model\Shop;
use App\Model\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
            return redirect()->route('admin.bill.index')->with('msg_dlt', 'Xóa thành công');
        } else{
            return redirect()->route('admin.bill.index')->with('msg_dlt', 'Xóa thất bại');
        }
    }

    public function updateStatus($bill_id, $status_id)
    {
        $objBill = Bill::find($bill_id);
        if ($objBill->status > $status_id)
        {
            Auth::logout();
            return false;
        }
        $objBill->status = $status_id;
        $objBill->save();
        if ($status_id == 4 || $status_id == 5 || $status_id == 6 ) {
            $data = [
                'name' => "E-Shopper",
                'email' => "hquangthien1@gmail.com",
                'subject' => "Thông báo hủy đơn hàng #{$objBill->id}",
                'links' => ''.route('blank.page.bill.detail', ['id' => $bill_id])
            ];
            $objShop = Shop::find($objBill->shop_id);
            switch ($status_id) {
                case 4:
                    $data['detail'] = "Đơn hàng #{$objBill->id} đã bị hủy vì không thể liên lạc được với người nhận hoặc quá thời hạn. Chúng tôi sẽ liên lạc để trả lại sản phẩm cho cửa hàng của bạn trong thời gian sớm nhất";
                    break;
                case 5:
                    $data['detail'] = "Đơn hàng #{$objBill->id} đã bị hủy vì người nhận từ chối sản phẩm. Chúng tôi sẽ liên lạc để trả lại sản phẩm cho cửa hàng của bạn trong thời gian sớm nhất";
                    break;
                case 6:
                    $data['subject'] = "Thông báo gửi hàng thành công";
                    $data['detail'] = "Đơn hàng #{$objBill->id} đã gửi thành công. Chúng tôi sẽ thanh toán tiền hàng cho cửa hàng của bạn trong thời gian sớm nhất";
                    break;
            }
            Mail::to('' . $objShop->email, '' . $objShop->name)->send(new \App\Mail\Notification($data));
        }

        $nameStatus = Status::where('id', '=', $status_id)->first()->name_status;

        return response()->json([
            'msg'=>'Update thành công !',
            'name_status' => $nameStatus,
            'id_status' => $status_id
        ]);
    }

}
