<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\ContactRequest;
use App\Model\Cat;
use App\Model\Comment;
use App\Model\Contact;
use App\Model\Product;
use App\Model\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InfoShopController extends Controller
{
    private $objSubCatOfShop;
    private $objSuperCatOfShop;
    private $objShop;

    public function __construct(Request $request)
    {
        $objShop = Shop::find($request->id);    
        $catModel = new Cat();
        $modelPro = new  Product();

        $objCatOfShop = $modelPro->getCatOfShop($request->id);
        $objSubCatOfShop = [];
        $objSuperCatOfShop = [];
        $i = 0;
        $j = 0;
        foreach ($objCatOfShop as $objCat) {
            if ($objCat->parrent_cat == null) {
                $objSuperCatOfShop[$i++] = $objCat;
            } else {
                $objSuperCatOfShop[$i++] = $catModel->find($objCat->parrent_cat);
                $objSubCatOfShop['' . $objCat->parrent_cat][$j++] = $objCat;
            }
        }


        $this->objSubCatOfShop = $objSubCatOfShop;
        $this->objSuperCatOfShop = $objSuperCatOfShop;
        $this->objShop = $objShop;

    }


    public function index($slug, $id)
    {
        if (sizeof($this->objShop) == 0) {
            return redirect()->route('shop.error');
        }
        if (str_slug($this->objShop->name) != $slug) {
            return redirect()->route('subshop.index', ['slug' => str_slug($this->objShop->name), 'id' => $this->objShop->id]);
        }
        $modelPro = new  Product();

        $objHotProductOfShop = $modelPro->getHotProductOfShop($id);
        $objNewProductOfShop = $modelPro->getNewProductOfShop($id);

        return view('shop.info_shop.index', [
            'objHotProductOfShop' => $objHotProductOfShop,
            'objNewProductOfShop' => $objNewProductOfShop,
            'objSuperCatOfShop' => $this->objSuperCatOfShop,
            'objSubCatOfShop' => $this->objSubCatOfShop,
            'objShop' => $this->objShop
        ]);
    }

    public function cat($slug, $id, $cat_name, $cat_id)
    {
        //Check đường dẫn
        if (sizeof($this->objShop) == 0) {
            return redirect()->route('shop.error');
        }
        if (str_slug($this->objShop->name) != $slug) {
            return redirect()->route('subshop.cat', ['slug' => str_slug($this->objShop->name), 'id' => $this->objShop->id, 'cat_name' => $cat_name, 'cat_id' => $cat_id]);
        }
        $objCurrentCat = Cat::find($cat_id);
        if (sizeof($objCurrentCat) == 0)
        {
            return redirect()->route('shop.error');
        }
        if (str_slug($objCurrentCat->name) != $cat_name) {
            return redirect()->route('subshop.cat', ['slug' => str_slug($this->objShop->name), 'id' => $this->objShop->id, 'cat_name' => str_slug($objCurrentCat->name), 'cat_id' => $objCurrentCat->id]);
        }

        $modelProduct = new Product();

        $objProductOfCat = $modelProduct->getProductOfCatOfShop($cat_id, $id);

        return view('shop.info_shop.cat', [
            'objProduct' => $objProductOfCat,
            'objCurrentCat' => $objCurrentCat,
            'objSuperCatOfShop' => $this->objSuperCatOfShop,
            'objSubCatOfShop' => $this->objSubCatOfShop,
            'objShop' => $this->objShop
        ]);
    }

    public function feedback($slug, $id)
    {
        if (sizeof($this->objShop) == 0) {
            return redirect()->route('shop.error');
        }
        if (str_slug($this->objShop->name) != $slug) {
            return redirect()->route('subshop.index', ['slug' => str_slug($this->objShop->name), 'id' => $this->objShop->id]);
        }
        $cmtModel = new Comment();

        $objCmt = $cmtModel->getCommentAboutShop($id);

        return view('shop.info_shop.feedback', [
            'objSuperCatOfShop' => $this->objSuperCatOfShop,
            'objSubCatOfShop' => $this->objSubCatOfShop,
            'objShop' => $this->objShop,
            'objCmt' => $objCmt,
        ]);

    }

    public function comment($slug, $id, Request $request)
    {
        if (sizeof($this->objShop) == 0) {
            return redirect()->route('shop.error');
        }
        if (str_slug($this->objShop->name) != $slug) {
            return redirect()->route('subshop.index', ['slug' => str_slug($this->objShop->name), 'id' => $this->objShop->id]);
        }
        $cmtModel = new Comment();
        if($cmtModel->create($request->toArray())){
            $objCmt = $cmtModel->getCommentAboutShop($id);
            return view('shop.info_shop.comment', ['objCmt' => $objCmt]);
        }
    }

    public function getContact($slug, $id)
    {
        if (sizeof($this->objShop) == 0) {
            return redirect()->route('shop.error');
        }
        if (str_slug($this->objShop->name) != $slug) {
            return redirect()->route('subshop.index', ['slug' => str_slug($this->objShop->name), 'id' => $this->objShop->id]);
        }
        return view('shop.info_shop.contact', [
            'objSuperCatOfShop' => $this->objSuperCatOfShop,
            'objSubCatOfShop' => $this->objSubCatOfShop,
            'objShop' => $this->objShop,
        ]);
    }

    public function postContact(ContactRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'detail' => $request->detail,
            'shop_id' => $request->shop_id,
        ];

        $objContact = new Contact();
        $objContact->create($data);

        Mail::to(''.$this->objShop->email, ''.$this->objShop->name)->send(new \App\Mail\Contact($data));
        return redirect()->route('subshop.contact', ['slug' => str_slug($this->objShop->name), 'id' => $this->objShop->id])->with('msg', 'Gửi thành công');
    }
}
