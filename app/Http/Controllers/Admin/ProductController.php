<?php

namespace App\Http\Controllers\Admin;

use App\Model\Product;
use App\Model\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $productModel = new Product();
        $objShop = Shop::all();
        $objProduct = $productModel->getProductToShowAdmin();
        return view('admin.product.index', ['objShop' => $objShop, 'objProduct' => $objProduct]);
    }

    public function cancelProduct($id)
    {
        $objProduct = Product::find($id);
        $objProduct->active_product = 0;

        $objProduct->save();
        return response()->json([
            'message'=>'Update thành công !',
            'active' => 0
        ]);
    }

    public function updateActive($id)
    {
        $objProduct = Product::find($id);

        if ($objProduct->active_product == 1){
            $objProduct->active_product = 0;
            $active = 0;
        } else{
            $objProduct->active_product = 1;
            $active = 1;
        }
        $objProduct->save();
        return response()->json([
            'message'=>'Update thành công !',
            'active' => $active
        ]);
    }

    public function filter(Request $request)
    {
        $objShop = Shop::all();
        $query = '1';
        if ($request->created_at != null){
            $query = $query.' AND date(products.created_at) = "'.$request->created_at.'"';
        }

        if ($request->status != null){
            $query = $query.' AND products.active_product = '.$request->status;
        }

        if ($request->shop != null){
            $query = $query.' AND products.shop_id = '.$request->shop;
        }
        $objProduct = DB::table('products')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->whereRaw(''.$query)
            ->selectRaw('products.*, shops.name as name_shop')
            ->paginate(10);
        ;

        $querystringArray = ['created_at' => $request->created_at, 'status' => $request->status, 'shop' => $request->shop];

        $objProduct->appends($querystringArray);

        return view('admin.product.index', [
            'objProduct' => $objProduct,
            'date_filter' => $request->created_at,
            'shop_filter' => $request->shop,
            'status_filter' => $request->status,
            'objShop' => $objShop
        ]);
    }

    public function updatePin($id)
    {
        $objProduct = Product::find($id);

        if ($objProduct->pin == 0){
            $objProduct->pin = 1;
            $active = 1;
        } else{
            $objProduct->pin = 0;
            $active = 0;
        }
        $objProduct->save();
        return response()->json([
            'message'=>'Update thành công !',
            'active' => $active
        ]);
    }

    public function destroy($id)
    {
        if (Product::destroy($id))
        {
            return redirect()->route('admin.product.index')->with('msg', 'Xóa thành công');
        } else{
            return redirect()->route('admin.product.index')->with('msg', 'Có lỗi khi xóa');
        }
    }
}
