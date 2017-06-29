<?php

namespace App\Http\Middleware;

use App\Model\Shop;
use Closure;
use Illuminate\Support\Facades\Auth;

class RoleBan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check())
        {
            return redirect()->route('login')->with('msg', 'Bạn cần đăng nhập trước');
        }
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id);

        if (sizeof($objShop) == 0)
        {
            return redirect()->route('ban.register.create');
        }

        if ($objShop[0]->active_shop == 0)
        {
            Auth::logout();
            return redirect()->route('login')->with('msg', 'Shop của bạn đã bị khóa, liện hệ với admin để kích hoạt lại');
        }

        return $next($request);
    }
}
