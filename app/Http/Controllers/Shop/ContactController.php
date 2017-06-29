<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\ContactRequest;
use App\Mail\OrderShipped;
use App\Model\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function getContact()
    {
        return view('shop.contact.contact');
    }

    public function postContact(ContactRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'detail' => $request->detail,
        ];

        $objContact = new Contact();
        $objContact->create($data);

        Mail::to('hquangthien1@gmail.com', 'Hoàng Quang Thiên')->send(new \App\Mail\Contact($data));
        return redirect()->route('shop.page.contact')->with('msg', 'Gửi thành công');

    }
}
