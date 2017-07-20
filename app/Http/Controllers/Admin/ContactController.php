<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;
use App\Model\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    private $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function index(){
        $objContact = $this->contact->getAllContact();
        return view('admin.contact.index', ['objContact' => $objContact]);
    }

    public function show($id)
    {
        $objContact = $this->contact->find($id);
        $objContact->readed = 1;
        $objContact->save();
        return view('admin.contact.edit', ['objContact' => $objContact]);
    }

    public function delete($id)
    {
        if ($this->contact->destroy($id)){
            return redirect()->route('admin.contact.index')->with('msg_dlt', 'Xóa thành công');
        } else{
            return redirect()->route('admin.contact.index')->with('msg_dlt', 'Xóa thất bại');
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

        Mail::to(''.$data['email'], ''.$data['name'])->send(new \App\Mail\Contact($data));
        return redirect()->route('admin.contact.index')->with('msg', 'Gửi thành công');
    }
}
