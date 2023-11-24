<?php
/*
|--------------------------------------------------------------------------
| Panel Administrativo
|--------------------------------------------------------------------------
 */
use Illuminate\Support\Facades\Route;

Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::match(['get','post'],'/forgot', 'Auth\AdminLoginController@forgot')->name('admin.forgot');
Route::post('/', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/reset-password/{token}', 'Auth\AdminLoginController@reset')->name('forgot.admin.reset');
Route::post('/reset-password', 'Auth\AdminLoginController@reset')->name('forgot.admin.post');

Route::group(['middleware' => ['admin'], 'namespace' => 'Admin'], function () {
    Route::resource('sections', 'SectionController');
    Route::resource('contents', 'ContentController');
    Route::resource('admins', 'AdminController');
    Route::resource('sliders', 'SliderController');
    Route::resource('articles', 'ArticleController');
    Route::resource('faqcategories', 'FaqCategoryController');
    Route::resource('faqs', 'FaqController');
    Route::resource('users', 'UserController');
        
    Route::resource('categories', 'CategoryController');    
    Route::resource('attributes', 'AttributeController');    
    Route::get('attribute-options/{id}', 'AttributeController@options')->name('attributes.options');    
    Route::post('category-manage', 'CategoryController@manage')->name('categories.manage');  
    Route::resource('products', 'ProductController');
    Route::resource('coupons', 'CouponController');
    Route::resource('modules', 'ModuleController');
    Route::resource('status', 'StatusController');
    Route::resource('shippings', 'ShippingController');
    Route::get('orders', 'OrderController@index')->name('order.index');
    Route::get('show/{id}', 'OrderController@show')->name('order.show');
    Route::get('order-sales', 'OrderController@index_sales')->name('order.index_sales');
    Route::get('order-download/{id}', 'OrderController@download')->name('order.download');    
    Route::post('export-orders', 'OrderController@export')->name('order.export');

    Route::get('inicio', 'HomeController@index')->name('home.index');
    Route::resource('customer', 'CustomerController');     
    Route::post('export-customer', 'CustomerController@export')->name('customer.export');
    Route::resource('cart', 'CartController');
    Route::post('export-cart', 'CartController@export')->name('cart.export');

    //rutas para crear los usuarios administrativos de los establecimientos

    Route::resource('formcontacts', 'FormContactController');      
    Route::resource('formnewsletter', 'FormNewsletterController');              

    Route::resource('translation', 'TranslationController');
    Route::resource('translationelement', 'TranslationElementController');

    Route::get('fields/{c}/{s}', 'ContentController@fields')->name('contents.fields');
    Route::put('fields', 'ContentController@save_fields')->name('contents.save.fields');

    Route::resource('admins', 'AdminController');    
    Route::match(['get', 'post'], 'profile/:id', 'AdminController@profile')->name('admins.profile');    
    Route::match(['get', 'post'], 'change-password', 'AdminController@change_password')->name('admins.change_password');    
    /*Route::resource('users', 'UserController');*/

    // Configuraciones
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::get('reset-data', 'SettingsController@reset')->name('reset.data');
    Route::put('settings', 'SettingsController@update')->name('settings_update');

    Route::get('delete-pdf/{id}', 'ContentController@delete_pdf')->name('contents.delete_pdf');
    Route::get('export-contact', 'FormContactController@export')->name('formcontacts.export');
    Route::get('export-newsletter', 'FormNewsletterController@export')->name('formnewsletter.export');

    /*routes_crudy*/

    Route::group(['prefix' => 'ajax'], function () {
        Route::post('/update-category-position', 'CategoryController@update_position');
        //Ordenar registros
        Route::post('/order-sliders', 'SliderController@order')->name('sliders.order');
        Route::post('/order-attributes', 'AttributeController@order')->name('attributes.order');
        Route::post('/order-articles', 'ArticleController@order')->name('articles.order');
        Route::post('/order-articles-gallery', 'ArticleController@order_gallery')->name('articles.order_gallery');
        Route::post('/order-footerlogos', 'FooterLogoController@order')->name('footerlogos.order');
        Route::post('/order-products', 'ProductController@order')->name('products.order');
        Route::post('/order-faqs', 'FaqController@order')->name('faqs.order');

        Route::post('featured-article', 'ArticleController@featured')->name('articles.featured');
        Route::get('gallery-articles/{id}', 'ArticleController@gallery')->name('articles.images');
        Route::get('add-gallery-articles/{id}', 'ArticleController@add_image')->name('articles.add_image');
        Route::delete('delete-gallery-articles/{id}/{id_key}', 'ArticleController@delete_image')->name('articles.delete_image'); 

        Route::post('featured-product', 'ProductController@featured')->name('products.featured');
        Route::post('featured-faqcategory', 'FaqCategoryController@featured')->name('faqcategories.featured');

        Route::post('published-article', 'ArticleController@published')->name('articles.published');
        Route::post('published-useradmin', 'AdminController@published')->name('admins.published');
        Route::post('published-products', 'ProductController@published')->name('products.published');
        
        Route::get('/get-relateds/{id}', 'ProductController@get_relateds');          
        Route::post('/search-product', 'ProductController@search_product');
        Route::post('/copy-product', 'ProductController@copy_product')->name('product.copy_product');
        Route::post('add-related', 'ProductController@add_related');
        Route::delete('delete-related/{id}', 'ProductController@delete_related');        
        Route::post('order-products-relateds', 'ProductController@order_products_relateds');
        Route::post('add-gallery-to-product', 'ProductController@addGallleryToProduct');
        Route::post('order-products-gallery', 'ProductController@order_products_gallery');
        
        Route::post('shippings-status', 'ShippingController@isActiveShippingFee')->name('shippings.active');

        Route::post('show-section', 'SectionController@show')->name('section.show');

        Route::post('delete-file', 'AjaxController@delete_file')->name('ajax.delete_file');
        Route::post('settings-update', 'SettingsController@switch')->name('settings.switch');
        Route::post('/settings-mode-maintenance', 'SettingsController@mode_maintenance')->name('settings.mode_maintenance');
        Route::post('/settings-debug', 'SettingsController@debug')->name('settings.debug');
        Route::post('status-coupon', 'CouponController@status')->name('coupons.status');        
        Route::post('status-module', 'ModuleController@status')->name('modules.status');
        Route::get('search-customer', 'CouponController@search_customer');
        Route::post('change-status', 'OrderController@change_status')->name('order.change_status');
        Route::post('update-guide', 'OrderController@update_guide')->name('order.update_guide');
        Route::post('update-url-guide', 'OrderController@update_url_guide')->name('order.update_url_guide');

        

        // vuejs
        Route::post('master-option', 'AttributeController@master_option');
        Route::delete('delete-option/{id}', 'AttributeController@delete_option');
        Route::post('order-options', 'AttributeController@order_options');        
        
        Route::post('get-settings-variations', 'VariationController@get_settings_variations');
        Route::post('update-variation', 'VariationController@update_variation');
        Route::post('delete-create-variations', 'VariationController@delete_create_variation');
        Route::post('save-product-simple', 'VariationController@save_product_simple');

        // galleria de artículos
        Route::post('/images-ourcompany', 'OurCompanyController@images')->name('ourcompanies.images');
        Route::post('update-gallery-ourcompany-position', 'OurCompanyController@images_sort');
        Route::delete('delete-image-ourcompany/{id}', 'OurCompanyController@delete_image');
        Route::post('update-gallery-ourcompany', 'OurCompanyController@update_image');

        //La carga de imágenes webp
        Route::post('/uploads-images', 'UploadsImageController@uploads');
        Route::post('/delete-image', 'UploadsImageController@delete_image');

    });

    Route::group(['prefix' => 'lfmanager', 'middleware' => ['admin']], function () {
      \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

Route::group(['middleware' => ['admin'], 'prefix' => 'ajax', 'namespace' => 'Api'], function () {
  Route::post('create-product-in-siigo', 'SiigoController@createProductoInSiigo');
  Route::put('update-product-in-siigo', 'SiigoController@updateProductoInSiigo');
  Route::delete('delete-product-in-siigo/{id}', 'SiigoController@deleteProductoInSiigo');
  Route::post('update-quantity-in-siigo', 'SiigoController@updateStockProductInSiigo');
});