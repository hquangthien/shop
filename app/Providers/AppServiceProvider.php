<?php

namespace App\Providers;

use App\Model\Adv;
use App\Model\Cat;
use App\Model\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $cat = new Cat();
        $modelProduct = new Product();
        $advModel = new Adv();
        /*** nav-bar ***/
        $objSuperCat = $cat->getSuperCat();
        $objSubCat1 = [];
        $objSubCat2 = [];
        foreach ($objSuperCat as $superCat)
        {
            $tmp1 = $cat->getSubCat($superCat->id);
            if (sizeof($tmp1) > 0){
                $objSubCat1[$superCat->id] = $tmp1;
                foreach ($tmp1 as $item){
                    $tmp2 = $cat->getSubCat($item->id);
                    if (sizeof($tmp2) > 0){
                        $objSubCat2[$item->id] = $tmp2;
                    }
                }
            }
        }

        $objRightAdv = $advModel->getRightBarAdv();
        $objAdv = $advModel->getAllActiveAdv();

        $objNewProduct = $modelProduct->getRecentProduct();
        /*** end nav-bar ***/

        View::share('objSuperCat', $objSuperCat);
        View::share('objSubCat1', $objSubCat1);
        View::share('objSubCat2', $objSubCat2);
        View::share('objNewProduct', $objNewProduct);
        View::share('objRightAdv', $objRightAdv);
        View::share('objAdv', $objAdv);
        View::share('publicUrl', getenv('PUBLIC_URL'));
        View::share('adminUrl', getenv('ADMIN_URL'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
