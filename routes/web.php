<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin', 'Admin\LoginController@login')->name('login');
Route::post('/login', 'Admin\LoginController@processlogin')->name('processlogin'); 
Route::get('/logout', 'Admin\LoginController@logout')->name('logout');
Route::middleware('authloginadmin')->group(function(){
    Route::group(['prefix' => 'Admin'], function() {
        
        Route::group(['prefix' => 'Dashboard'], function() {
            Route::group(['middleware' => ['pagedenied:1']], function () {
                Route::get('/dashboard-view', 'Admin\DashboardController@index')->name('dashboard');
            });
        });

        Route::group(['prefix' => 'Product'], function() {
            Route::group(['middleware' => ['pagedenied:2']], function () {
                Route::get('/product-view', 'Admin\ProductController@index')->name('product');
                Route::post('/product-create', 'Admin\ProductController@store')->name('productcreate');
                Route::post('/imageproduct-edit', 'Admin\ProductController@updateimage')->name('productimage-update');
                Route::post('/product-update', 'Admin\ProductController@update')->name('product_update'); 
                Route::post('/product-variationdetdel', 'Admin\ProductController@deletevariationdetail')->name('prodectvariationdet-delete');
                Route::post('/product-variationedit', 'Admin\ProductController@updatevariation')->name('product-variation-edit');
            });
        });

        Route::group(['prefix' => 'Orders'], function(){
            Route::group(['prefix' => 'Customer-Orders'], function() {
                Route::group(['middleware' => ['pagedenied:5']], function () {
                    Route::get('/order-view', 'Admin\OrderController@index')->name('Customer-Orders');
                    Route::get('/order-serach', 'Admin\OrderController@search')->name('order-search');
                });
            });

            Route::group(['prefix' => 'Approvement-Payment'], function() {
                Route::group(['middleware' => ['pagedenied:4']], function () {
                    Route::get('/approvement-view', 'Admin\ApprovementpaymentController@index')->name('Approvement-Payment');
                    Route::post('/approvement-accept', 'Admin\ApprovementpaymentController@acceptprovement')->name('approvement-accept');
                    Route::post('approvement-decline', 'Admin\ApprovementpaymentController@declineapprovement')->name('approvement-decline');
                });
            });
        });

        Route::group(['prefix' => 'Settings'], function(){
            Route::group(['middleware' => ['pagedenied:7']], function () {
                Route::group(['prefix' => 'General-Setting'], function () {
                    Route::get('/generalsetting-view', 'Admin\GeneralSettingController@index')->name('General-Setting');
                    Route::post('/generalsetting-iconweb', 'Admin\GeneralSettingController@editicon')->name('generalsetting-icon');
                    Route::post('/generalsetting-faviconweb', 'Admin\GeneralSettingController@editfavicon')->name('generalsetting-favicon');
                    Route::post('/generalsetting-update', 'Admin\GeneralSettingController@update')->name('generalsetting-update');
                });
            });
            Route::group(['prefix' => 'Payment-Setting'], function() {
                Route::group(['middleware' => ['pagedenied:8']], function () {
                    Route::get('/paymentsetting-view', 'Admin\PaymentSettingController@index')->name('Payment-Setting');
                    Route::post('/paymentsetting-create', 'Admin\PaymentSettingController@store')->name('Payment-Setting-create');
                    Route::delete('paymentsetting-delete', 'Admin\PaymentSettingController@delete')->name('Payment-Setting-delete');
                });
            });

            Route::group(['prefix' => 'Price-Group'], function() {
                Route::group(['middleware' => ['pagedenied:9']], function () {
                    Route::get('/pricegroup-view', 'Admin\GroupHargaController@index')->name('Price-Group');
                    Route::post('/pricegroup-create', 'Admin\GroupHargaController@store')->name('Price-Group-create');
                    Route::delete('/pricegroup-delete', 'Admin\GroupHargaController@delete')->name('Price-Group-delete');
                });
            });

            Route::group(['prefix' => 'Category'], function () {
                Route::group(['middleware' => ['pagedenied:10']], function () {
                    Route::get('/category-view', 'Admin\CategoryController@index')->name('Category');
                    Route::post('/category-update', 'Admin\CategoryController@update')->name('category-update');
                    Route::post('/category-create', 'Admin\CategoryController@store')->name('category-create');
                });
            });
        });

        Route::group(['prefix' => 'User-Admin'], function () {
            Route::group(['middleware' => ['pagedenied:11']], function () {
                Route::get('/useradmin-view', 'Admin\UserAdminController@index')->name('User-Admin');
                Route::post('/useradmin-address', 'Admin\UserAdminController@Address')->name('detail-address');
                Route::post('/useradmin-statusupdt', 'Admin\UserAdminController@updateStatus')->name('useradmin-statusupdt');
                Route::post('/useradmin-create', 'Admin\UserAdminController@store')->name('useradmin-create');
                Route::post('/useradmin-resetpwd', 'Admin\UserAdminController@resetPwd')->name('useradmin-resetpwd');
                Route::delete('/useradmin-delete', 'Admin\UserAdminController@delete')->name('useradmin-delete');
            });    
        });

        Route::group(['prefix' => 'register-address'], function () {
            Route::get('/register-view', 'Admin\RegisterAddressController@index')->name('registerAddress');
            Route::post('/register-add', 'Admin\RegisterAddressController@update')->name('registerAddress-create');
        });
    });
});



    // ------ Bagian Front End ------ //


