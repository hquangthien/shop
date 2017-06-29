<?php

namespace App\Http\Controllers\Ban;

use App\Http\Requests\ContactRequest;
use App\Model\Contact;
use App\Http\Controllers\Controller;
use App\Model\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    private $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function index(){
        $shopModel = new Shop();
        $shop_id = $shopModel->getShopByUserId(Auth::user()->id)[0]->id;
        $objContact = $this->contact->getContactOfShop($shop_id);
        return view('ban.contact.index', ['objContact' => $objContact]);
    }

    public function show($id)
    {
        $objContact = $this->contact->find($id);

        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objContact->shop_id != $objShop->id)
        {
            Auth::logout();
            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
        }

        $objContact->readed = 1;
        $objContact->save();
        return view('ban.contact.edit', ['objContact' => $objContact, 'shopName' => $objShop->name]);
    }

    public function delete($id)
    {
        $objContact = $this->contact->find($id);

        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objContact->shop_id != $objShop->id)
        {
            Auth::logout();
            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục không được phép');
        }

        if ($objContact->delete()){
            return redirect()->route('ban.contact.index')->with('msg', 'Xóa thành công');
        } else{
            return redirect()->route('ban.contact.index')->with('msg', 'Xóa thất bại');
        }
    }

    public function postContact(ContactRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'detail' => $request->detail,
        ];

        Mail::to($data['email'], $data['name'])->send(new \App\Mail\Contact($data));
        return redirect()->route('ban.contact.index')->with('msg', 'Gửi thành công');
    }
}
