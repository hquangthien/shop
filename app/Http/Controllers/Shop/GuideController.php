<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideController extends Controller
{
    public function registerShop()
    {
        return view('shop.guide.shop_register');
    }
}