Route::group(['prefix' => 'User'], function(){
    Route::post('/process', 'User\UserLoginController@login')->name('loginuser-process');
    Route::get('/register-view', 'User\UserLoginController@registerview')->name('registeruser');
    Route::post('/register-create', 'User\UserLoginController@storeRegister')->name('registeruser-create');
    Route::get('/city-view', 'User\UserLoginController@city')->name('city-view');
    Route::get('/login', 'User\UserLoginController@index')->name('loginuser');
});

Route::get('/', 'User\HomeController@index')->name('home-view'); 
Route::group(['prefix' => 'Home'], function(){
      
    Route::get('/{id_product}', 'User\DetailProductController@index')->name('detailproduct-view');
    Route::post('/totalprice', 'User\DetailProductController@totalprice')->name('totalprice');
    Route::post('/add-cart', 'User\DetailProductController@cartstore')->name('addcart');
    Route::get('/category/{category_name}', 'User\CategoryStoreController@index')->name('categorystore-view');
});

Route::middleware('authloginuser')->group(function(){
    
    Route::get('/search-detail', 'User\HomeController@searchproduct')->name('search-detail');


    Route::group(['prefix' => 'Profile'], function() {
        Route::get('/Profile-view', 'User\ProfileController@index')->name('Profile');
        Route::post('/Profile-update', 'User\ProfileController@updateprofile')->name('profile-updateuser');
        Route::post('/Profile-updatepwd', 'User\ProfileController@updatepassword')->name('profile-updatepwd');
        Route::post('/Profile-createaddress', 'User\ProfileController@storeAddress')->name('profile-createaddress');
        Route::post('/Profile-updateaddress', 'User\ProfileController@updateAddress')->name('profile-updaddress');
        Route::delete('Profile-deleteaddress', 'User\ProfileController@deleteAddress')->name('profile-deladdress');
    });

    Route::group(['prefix' => 'Cart'], function() {
        Route::group(['prefix' => 'Cart-Main'], function(){
            Route::get('/cart', 'User\CartController@index')->name('cart-view');
            Route::post('/cart/qty-update', 'User\CartController@update')->name('cart-qty-update');
            Route::post('/cart-delete', 'User\CartController@delete')->name('cart-delete');
            Route::post('/cart-updatedelivery', 'User\CartController@UpdateDelivery')->name('cart-upddelivery');
            Route::post('/cart-service-list', 'User\CartController@service')->name('cart-servicelist');
            Route::post('/cart-create', 'User\CartController@store')->name('cart-create');
        });

        Route::group(['prefix' => 'Approvement-Payment'], function(){
            Route::get('/Approvepayment-view', 'User\ApprovePaymentController@index')->name('approvepaymentview');
            Route::post('/Approvepayment-create', 'User\ApprovePaymentController@Uploadimage')->name('approvepayment-create');
        });

        Route::group(['prefix' => 'Process'], function(){
            Route::get('/Process-view', 'User\ProcessController@index')->name('process-view');
        });

        Route::group(['prefix' => 'Accept-Decline'], function(){
            Route::get('/acceptdecline-view', 'User\AcceptDeclineController@index')->name('acceptdecline-view');
        });
    });


    

    


    
    
});
Route::get('/user/logout', 'User\UserLoginController@logout')->name('logoutuser-process');
// Route::post('/province', )

