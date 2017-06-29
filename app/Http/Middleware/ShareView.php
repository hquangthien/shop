<?php

namespace App\Http\Middleware;

use App\Model\Product_User;
use Closure;
use Illuminate\Support\Facades\Auth;

class ShareView
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
        $arFavorite = [];
        if (Auth::check())
        {
            $proUser  = new Product_User();
            $objFavorite = $proUser->getProIdByUserId(Auth::id());
            foreach ($objFavorite as $item){
                array_push($arFavorite, $item->product_id);
            }
        }

        view()->share('arFavorite', $arFavorite);
        return $next($request);
    }
}
