<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            if (Auth::user()->active_user == 0)
            {
                $request->session()->put('block_user', 'Tài khoản này đã bị vô hiệu hóa, vui lòng liên hệ với admin để khôi phục tài khoản');
                return redirect()->route('logout');
            }
            return redirect()->route('shop.index.index');
        } else{
            return redirect()->route('login')->with('msg', 'Tên tài khoản hoặc mật khẩu không chính xác');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
