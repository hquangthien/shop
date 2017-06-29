<?php

namespace App\Http\Controllers\Ban;

use App\Http\Requests\ProductEditRequest;
use App\Http\Requests\ProductRequest;
use App\Model\Product;
use App\Model\Product_Tag;
use App\Model\Shop;
use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function index()
    {
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        $objProduct = $this->productModel->getProductToShowBan($objShop->id);
        return view('ban.product.index', ['objProduct' => $objProduct]);
    }

    public function create()
    {
        return view('ban.product.create');
    }

    public function store(ProductRequest $request)
    {
        $shopModel = new Shop();

        try {
            $picture = $request->file('picture')->store('/files');
            $picture = last(explode('/', $picture));
            //Insert Product
            $objProduct = new $this->productModel();
            $objProduct->name = $request->name;
            $objProduct->price = $request->price;
            $objProduct->new = $request->new;
            $objProduct->description = $request->description;
            $objProduct->cat_id = $request->cat_id;
            $objProduct->picture = $picture;
            $objProduct->shop_id = $shopModel->getShopByUserId(Auth::user()->id)[0]->id;

            $objProduct->save();
            $id = $objProduct->id;
            // Insert Tags
            $tagsModel = new Tag();
            $ProductTagsModel = new Product_Tag();

            $dataProductTags = [];
            if ($request->tags != '') {
                $arTags = explode(',', $request->tags);
                foreach ($arTags as $tagItem) {
                    $objTags = $tagsModel->checkTag(trim($tagItem));
                    if (sizeof($objTags) == 0) {
                        $lastId = $tagsModel->insertGetId(trim($tagItem));
                        $tmp = ['product_id' => $id, 'tag_id' => $lastId];
                        array_push($dataProductTags, $tmp);
                    } else {
                        $tmp = ['product_id' => $id, 'tag_id' => $objTags[0]->id];
                        array_push($dataProductTags, $tmp);
                    }
                }
            }
            $ProductTagsModel->insertTags($dataProductTags);
            return redirect()->route('ban.product.index')->with('msg', 'Thêm thành công');
        } catch (\Exception $exception){
            return redirect()->route('ban.ban.product.index')->with('msg', 'Có lỗi xảy ra khi thêm sản phẩm');
        }
    }

    public function edit($id)
    {
        $objProduct = $this->productModel->find($id);
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objProduct->shop_id != $objShop->id)
        {
            Auth::logout();
            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
        }

        $objTags = $this->productModel->getTagsOfProduct($id);
        return view('ban.product.edit', ['objProduct' => $objProduct, 'objTags' => $objTags]);
    }

    public function update(ProductEditRequest $request, $id)
    {
        /*dd($request);*/
        $shopModel = new Shop();

        try {
            //Update Product
            $objProduct = $this->productModel->find($id);
            $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
            if ($objProduct->shop_id != $objShop->id)
            {
                Auth::logout();
                return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
            }
            if ($request->hasFile('picture'))
            {
                Storage::delete('files/'.$objProduct->picture);
                $picture = $request->file('picture')->store('/files');
                $picture = last(explode('/', $picture));
                $objProduct->picture = $picture;
            }

            $objProduct->name = $request->name;
            $objProduct->price = $request->price;
            $objProduct->new = $request->new;
            $objProduct->description = $request->description;
            $objProduct->cat_id = $request->cat_id;
            $objProduct->shop_id = $shopModel->getShopByUserId(Auth::user()->id)[0]->id;
            $objProduct->save();

            $this->productModel->deleteAllTagsOfProduct($id);

            // Insert Tags
            $tagsModel = new Tag();
            $ProductTagsModel = new Product_Tag();

            $dataProductTags = [];
            if ($request->tags != '') {
                $arTags = explode(',', $request->tags);
                foreach ($arTags as $tagItem) {
                    $objTags = $tagsModel->checkTag(trim($tagItem));
                    if (sizeof($objTags) == 0) {
                        $lastId = $tagsModel->insertGetId(trim($tagItem));
                        $tmp = ['Product_id' => $id, 'tag_id' => $lastId];
                        array_push($dataProductTags, $tmp);
                    } else {
                        $tmp = ['Product_id' => $id, 'tag_id' => $objTags[0]->id];
                        array_push($dataProductTags, $tmp);
                    }
                }
            }
            $ProductTagsModel->insertTags($dataProductTags);
            return redirect()->route('ban.product.index')->with('msg', 'Cập nhật thành công');
        } catch (\Exception $exception){
            return redirect()->route('ban.product.index')->with('msg', 'Có lỗi xảy ra khi cập nhật tin tức');
        }
    }

    public function destroy($id)
    {
        $objProduct = $this->productModel->find($id);
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objProduct->shop_id != $objShop->id)
        {
            Auth::logout();
            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
        }
        Storage::delete('files/'.$objProduct->picture);
        if ($objProduct->delete()){
            return redirect()->route('ban.product.index')->with('msg', 'Xóa thành công');
        } else{
            return redirect()->route('ban.product.index')->with('msg', 'Xóa thất bại');
        }
    }

    public function updateStatus($product_id, $status)
    {
        $objProduct = $this->productModel->find($product_id);
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objProduct->shop_id != $objShop->id)
        {
            return false;
        }
        $objProduct->status = $status;
        $objProduct->save();
        return response()->json([
            'message'=>'Update thành công !'
        ]);
    }

    public function updatePromotion($product_id, $promotion)
    {
        $objProduct = $this->productModel->find($product_id);
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objProduct->shop_id != $objShop->id)
        {
            return false;
        }
        $objProduct->promotion_price = $promotion;
        $objProduct->save();
        return response()->json([
            'message'=>'Update thành công !'
        ]);
    }

    public function search(Request $request)
    {
        $objProduct = $this->productModel->getAllProductSearching($request->key);
        return view('ban.product.index', ['objProduct' => $objProduct, 'keySearch' => $request->key]);
    }
}
