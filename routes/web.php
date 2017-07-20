<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::pattern('id', '[0-9]*');
Route::pattern('shop_id', '[0-9]*');
Route::pattern('slug', '(.)*');

Route::pattern('cat_id', '[0-9]*');
Route::pattern('cat_name', '(.)*');

Route::group(['namespace' => 'Shop', 'middleware' => 'shop.share'], function(){

    Route::get('/home', 'IndexController@index')->name('shop.index.index');
    Route::get('/', 'IndexController@index')->name('shop.index.index');

    Route::get('/danh-muc/{slug}-{id}', 'ProductController@cat')->name('shop.product.cat');
    Route::get('/the-san-pham/{slug}-{id}', 'ProductController@tag')->name('shop.product.tag');

    Route::get('san-pham/{slug}-{id}.html', 'ProductController@detail')->name('shop.product.detail');
    Route::get('filter', 'ProductController@filter')->name('shop.product.filter');

    Route::get('/mua-hang/gio-hang', 'BillController@cart')->name('shop.bill.cart');
    Route::get('/mua-hang/xac-nhan-thong-tin', 'BillController@info')->name('shop.bill.confirm_info');
    Route::get('/mua-hang/hinh-thuc-thanh-toan', 'BillController@getPayment')->name('shop.bill.get_payment');
    Route::post('/mua-hang/hinh-thuc-thanh-toan', 'BillController@payment')->name('shop.bill.payment');
    Route::post('/mua-hang/checkout', 'BillController@checkout')->name('shop.bill.post_checkout');
    Route::get('/mua-hang/checkout', 'BillController@getCheckout')->name('shop.bill.checkout');
    Route::get('/mua-hang/order/{shop_id}', 'BillController@order');

    Route::group(['prefix' => 'cua-hang/{slug}-{id}'], function (){
        Route::get('/danh-muc/{cat_name}-{cat_id}','InfoShopController@cat')->name('subshop.cat');
        Route::get('/','InfoShopController@index')->name('subshop.index');
        Route::get('/danh-gia-phan-hoi','InfoShopController@feedback')->name('subshop.feedback');
        Route::get('/lien-he','InfoShopController@getContact')->name('subshop.contact');
        Route::post('/lien-he','InfoShopController@postContact')->name('subshop.contact');
        Route::get('/comment','InfoShopController@comment')->name('subshop.comment');
    });


    Route::get('chi-tiet-hoa-don-{id}', 'BillController@detailToShow')->name('blank.page.bill.detail');

    Route::get('/binh-luan-bai-viet', 'ProductController@comment');

    Route::get('favorite/{id}', 'BillController@addToFavorite');
    Route::get('add_cart/{id}', 'BillController@addToCart');

    Route::get('add_cart_qty/{id}', 'BillController@addToCartWithQty');
    Route::get('remove_cart/{id}', 'BillController@removeCart');

    Route::group(['prefix' => 'lien-he'], function (){
        Route::get('/', 'ContactController@getContact')->name('shop.page.contact');
        Route::post('/', 'ContactController@postContact')->name('shop.page.contact');
    });

    Route::group(['prefix' => '{slug}'], function (){
        Route::get('thong-tin-ca-nhan', 'UserProfileController@index')->name('shop.profile.index');
        Route::post('thong-tin-ca-nhan', 'UserProfileController@update')->name('shop.profile.update');
        Route::get('san-pham-yeu-thich', 'UserProfileController@favorite')->name('shop.profile.favorite');
        Route::get('lich-su-mua-hang', 'UserProfileController@history')->name('shop.profile.history');
    });
    Route::get('/chi-tiet-hoa-don-user/{id}', 'UserProfileController@detail');

    Route::get('/tim-kiem/', 'SearchController@search')->name('shop.search');
    Route::get('/tim-kiem-ajax/', 'SearchController@searchAjax');
    Route::get('search_filter', 'SearchController@filterSearch');

    Route::get('loi-bat-ngo', function(){
        return view('shop.error.error');
    })->name('shop.error');


});

