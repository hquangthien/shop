<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\InfoCustomRequest;
use App\Http\Requests\PaymentCustomRequest;
use App\Mail\OrderShipped;
use App\Model\Bill;
use App\Model\BillDetail;
use  App\Model\Cart;
use App\Model\Payment;
use App\Model\Product;
use App\Model\Product_User;
use App\Http\Controllers\Controller;
use App\Model\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class BillController extends Controller
{

    public function getCheckout()
    {
        $objInfo = Session('info')?Session::get('cart'):null;
        $objPayment = Session('payment')?Session::get('cart'):null;
        if ($objInfo == null && $objPayment == null)
        {
            return redirect()->route('shop.bill.confirm_info');
        } elseif($objPayment == null){
            return redirect()->route('shop.bill.get_payment');
        }
        $objCart = $oldCart = Session('cart')?Session::get('cart'):null;
        if ($objCart == null)
        {
            return redirect()->route('shop.index.index');
        }
        $arShop_id = [];
        foreach ($objCart->items as $items){
            if (!in_array($items['item']->shop_id, $arShop_id, true)){
                array_push($arShop_id, $items['item']->shop_id);
            }
        }

        $objShop = Shop::whereRaw('id in ('.implode($arShop_id, ",").')')->get();

        $objPayment = Payment::all();
        return view('shop.bill.checkout', [
            'objPayment' => $objPayment,
            'objShop' => $objShop,
        ]);
    }

    public function checkout(PaymentCustomRequest $request)
    {
        $request->session()->put('payment',$request->payment);
        $objCart = $oldCart = Session('cart')?Session::get('cart'):null;
        if ($objCart == null)
        {
            return redirect()->route('shop.index.index');
        }
        $arShop_id = [];
        foreach ($objCart->items as $items){
            if (!in_array($items['item']->shop_id, $arShop_id, true)){
                array_push($arShop_id, $items['item']->shop_id);
            }
        }

        $objShop = Shop::whereRaw('id in ('.implode($arShop_id, ",").')')->get();

        $objPayment = Payment::all();
        return view('shop.bill.checkout', [
            'objPayment' => $objPayment,
            'objShop' => $objShop,
        ]);
    }

    public function info(Request $request)
    {
        if (!Session('cart')){
            return redirect()->route('shop.index.index');
        }
        return view('shop.bill.info');
    }

    public function payment(InfoCustomRequest $request)
    {
        $objInfo = [];
        $objInfo['name'] = $request->name;
        $objInfo['phone'] = $request->phone;
        $objInfo['address'] = $request->address;
        $objInfo['email'] = $request->email;
        $objInfo['note'] = $request->note;

        $request->session()->put('info',$objInfo);
        $objPayment = Payment::all();
        return view('shop.bill.payment', ['objPayment' => $objPayment]);
    }

    public function getPayment()
    {
        $objPayment = Payment::all();
        return view('shop.bill.payment', ['objPayment' => $objPayment]);
    }

    public function cart(Request $request)
    {
        return view('shop.bill.cart');
    }

    public function addToFavorite($id)
    {
        if (!Auth::check()){
            return response()->json(false);
        }
        $objProUser = Product_User::where('user_id', '=', Auth::user()->id)->where('product_id', '=', $id)->get();

        if (sizeof($objProUser) == 0)
        {
            Product_User::create(['user_id' => Auth::user()->id, 'product_id' => $id]);
            $favorite = 1;
        } else{
            $favorite = 0;
            Product_User::destroy($objProUser[0]->id);
        }

        return response()->json([
            'message'=>'Update thành công !',
            'favorite' => $favorite,
            'id' => $id
        ]);
    }

    public function addToCart(Request $req, $id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart',$cart);
        return response()->json([
            'message'=>'Update thành công!'
        ]);
    }

    public function order($shop_id)
    {
        $objCart = $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $objInfo = Session('info')?Session::get('info'):null;
        $objPayment = Session('payment')?Session::get('payment'):null;

        $arObjDetails = [];
        $total = 0;
        foreach ($objCart->items as $key => $items){
            if ($items['item']->shop_id == $shop_id)
            {
                $cart->removeItem($key);

                $objDetail = new BillDetail();
                $objDetail->product_id = $items['item']->id;
                $objDetail->quantity = $items['qty'];
                $price = $items['item']->price - ($items['item']->price*$items['item']->promotion_price)/100;
                $objDetail->price = $price;

                $total += $price*$items['qty'];

                array_push($arObjDetails, $objDetail);
            }
        }

        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }

        $objBills = new Bill();
        $objBills->name = $objInfo['name'];
        $objBills->shop_id = $shop_id;
        $objBills->phone = $objInfo['phone'];
        $objBills->address = $objInfo['address'];
        $objBills->email = $objInfo['email'];
        $objBills->total = $total;
        $objBills->note = $objInfo['note'];
        $objBills->payment = $objPayment;
        if (Auth::check()){
            $objBills->user_id = Auth::user()->id;
        }
        $objBills->save();

        foreach ($arObjDetails as $objDetail)
        {
            $objDetail->bill_id = $objBills->id;
            $objDetail->save();
        }

        $objDetail = $objBills->getDetailByBillId($objBills->shop_id, $objBills->id);

        $objShop = Shop::find($objBills->shop_id);

        Mail::to($objBills->email)->send(new OrderShipped($objBills, $objDetail, $objShop, 'Đặt hàng thành công'));

        return view('shop.bill.detail', [
            'objShop' => $objShop,
            'objBill' => $objBills,
            'objDetail' => $objDetail,
            'objShop' => $objShop
        ]);
    }

    public function addToCartWithQty(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->addWithQty($product, $id, $request->qty);

        $request->session()->put('cart',$cart);
        return response()->json([
            'message'=>'Update thành công!',
            'total' => $request->session()->get('cart.totalQty')
        ]);
    }

    public function removeCart($id, Request $request)
    {
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        return response()->json([
            'message'=>'Update thành công!',
            'total' => $request->session()->get('cart.totalQty')
        ]);
    }
}
