<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function getSendCode(GuestRequest $request)
    {
        $codeRand = rand(100000, 999999);
        //create session
        $tmp = [];
        $tmp['content']['username'] = $request->username;
        $tmp['content']['email'] = $request->email;
        $tmp['content']['password'] = bcrypt(trim($request->password));
        $tmp['content']['fullname'] = $request->fullname;
        $tmp['content']['phone'] = $request->phone;
        $tmp['content']['address'] = $request->address;
        $tmp['code'] = $codeRand;
        $tmp['ip'] = $request->ip();
        $request->session()->flash('register_'.$request->username, $tmp);



        Mail::send('admin.auth.blank', ['code' => $codeRand], function ($msg) use ($request){
            $msg->from('hquangthien1@gmail.com', 'Admin VN Express');
            $msg->to($request->email, 'Admin VN Express')->subject('Xác nhận email');
        });

        return view('admin.auth.confirm_email', ['username' => $request->username, 'email' => $request->email]);
    }

    public function storeUser(Request $request)
    {
        if(Session::has('register_'.$request->username)){
            $arRegisterInfo =  Session::get('register_'.$request->username);
            if ($request->ip() == $arRegisterInfo['ip'] && $request->confirm == $arRegisterInfo['code']){
                if (User::create($arRegisterInfo['content']))
                {
                    return redirect()->route('login')->with('msg', 'Đăng ký thành công');
                }
            } else{
                $request->session()->flash('register_'.$arRegisterInfo['content']['username'], $arRegisterInfo);
                $request->session()->flash('msg', 'Mã xác nhận không hợp lệ');
                return view('admin.auth.confirm_email', ['username' => $arRegisterInfo['content']['username'], 'email' => $arRegisterInfo['content']['email']]);

            }
        }
    }


}
