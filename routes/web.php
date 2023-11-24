<?php

//Rutas autenticación usuario

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

/*
|--------------------------------------------------------------------------
| Rutas traducidas
|--------------------------------------------------------------------------
 */
Route::group(['prefix' => LL::setLocale(), 'middleware' => ['localizationRedirect', 'web' , 'xss']], function () {
    Route::get('/','FrontController@intro')->name('intro');
    Route::get('/home', 'FrontController@home')->name('home');
    Route::get(LL::transRoute('routes.about_us'), 'FrontController@about_us')->name('about_us');
    Route::get(LL::transRoute('routes.faqs'), 'FrontController@faqs')->name('faqs');
    Route::get(LL::transRoute('routes.link'), 'FrontController@link')->name('link');
    Route::get(LL::transRoute('routes.articles'), 'FrontController@articles')->name('articles');
    Route::get(LL::transRoute('routes.article'), 'FrontController@article')->name('article');
    Route::get(LL::transRoute('routes.work_us'), 'FrontController@work_us')->name('work_us');
    Route::get(LL::transRoute('routes.link'), 'FrontController@customer_service')->name('link');
    Route::match(['get', 'post'], LL::transRoute('routes.service'), 'FrontController@service')->name('service');
    Route::get(LL::transRoute('routes.business_line'), 'FrontController@business_line')->name('business_line');
    Route::match(['get', 'post'], LL::transRoute('routes.contact'), 'FrontController@contact')->name('contact');  
    Route::match(['get', 'post'], LL::transRoute('routes.schneider'), 'LandingController@schneider')->name('schneider');  
    Route::match(['get', 'post'], LL::transRoute('routes.selector_schneider'), 'LandingController@selector_schneider')->name('selector_schneider');  
    
    Route::post('ax-load-articles', 'FrontController@ax_load_articles');
    Route::get('logout' , 'Auth\CustomerLoginController@logout')->name('logout');
});

// Rutas de la tienda
Route::group(['namespace' => 'Shop'], function (){
    Route::group(['prefix' => LL::setLocale(), 'middleware' => ['localizationRedirect', 'web' , 'xss']], function () {
        Route::get(LL::transRoute('routes.products'), 'ProductController@list')->name('products');
        Route::get(LL::transRoute('routes.products_cat'), 'ProductController@list')->name('products.cat');
        Route::get(LL::transRoute('routes.products_subcat'), 'ProductController@list')->name('products.subcat');
        Route::get(LL::transRoute('routes.product'), 'ProductController@view')->name('product');
        Route::get(LL::transRoute('routes.product_cat'), 'ProductController@view')->name('product.cat');
        Route::get(LL::transRoute('routes.product_subcat'), 'ProductController@view')->name('product.subcat');
        Route::get(LL::transRoute('routes.favorites'), 'ProductController@favorites')->name('products.favorites');
        Route::get('carrito-de-compras', 'CheckoutController@cart')->name('shop.cart');
        Route::get('checkout', 'CheckoutController@checkout')->name('shop.checkout');
        Route::get('gracias-por-su-compra', 'CheckoutController@return')->name('shop.return');       
        Route::get('pago', 'CheckoutController@payment')->name('shop.payment');       
        Route::match(['get', 'post'],'/confirm-payment', 'ConfirmController@confirm')->name('confirm_pay');
        Route::get('search-general', 'ProductController@search')->name('search.general');
    });
});

//AJAX en API
    Route::group(['prefix' => 'ajax', 'namespace' => 'Api'], function () {
    Route::post('select-city', 'AjaxController@select_city');    
    Route::get('search-products/{term}', 'AjaxController@search_products');
    Route::get('cities/{dep}', 'AjaxController@cities');
    Route::post('validate-variation', 'CartController@validate_variation');
    Route::post('add-to-cart', 'CartController@add_cart');
    Route::delete('remove-item/{id}', 'CartController@remove_item');
    Route::post('get-cart', 'CartController@get_cart');
    Route::post('update-item-cart', 'CartController@update_item');    
    
    Route::post('user-to-cart', 'CheckoutController@user_cart');
    Route::post('apply-coupon', 'CheckoutController@apply_coupon');
    Route::post('remove-coupon', 'CheckoutController@remove_coupon');    
    Route::post('validate-email', 'CheckoutController@validate_email');
    Route::post('calculate-shipping', 'CheckoutController@calculate_shipping');
    Route::post('finalize-purchase', 'CheckoutController@finalize_purchase');
    Route::post('buy-customer-guest', 'CheckoutController@buy_customer_guest');    
    Route::get('update-info-shipping', 'CheckoutController@update_info_shipping');

    //AccountController
    Route::post('create-account', 'AccountController@create_account');
    Route::delete('delete-address/{id}', 'AccountController@delete_address');
    Route::post('update-account', 'AccountController@update_account');
    Route::post('update-address', 'AccountController@update_address');
    Route::post('create-address', 'AccountController@create_address');
    Route::post('change-password', 'AccountController@change_password');
    Route::post('forgot-password', 'AccountController@forgot_password');
    Route::get('get-addresses-by-user', 'AccountController@getAddressesByUser');

    Route::post('add-product-to-favorite', 'FavoriteController@addProductToFavorite');
    Route::post('remove-product-of-favorite', 'FavoriteController@removeProductOfFavorite');

});

// Peticiones AJAX diferentes a la Carpeta Controllers/Api
Route::group(['prefix' => 'ajax'], function () {
    
    Route::post('login', 'Auth\CustomerLoginController@login');
    Route::get('/send-newsletter', 'FrontController@send_newsletter')->name('sendnewsletter');
    Route::post('update-products-categories', 'FrontController@ax_update_products_category');Route::post('/send-offer-job', 'FrontController@send_offer_job');
    Route::post('validacion','FrontController@validation')->name('validation');
    
});

/*
|--------------------------------------------------------------------------
| Rutas Cuenta de usuario
|--------------------------------------------------------------------------
*/
 Route::group(['prefix' => LL::setLocale(), 'middleware' => ['localizationRedirect', 'web' , 'xss']], function () {
    Route::group(['middleware' => 'not_auth'], function () {
        Route::get('/login', 'AccountController@login')->name('login');
        Route::get('/registro', 'AccountController@register')->name('account.register');    
        Route::get('recuperar-contrasena', 'AccountController@forgot_password')->name('account.forgot');
    });
        
    Route::get('cambiar-contrasena', 'AccountController@change_password')->name('account.change_password');
    Route::group(['prefix' => 'mi-cuenta', 'middleware' => 'auth'], function () {
        Route::get('/', 'AccountController@home')->name('account.home');
        Route::get('/direcciones', 'AccountController@address')->name('account.address');
    });
});

//Login redes sociales
Route::get('login/{socialNetwork}', 'SocialLoginController@socialNetwork')->name('login.social')->middleware('guest');
Route::get('login/{socialNetwork}/callback', 'SocialLoginController@handleCallback')->middleware('guest');