/*** Route Register ***/
Route::group(['middleware' => 'web'], function () {
    Route::get('dang-ky', 'Admin\GuestController@create')->name('register');
    Route::post('dang-ky', 'Auth\RegisterController@getSendCode')->name('register');

    Route::get('xac-nhan', 'Auth\RegisterController@getSendCode')->name('register.confirm');
    Route::post('xac-nhan', 'Auth\RegisterController@storeUser')->name('register.store');
});
/*** End Route Register ***/

Route::group(['namespace' => 'Auth'], function (){
    Route::get('dang-nhap', 'LoginController@getLogin')->name('login');
    Route::post('dang-nhap', 'LoginController@postLogin')->name('login');
    Route::get('dang-xuat', 'LoginController@logout')->name('logout');
});

/*** START route group ADMIN ***/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin.role'], function (){

    Route::group(['prefix' => 'user'], function (){
        Route::get('active_user/{id}', 'UserController@updateActive');
        Route::get('/', 'UserController@index')->name('admin.user.index');
        Route::get('create', 'UserController@create')->name('admin.user.create');
        Route::post('store', 'UserController@store')->name('admin.user.store');
        Route::get('{id}/edit', 'UserController@edit')->name('admin.user.edit');
        Route::post('{id}/update', 'UserController@update')->name('admin.user.update');
        Route::get('{id}', 'UserController@destroy')->name('admin.user.destroy');
    });

    Route::group(['prefix' => 'cat'], function (){
        Route::get('/', 'CatController@index')->name('admin.cat.index');
        Route::get('create', 'CatController@create')->name('admin.cat.create');
        Route::post('store', 'CatController@store')->name('admin.cat.store');
        Route::get('{id}/edit', 'CatController@edit')->name('admin.cat.edit');
        Route::post('{id}/update', 'CatController@update')->name('admin.cat.update');
        Route::get('{id}', 'CatController@destroy')->name('admin.cat.delete');
    });

    Route::group(['prefix' => 'adv'], function (){
        Route::get('active_adv/{id}', 'AdvController@updateActive');
        Route::get('/', 'AdvController@index')->name('admin.adv.index');
        Route::get('create', 'AdvController@create')->name('admin.adv.create');
        Route::post('store', 'AdvController@store')->name('admin.adv.store');
        Route::get('{id}/edit', 'AdvController@edit')->name('admin.adv.edit');
        Route::post('{id}/update', 'AdvController@update')->name('admin.adv.update');
        Route::get('{id}', 'AdvController@destroy')->name('admin.adv.delete');
    });

    Route::group(['prefix' => 'bill'], function (){
        Route::get('status_bill/{bill_id}/{status_id}', 'BillController@updateStatus');

        Route::get('/', 'BillController@index')->name('admin.bill.index');
        Route::get('{shop_id}/detail-{id}', 'BillController@detail')->name('admin.bill.detail');
        Route::get('{id}', 'BillController@destroy')->name('admin.bill.delete');

        Route::get('filter', 'BillController@filter')->name('admin.bill.filter');
    });

    Route::group(['prefix' => 'product'], function (){
        Route::get('active_product/{id}', 'ProductController@updateActive');
        Route::get('cancel_product/{id}', 'ProductController@cancelProduct');
        Route::get('pin_product/{id}', 'ProductController@updatePin');
        Route::get('filter', 'ProductController@filter')->name('admin.product.filter');

        Route::get('/', 'ProductController@index')->name('admin.product.index');
        Route::get('{id}', 'ProductController@destroy')->name('admin.product.delete');
    });

    Route::group(['prefix' => 'shop'], function (){
        Route::get('active_shop/{id}', 'ShopController@updateActive');

        Route::get('/', 'ShopController@index')->name('admin.shop.index');
        Route::get('{id}', 'ShopController@destroy')->name('admin.shop.delete');
    });

    Route::post('search', 'SearchController@search')->name('admin.search.search');

    Route::group(['prefix' => 'guest'], function (){
        Route::get('active_user/{id}', 'GuestController@updateActive');
        Route::get('/', 'GuestController@index')->name('admin.guest.index');
        Route::get('{id}', 'GuestController@destroy')->name('admin.guest.destroy');
    });

    Route::group(['prefix' => 'contact'], function (){
        Route::get('/', 'ContactController@index')->name('admin.contact.index');
        Route::get('{id}/edit', 'ContactController@show')->name('admin.contact.show');
        Route::post('reply', 'ContactController@postContact')->name('admin.contact.reply');
        Route::get('{id}', 'ContactController@delete')->name('admin.contact.delete');
    });

    Route::get('/', 'IndexController@index')->name('admin.index.index');
    Route::get('/no-roles', 'IndexController@returnError')->name('admin.index.error');

});
/*** END ROUTE GROUP ADMIN ***/

/*** START route group ban ***/
Route::group(['namespace' => 'Ban', 'prefix' => 'ban', 'middleware' => 'ban.role'], function (){

    Route::group(['prefix' => 'customer'], function (){
        Route::get('/', 'CustomerController@index')->name('ban.customer.index');
        Route::get('{id}/edit', 'CustomerController@edit')->name('ban.customer.edit');
        Route::post('{id}/update', 'CustomerController@update')->name('ban.customer.update');
        Route::get('{id}', 'CustomerController@destroy')->name('ban.customer.destroy');
    });

    Route::group(['prefix' => 'product'], function (){
        Route::get('status_product/{product_id}/{status_id}', 'ProductController@updateStatus');
        Route::get('promotion_product/{product_id}/{promotion}', 'ProductController@updatePromotion');
        Route::get('get_sub_cat/{id}', 'NewsController@getSubCat');

        Route::get('/', 'ProductController@index')->name('ban.product.index');
        Route::get('create', 'ProductController@create')->name('ban.product.create');
        Route::post('store', 'ProductController@store')->name('ban.product.store');
        Route::get('{id}/edit', 'ProductController@edit')->name('ban.product.edit');
        Route::post('{id}/update', 'ProductController@update')->name('ban.product.update');
        Route::get('{id}', 'ProductController@destroy')->name('ban.product.delete');

        Route::get('filter', 'ProductController@filter')->name('ban.product.filter');
    });


    Route::group(['prefix' => 'bill'], function (){
        Route::get('status_bill/{bill_id}/{status_id}', 'BillController@updateStatus');

        Route::get('/', 'BillController@index')->name('ban.bill.index');
        Route::get('create', 'BillController@create')->name('ban.bill.create');
        Route::get('{id}/detail', 'BillController@detail')->name('ban.bill.detail');
        Route::post('{id}/update', 'BillController@update')->name('ban.bill.update');
        Route::get('{id}', 'BillController@destroy')->name('ban.bill.delete');

        Route::get('filter', 'BillController@filter')->name('ban.bill.filter');
    });

    Route::post('search', 'NewsController@search')->name('ban.news.search');


    Route::group(['prefix' => 'comment'], function (){
        Route::get('active_cmt/{id}', 'CommentController@updateActive');
        Route::get('/about_product', 'CommentController@getCmtProduct')->name('ban.comment.product');
        Route::get('/about_shop', 'CommentController@getCmtShop')->name('ban.comment.shop');
        Route::get('{id}', 'CommentController@destroy')->name('ban.comment.destroy');
    });

    Route::group(['prefix' => 'contact'], function (){
        Route::get('/', 'ContactController@index')->name('ban.contact.index');
        Route::get('{id}/edit', 'ContactController@show')->name('ban.contact.show');
        Route::post('reply', 'ContactController@postContact')->name('ban.contact.reply');
        Route::get('{id}', 'ContactController@delete')->name('ban.contact.delete');
    });

    Route::group(['prefix' => 'infomation'], function (){
        Route::get('/', 'InfoController@getInfo')->name('ban.info.edit');
        Route::post('/', 'InfoController@postInfo')->name('ban.info.update');
    });

    Route::get('/', 'IndexController@index')->name('ban.index.index');
    Route::get('/no-roles', 'IndexController@returnError')->name('ban.index.error');

});
/*** Route Register Shop ***/
Route::group(['middleware' => 'web'], function () {
    Route::get('ban/dang-ky', 'Ban\RegisterBanController@create')->name('ban.register.create');
    Route::post('ban/dang-ky', 'Ban\RegisterBanController@store')->name('ban.register.store');
});
/*** End Route Register ***/
/*** END ROUTE GROUP ban ***/